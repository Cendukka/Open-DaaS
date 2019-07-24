<?php

namespace App\Http\Controllers;

use App\company;
use App\microlocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\inventory_issue;

class issue_controller extends Controller {
	public function __construct()
    {
        $this->middleware('auth');
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(company $company,  microlocation $microlocation) {
        return view('pages.company.issues')->with(['company' => $company, 'microlocation' => $microlocation]);
	}


	public function create(company $company) {
        return view('pages.company.manage.issues_create')->with('company', $company);
	}


	public function store(Request $request, company $company) {
        # ADD MORE AUTHENTICATION HERE
        $request->validate([
            'user' => 'required|integer',
            'datetime' => 'required|date_format:Y-m-d H:i:s',
            'type' => 'required',
            'from_microlocation' => 'integer|integer',
            #'to_microlocation' => 'required|integer',
            'material' => ['required',
                function ($attribute, $value, $fail) {
                    foreach($value as $v) {
                        if(!is_numeric($v)) {
                            $fail($attribute.' is invalid.');
                        }
                    }
                },
            ],
            'ewc_code' => ['required',
                function ($attribute, $value, $fail) {
                    foreach($value as $v) {
                        if(!is_numeric($v)) {
                            $fail($attribute.' is invalid.');
                        }
                    }
                },
            ],
            'weight' => ['required','min:0',
                function ($attribute, $value, $fail) {
                    foreach($value as $v) {
                        if(!is_numeric($v)) {
                            $fail($attribute.' is invalid.');
                        }
                    }
                },
            ],
        ]);

        $microlocation = $request->get('from_microlocation');

        $issue = new inventory_issue([
            'issue_user_id' => $request->get('user'),
            'issue_date' => $request->get('datetime'),
            'issue_type_id' => $request->get('type'),
            'issue_from_microlocation_id' => $microlocation,
            'issue_to_microlocation_id' => $request->get('to_microlocation'),
        ]);
        $issue->save();

        for ($i = 0; $i <= count($request->ewc_code)-1; $i++) {
            $material = $request->material[$i];
            $weight = $request->weight[$i];
            DB::table('inventory_issue_details')->insert([
                'detail_issue_id' => $issue->issue_id,
                'detail_material_id' => $request->material[$i],
                'detail_ewc_code' => $request->ewc_code[$i],
                'detail_weight' => $request->weight[$i],
            ]);
            app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation, $material, -$weight);
        }


        return redirect()->action('issue_controller@index', ['company' => $company])->withErrors(['Receipt successfully created.']);
	}


	public function show(company $company, inventory_issue $issue) {

	}


	public function edit(company $company, inventory_issue $issue) {
        return view('pages.company.manage.issues_edit')->with(['company' => $company, 'issue' => $issue]);
	}


	public function update(Request $request, company $company, inventory_issue $issue) {
        # ADD MORE AUTHENTICATION HERE

        $request->validate([
            'user' => 'required|integer',
            'datetime' => 'required|date_format:Y-m-d H:i:s',
            'type' => 'required',
            'from_microlocation' => 'integer|integer',
            'to_microlocation' => 'required|integer',
            'material' => ['required',
                function ($attribute, $value, $fail) {
                    foreach($value as $v) {
                        if(!is_numeric($v)) {
                            $fail($attribute.' is invalid.');
                        }
                    }
                },
            ],
            'ewc_code' => ['required',
                function ($attribute, $value, $fail) {
                    foreach($value as $v) {
                        if(!is_numeric($v)) {
                            $fail($attribute.' is invalid.');
                        }
                    }
                },
            ],
            'weight' => ['required','min:0',
                function ($attribute, $value, $fail) {
                    foreach($value as $v) {
                        if(!is_numeric($v)) {
                            $fail($attribute.' is invalid.');
                        }
                    }
                },
            ],
        ]);

        $microlocation = $request->get('from_microlocation');

        $issueNew = inventory_issue::find($issue->issue_id);
        $issueNew->issue_user_id = $request->get('user');
        $issueNew->issue_date = $request->get('datetime');
        $issueNew->issue_type_id = $request->get('type');
        $issueNew->issue_from_microlocation_id = $microlocation;
        $issueNew->issue_to_microlocation_id = $request->get('to_microlocation');


        # Remove old data
        foreach(DB::table('inventory_issue_details')->where('detail_issue_id','=',$issue->issue_id)->get() as $detail){
            app('App\Http\Controllers\microlocation_controller')->add_inventory($issueNew->getOriginal('issue_from_microlocation_id'), $detail->detail_material_id, $detail->detail_weight);
        }
        DB::table('inventory_issue_details')->where('detail_issue_id','=',$issue->issue_id)->delete();

        # Save new data
        $issueNew->save();
        for ($i = 0; $i <= count($request->ewc_code)-1; $i++) {
            $material = $request->material[$i];
            $weight = $request->weight[$i];
            DB::table('inventory_issue_details')->insert([
                'detail_issue_id' => $issue->issue_id,
                'detail_material_id' => $material,
                'detail_ewc_code' => $request->ewc_code[$i],
                'detail_weight' => $weight,
            ]);
            app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation, $material, -$weight);
        }

        return redirect()->action('issue_controller@index',['company' => $company])->withErrors(['Issue successfully updated.']);
	}


	public function destroy($id) {
		//
	}


    public function query(company $company, Request $request) {
        $microlocation_ids = [];
        foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $microlocation){
            array_push($microlocation_ids, $microlocation->microlocation_id);
        }

        return DB::table('inventory_issue')
            ->whereIn('issue_from_microlocation_id', $microlocation_ids)
            ->when(($request->from && $request->to), function($query) use ($request){
                $query->whereBetween('issue_date', [date("Y-m-d",strtotime($request->from)), date("Y-m-d H:i:s",strtotime($request->to.' 23:59:59'))]);
            })
            ->where(function ($query) use ($request){
                foreach(explode(' ',$request->search) as $word){
                    $query->where(function ($query) use ($word) {
                        $query
                            ->where('from_microlocations.microlocation_name','LIKE','%'.$word."%")
                            ->orWhere('to_microlocations.microlocation_name','LIKE','%'.$word."%")
                            ->orWhere('username','LIKE','%'.$word."%")
                            ->orWhere('issue_typename','LIKE','%'.$word."%");
                    });
                }
            })
            ->join('issue_types','inventory_issue.issue_type_id','=','issue_types.issue_type_id')
            ->join('microlocations as from_microlocations','issue_from_microlocation_id','=','from_microlocations.microlocation_id')
            ->leftJoin('microlocations as to_microlocations','issue_to_microlocation_id','=','to_microlocations.microlocation_id')
            ->join('users','users.user_id','=','issue_user_id')
            ->joinSub(DB::table('inventory_issue_details')
                ->select('detail_issue_id',DB::raw('SUM(detail_weight) as sumweight'))
                ->groupBy('detail_issue_id'),'details', function ($join) {
                    $join->on('detail_issue_id', '=', 'issue_id');
                })
            ->orderBy('issue_date','DESC');
    }


	public function search(Request $request, company $company){
		if($request->ajax()){
			$output="";
            $result = app('App\Http\Controllers\issue_controller')
                ->query($company,$request)
                ->select('issue_date','from_microlocations.microlocation_name as from_microlocation','issue_typename','to_microlocations.microlocation_name as to_microlocation','users.username','issue_id','sumweight')
                ->get();
			if($result){
			    $sumweight = 0;
				foreach ($result as $key => $value){
					$output.='<tr>'.
                        '<td>'.date("Y-m-d",strtotime($value->issue_date)).'</td>'.
                        '<td>'.title_case($value->from_microlocation).'</td>'.
                        '<td>'.$value->issue_typename.'</td>'.
						'<td>'.title_case($value->to_microlocation).'</td>'.
						'<td>'.$value->username.'</td>'.
						'<td>'.$value->sumweight.'</td>'.
                        '<td><a href="'.url('companies/'.$company->company_id.'/manage/issues/'.$value->issue_id.'/edit').'"><i class="glyphicon glyphicon-pencil"></i></a></td>'.
						'</tr>';
				}
                $output.='<tr>'.
                    '<td></td>'.
                    '<td></td>'.
                    '<td></td>'.
                    '<td></td>'.
                    '<td></td>'.
                    '<td>'.$sumweight.' Total</td>'.
                    '</tr>';
				return Response($output);
			}
		}
	}

    public function inventory(Request $request, company $company){
        if($request->ajax()){
            $output=[];
            $ml = $request->get('ml_id');
            foreach(DB::table('inventory')->where('inventory_microlocation_id',$ml)->get() as $inv){
                $output[$inv->inventory_material_id] = $inv->inventory_weight;
            }
            return Response($output);
        }
    }
}
