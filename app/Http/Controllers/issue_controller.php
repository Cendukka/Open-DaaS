<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\inventory_issue;

class issue_controller extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(company $company) {
        return view('pages.company.manage.issues')->with('company', $company);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(company $company) {
        return view('pages.company.manage.issues_create')->with('company', $company);
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, company $company) {
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
            'weight' => ['required',
                function ($attribute, $value, $fail) {
                    foreach($value as $v) {
                        if(!is_numeric($v)) {
                            $fail($attribute.' is invalid.');
                        }
                    }
                },
            ],
        ]);


        $issue = new inventory_issue([
            'issue_user_id' => $request->get('user'),
            'issue_date' => $request->get('datetime'),
            'issue_type_id' => $request->get('type'),
            'issue_from_microlocation_id' => $request->get('from_microlocation'),
            'issue_to_microlocation_id' => $request->get('to_microlocation'),
        ]);
        $issue->save();

        for ($i = 0; $i <= count($request->ewc_code)-1; $i++) {
            DB::table('inventory_issue_details')->insert([
                'detail_issue_id' => $issue->issue_id,
                'detail_material_id' => $request->material[$i],
                'detail_ewc_code' => $request->ewc_code[$i],
                'detail_weight' => $request->weight[$i],
            ]);
        }

        return redirect()->action('issue_controller@index', ['company' => $company])->withErrors(['Receipt successfully created.']);
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(company $company, inventory_issue $issue) {
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(company $company, inventory_issue $issue) {
        return view('pages.company.manage.issues_edit')->with(['company' => $company, 'issue' => $issue]);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
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
            'weight' => ['required',
                function ($attribute, $value, $fail) {
                    foreach($value as $v) {
                        if(!is_numeric($v)) {
                            $fail($attribute.' is invalid.');
                        }
                    }
                },
            ],
        ]);

        $issueNew = inventory_issue::find($issue->issue_id);
        $issueNew->issue_user_id = $request->get('user');
        $issueNew->issue_date = $request->get('datetime');
        $issueNew->issue_type_id = $request->get('type');
        $issueNew->issue_from_microlocation_id = $request->get('from_microlocation');
        $issueNew->issue_to_microlocation_id = $request->get('to_microlocation');
        $issueNew->save();

        DB::table('inventory_issue_details')->where('detail_issue_id','=',$issue->issue_id)->delete();
        for ($i = 0; $i <= count($request->ewc_code)-1; $i++) {
            DB::table('inventory_issue_details')->insert([
                'detail_issue_id' => $issue->issue_id,
                'detail_material_id' => $request->material[$i],
                'detail_ewc_code' => $request->ewc_code[$i],
                'detail_weight' => $request->weight[$i],
            ]);
        }

        return redirect()->action('issue_controller@index',['company' => $company])->withErrors(['Issue successfully updated.']);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
	
	public function search(Request $request, company $company){
		if($request->ajax()){
			$microlocations = DB::table('microlocations')
							->where('microlocation_company_id','=',$company->company_id)
							->get();
			$microlocation_ids = [];
			foreach ($microlocations as $microlocation){
				array_push($microlocation_ids, $microlocation->microlocation_id);
			}
			$output="";
			$result=DB::table('inventory_issue')
					->whereIn('issue_from_microlocation_id', $microlocation_ids)
					->when(($request->from && $request->to), function($query) use ($request){
						$query->whereBetween('issue_date', [date("Y-m-d",strtotime($request->from)), date("Y-m-d H:i:s",strtotime($request->to.' 23:59:59'))]);
					})
					->where(function ($query) use ($request){
						$query
						->where('microlocation_name','LIKE','%'.$request->search."%")
						->orWhere('issue_typename','LIKE','%'.$request->search."%");
					})
					->join('issue_types','inventory_issue.issue_type_id','=','issue_types.issue_type_id')
					->join('microlocations','issue_to_microlocation_id','=','microlocation_id')
					->orderBy('issue_from_microlocation_id')
					->orderBy('issue_date')
					->get();
			if($result){
				foreach ($result as $key => $value){
					$output.='<tr>'.
						'<td>'.title_case($value->microlocation_name).'</td>'.
						'<td>'.title_case($value->issue_from_microlocation_id).'</td>'.
                        '<td>'.date("Y-m-d",strtotime($value->issue_date)).'</td>'.
						'<td>'.$value->issue_user_id.'</td>'.
						'<td>'.$value->issue_typename.'</td>'.
						'</tr>';
				}
				return Response($output);
			}
		}
	}
}
