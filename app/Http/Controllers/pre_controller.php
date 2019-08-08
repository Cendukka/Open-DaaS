<?php

namespace App\Http\Controllers;

use App\company;
use App\microlocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\pre_sorting;
use Auth;
use Illuminate\Validation\Rule;

class pre_controller extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(company $company, microlocation $microlocation) {
        return view('pages.company.pre')->with(['company' => $company, 'microlocation' => $microlocation]);
    }


    public function create(company $company) {
        return view('pages.company.manage.pre_create')->with('company', $company);
    }


    public function store(Request $request, company $company) {
        $request->validate([
            'user' => ['integer', Rule::requiredIf(Auth::user()->user_type_id > 3)],
            'datetime' => 'required|date_format:Y-m-d H:i:s|after:-12 months|before:12 months',
            'receipt' => 'required|integer',
            'material' => 'required|integer',
            'weight' => 'required|integer|min:0',
        ]);

        $receipt = $request->get('receipt');
        $receipt_entity = DB::table('inventory_receipt')->where('receipt_id',$receipt)->first();
        $microlocation = $receipt_entity->receipt_to_microlocation_id;
        $material = $request->get('material');
        $weight = $request->get('weight');
        $for_issue = $request->get('for_issue') ? 1 : 0;

        $pre = new pre_sorting([
            'pre_sorting_user_id' => $request->get('user') ?: Auth::user()->user_id,
            'pre_sorting_date' => $request->get('datetime'),
            'pre_sorting_receipt_id' => $receipt,
            'pre_sorting_material_id' => $material,
            'pre_sorting_weight' => $weight,
            'is_for_issue' => $for_issue,
        ]);
        $pre->save();

        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation, $receipt_entity->receipt_material_id, -$weight);
        if(DB::table('material_names')->where('material_type', '=', 'refined')->get()->contains('material_id', $material)){
            app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation, $material, $weight);
        }
        return redirect()->action('pre_controller@index', ['company' => $company])->withErrors(['Esilajittelu kirjaus luotu onnistuneesti.']);
    }


    public function show(company $company, pre_sorting $pre) {

    }


    public function edit(company $company, pre_sorting $pre) {
        return view('pages.company.manage.pre_edit')->with(['company' => $company, 'pre' => $pre]);
    }


    public function update(Request $request, company $company, pre_sorting $pre) {
        $request->validate([
            'user' => ['integer', Rule::requiredIf(Auth::user()->user_type_id > 3)],
            'datetime' => 'required|date_format:Y-m-d H:i:s|after:-12 months|before:12 months',
            'receipt' => 'required|integer',
            'material' => 'required|integer',
            'weight' => 'required|integer|min:0',
        ]);

        $receipt = $request->get('receipt');
        $material = $request->get('material');
        $weight = $request->get('weight');
        $for_issue = $request->get('for_issue') ? 1 : 0;

        $preNew = pre_sorting::find($pre->pre_sorting_id);
        $preNew->pre_sorting_user_id = $request->get('user') ?: Auth::user()->user_id;
        $preNew->pre_sorting_date = $request->get('datetime');
        $preNew->pre_sorting_receipt_id = $receipt;
        $preNew->pre_sorting_material_id = $material;
        $preNew->pre_sorting_weight = $weight;
        $preNew->is_for_issue = $for_issue;

        $receipt_entity_orig = DB::table('inventory_receipt')->where('receipt_id',$preNew->getOriginal('pre_sorting_receipt_id'))->first();
        $receipt_entity_new = DB::table('inventory_receipt')->where('receipt_id',$receipt)->first();
        $microlocation_orig = $receipt_entity_orig->receipt_to_microlocation_id;
        $microlocation_new = $receipt_entity_new->receipt_to_microlocation_id;

        # Remove original weights from the inventory
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_orig, $receipt_entity_orig->receipt_material_id, $preNew->getOriginal('pre_sorting_weight'));
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_orig, $preNew->getOriginal('pre_sorting_material_id'), -$preNew->getOriginal('pre_sorting_weight'));

        $preNew->save();

        # Add new weights to the inventory
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_new, $receipt_entity_new->receipt_material_id, -$weight);
        if(DB::table('material_names')->where('material_type', '=', 'refined')->get()->contains('material_id', $material)){
            app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_new, $material, $weight);
        }
        return redirect()->action('pre_controller@index',['company' => $company])->withErrors(['Esilajittelu kirjaus päivitetty onnistuneesti.']);
	}


	public function destroy($id) {
		//
	}


    public function query(Request $request, company $company) {
        $microlocation_ids = [];
        foreach (DB::table('microlocations')->where('microlocation_company_id',$company->company_id)->get() as $ml){
            array_push($microlocation_ids, $ml->microlocation_id);
        }
        return DB::table('pre_sorting')
            ->whereIn('receipt_to_microlocation_id', $microlocation_ids)
            ->when(($request->from && $request->to), function($query) use ($request){
                $query->whereBetween('pre_sorting_date', [date("Y-m-d",strtotime($request->from)), date("Y-m-d H:i:s",strtotime($request->to.' 23:59:59'))]);
            })
            ->where(function ($query) use ($request){
                foreach(explode(' ',$request->search) as $word){
                    $query->where(function ($query) use ($word) {
                        $query
                            ->where('microlocation_name','LIKE','%'.$word."%")
                            ->orWhere('material_name','LIKE','%'.$word."%")
                            ->orWhere('pre_sorting_weight','LIKE','%'.$word."%")
                            ->orWhere('username','LIKE','%'.$word."%");
                    });
                }
            })
            ->join('inventory_receipt','receipt_id','=','pre_sorting_receipt_id')
            ->join('microlocations','receipt_to_microlocation_id','=','microlocation_id')
            ->join('material_names','material_names.material_id','=','pre_sorting.pre_sorting_material_id')
            ->join('users','users.user_id','=','pre_sorting.pre_sorting_user_id')
            ->orderBy('pre_sorting_date', 'DESC')
            ->orderBy('receipt_to_microlocation_id');
    }


	public function search(Request $request, company $company, microlocation $microlocation){
		if($request->ajax()){
			$output="";
			$result = app('App\Http\Controllers\pre_controller')
                ->query($request,$company)
                ->select('pre_sorting_date','microlocation_name','microlocation_id','material_name','pre_sorting_weight','username','pre_sorting_id','pre_sorting.is_for_issue')
                ->get();
			if($result){
				foreach ($result as $key => $value){
					$output.='<tr>'.
                        '<td>'.date("d-m-Y",strtotime($value->pre_sorting_date)).'</td>'.
						'<td>'.title_case($value->microlocation_name).'</td>'.
						'<td>'.$value->material_name.'</td>'.
						'<td>'.$value->pre_sorting_weight.'</td>'.
						'<td>'.$value->username.'</td>'.
                        '<td>'.($value->is_for_issue ? 'Kyllä' : 'Ei').'</td>'.
                        (Auth::user()->user_type_id < 3 || Auth::user()->user_microlocation_id == $value->microlocation_id ? '<td><a href="'.url('companies/'.$company->company_id.'/manage/pre/'.$value->pre_sorting_id.'/edit').'"><span class="glyphicon glyphicon-pencil"></span></a></td>' : '').
						'</tr>';
				}
				$output.='<tr>'.
					'<td></td>'.
					'<td></td>'.
					'<td>'.$result->sum('pre_sorting_weight').' Total</td>'.
					'<td></td>'.
					'<td></td>'.
					'<td></td>'.
					'</tr>';
				return Response($output);
			}
		}
	}


    public function receipt(Request $request){
        if($request->ajax()){
            $output="";
            $ml_id = $request->input('ml_id') ?: 0;
            $receipt_id = $request->input('receipt_id') ?: 0;
            $result = DB::table('inventory_receipt')
                ->join('material_names','material_id','receipt_material_id')
                ->where('receipt_to_microlocation_id','=',$ml_id)
                ->where('material_names.material_type', 'Raw Waste')
                ->where('is_for_issue','!=',1)
                ->select('material_name','material_type','receipt_to_microlocation_id','receipt_id','receipt_weight','receipt_date','is_for_issue')
                ->orderBy('receipt_date','DESC')
                ->get();
            if($result->count()>0) {
                $output .= '<option selected="selected" disabled hidden value=""></option>';
                foreach ($result as $key => $value) {
                    $used = DB::table('pre_sorting')->where('pre_sorting_receipt_id',$value->receipt_id)->sum('pre_sorting_weight');
                    $output .= '<option value="'.$value->receipt_id.'" '.($value->receipt_id == $receipt_id ? 'selected="selected"' : '').'>'.title_case($value->material_name.', '.$value->receipt_date.', '.$value->receipt_weight.' kg (Sorted: '.$used.'kg)').'</option>';
                }
            }
            else{
                $output .= '<option>ei sopivia kirjauksia</option>';
            }
            return Response($output);
        }
    }
}
