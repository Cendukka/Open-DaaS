<?php

namespace App\Http\Controllers;

use App\company;
use App\microlocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\refined_sorting;
use Auth;
use Illuminate\Validation\Rule;

class refined_controller extends Controller {
	public function __construct()
    {
        $this->middleware('auth');
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(company $company, microlocation $microlocation) {
        return view('pages.company.refined')->with(['company' => $company, 'microlocation' => $microlocation]);
	}


	public function create(company $company) {
        return view('pages.company.manage.refined_create')->with('company', $company);
	}


	public function store(Request $request, company $company) {
        # ADD MORE AUTHENTICATION HERE

        $request->validate([
            'user' => ['integer', Rule::requiredIf(Auth::user()->user_type_id > 3)],
            'datetime' => 'required|date_format:Y-m-d H:i:s',
            'pre_receipt' => 'required|integer',
            'material' => 'required|integer',
            'weight' => 'required|integer|min:0',
            'description' => 'max:191',
        ],[],[
            'user' => 'User',
            'datetime' => 'Date & Time',
            'pre_receipt' => 'Pre-Sorting or Receipt',
            'material' => 'Material',
            'weight' => 'Weight',
        ]);

        $receipt = ($request->get('origin') == 'receipt' ? $request->get('pre_receipt') : NULL);
        $pre_sorting = ($request->get('origin') == 'presort' ? $request->get('pre_receipt') : NULL);

        $receipt_entity = ($receipt ?
            DB::table('inventory_receipt')
                ->where('receipt_id',$receipt)
                ->first()
            :
            DB::table('pre_sorting')
                ->join('inventory_receipt','pre_sorting_receipt_id','receipt_id')
                ->where('pre_sorting_id',$pre_sorting)
                ->first()
            );
        $microlocation = $receipt_entity->receipt_to_microlocation_id;
        $material = $request->get('material');
        $weight = $request->get('weight');

        $refined = new refined_sorting([
            'refined_user_id' => $request->get('user') ?: Auth::user()->user_id,
            'refined_date' => $request->get('datetime'),
            'refined_receipt_id' => $receipt,
            'pre_sorting_id' => $pre_sorting,
            'refined_material_id' => $material,
            'refined_weight' => $weight,
            'description' => ($request->get('description') ?: ''),
        ]);
        $refined->save();

        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation, ($pre_sorting ? $receipt_entity->pre_sorting_material_id : $receipt_entity->receipt_material_id), -$weight);
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation, $material, $weight);
        return redirect()->action('refined_controller@index', ['company' => $company])->withErrors(['Hienolajittelukirjaus luotu onnistuneesti.']);
	}


	public function show(company $company, refined_sorting $refined) {

	}


	public function edit(company $company, refined_sorting $refined) {
        return view('pages.company.manage.refined_edit')->with(['company' => $company, 'refined' => $refined]);
	}


	public function update(Request $request, company $company, refined_sorting $refined) {
        # ADD MORE AUTHENTICATION HERE


        $request->validate([
            'user' => ['integer', Rule::requiredIf(Auth::user()->user_type_id > 3)],
            'datetime' => 'required|date_format:Y-m-d H:i:s',
            'pre_receipt' => 'required|integer',
            'material' => 'required|integer',
            'weight' => 'required|integer|min:0',
            'description' => 'max:191',
        ],[],[
            'user' => 'User',
            'datetime' => 'Date & Time',
            'pre_receipt' => 'Pre-Sorting or Receipt',
            'material' => 'Material',
            'weight' => 'Weight',
        ]);

        $receipt = ($request->get('origin') == 'receipt' ? $request->get('pre_receipt') : NULL);
        $pre_sorting = ($request->get('origin') == 'presort' ? $request->get('pre_receipt') : NULL);
        $material = $request->get('material');
        $weight = $request->get('weight');

        $refinedNew = refined_sorting::find($refined->refined_id);
        $refinedNew->refined_user_id = $request->get('user') ?: Auth::user()->user_id;
        $refinedNew->refined_date = $request->get('datetime');
        $refinedNew->refined_receipt_id = $receipt;
        $refinedNew->pre_sorting_id = $pre_sorting;
        $refinedNew->refined_material_id = $material;
        $refinedNew->refined_weight = $weight;
        $refinedNew->description = ($request->get('description') ?: '');


        $receipt_entity_orig = ($refinedNew->getOriginal('refined_receipt_id') ?
            DB::table('inventory_receipt')
                ->where('receipt_id',$refinedNew->getOriginal('refined_receipt_id'))
                ->first()
            :
            DB::table('pre_sorting')
                ->join('inventory_receipt','pre_sorting_receipt_id','receipt_id')
                ->where('pre_sorting_id',$refinedNew->getOriginal('pre_sorting_id'))
                ->first()
        );
        $receipt_entity_new = ($receipt ?
            DB::table('inventory_receipt')
                ->where('receipt_id',$receipt)
                ->first()
            :
            DB::table('pre_sorting')
                ->join('inventory_receipt','pre_sorting_receipt_id','receipt_id')
                ->where('pre_sorting_id',$pre_sorting)
                ->first()
        );
        $microlocation_orig = $receipt_entity_orig->receipt_to_microlocation_id;
        $microlocation_new = $receipt_entity_new->receipt_to_microlocation_id;

        # Remove original weights from the inventory
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_orig, ($refinedNew->getOriginal('refined_receipt_id') ? $receipt_entity_orig->receipt_material_id: $receipt_entity_orig->pre_sorting_material_id ), $refinedNew->getOriginal('refined_weight'));
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_orig, $refinedNew->getOriginal('refined_material_id'), -$refinedNew->getOriginal('refined_weight'));

        $refinedNew->save();

        # Add new weights to the inventory
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_new, ($receipt ? $receipt_entity_new->receipt_material_id: $receipt_entity_new->pre_sorting_material_id ), -$weight);
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_new, $material, $weight);
        return redirect()->action('refined_controller@index',['company' => $company])->withErrors(['Hienolajittelukirjaus päivitetty onnistuneesti.']);
	}


	public function destroy($id) {
		//
	}


    public function query(Request $request, company $company, microlocation $microlocation) {
        $microlocation_ids = [];
        foreach (DB::table('microlocations')->where('microlocation_company_id',$company->company_id)->get() as $ml){
            array_push($microlocation_ids, $ml->microlocation_id);
        }
        return DB::table('refined_sorting')
            ->whereIn('receipt_to_microlocation_id', $microlocation_ids)
            ->when(($request->from && $request->to), function($query) use ($request){
                $query->whereBetween('refined_date', [date("Y-m-d",strtotime($request->from)), date("Y-m-d H:i:s",strtotime($request->to.' 23:59:59'))]);
            })
            ->when($microlocation->exists, function($query) use ($microlocation){
                $query->where('receipt_to_microlocation_id', $microlocation->microlocation_id);
            })
            ->where(function ($query) use ($request){
                foreach(explode(' ',$request->search) as $word){
                    $query->where(function ($query) use ($word) {
                        $query
                            ->where('microlocation_name', 'LIKE', '%' . $word . "%")
                            ->orWhere('material_name', 'LIKE', '%' . $word . "%")
                            ->orWhere('refined_weight', 'LIKE', '%' . $word . "%")
                            ->orWhere('username', 'LIKE', '%' . $word . "%");
                    });
                }
            })
            ->leftJoin('pre_sorting','refined_sorting.pre_sorting_id','pre_sorting.pre_sorting_id')
            ->leftJoin('inventory_receipt', function($join){
                $join->on('pre_sorting.pre_sorting_receipt_id', '=', 'inventory_receipt.receipt_id')
                    ->orOn('refined_sorting.refined_receipt_id', '=', 'inventory_receipt.receipt_id');
            })
            ->join('microlocations','receipt_to_microlocation_id','microlocation_id')
            ->join('material_names','material_id','=','refined_material_id')
            ->join('users','users.user_id','=','refined_user_id')
            ->orderBy('refined_date','DESC')
            ->orderBy('receipt_to_microlocation_id');
    }


	public function search(Request $request, company $company, microlocation $microlocation){
		if($request->ajax()){
			$output="";
            $result = app('App\Http\Controllers\refined_controller')
                ->query($request,$company,$microlocation)
                ->select(['refined_date','microlocation_name','microlocation_id','material_name','refined_weight','username','refined_id','refined_receipt_id',])
                ->get();
			if($result){
				foreach ($result as $key => $value){
					$output.='<tr>'.
                        '<td>'.date("d-m-Y",strtotime($value->refined_date)).'</td>'.
                        '<td>'.title_case($value->microlocation_name).'</td>'.
						'<td>'.$value->refined_weight.'</td>'.
						'<td>'.$value->material_name.'</td>'.
						'<td>'.$value->username.'</td>'.
                        (Auth::user()->user_type_id < 3 || Auth::user()->user_microlocation_id == $value->microlocation_id ? '<td><a href="'.url('companies/'.$company->company_id.'/manage/refined/'.$value->refined_id.'/edit').'"> <span class="glyphicon glyphicon-pencil"></span></a></td>' : '').
						'</tr>';
				}
				$output.='<tr>'.
					'<td></td>'.
					'<td></td>'.
					'<td>'.$result->sum('refined_weight').' Total</td>'.
					'<td></td>'.
					'<td></td>'.
					'</tr>';
				return Response($output);
			}
		}
	}


    public function origin(Request $request, company $company){
        if($request->ajax()){
            $output="";
            $origin = $request->input('origin') ?: 0;
            $ml_id = $request->input('ml_id') ?: 0;
            $pre_receipt_id = $request->input('pre_receipt_id') ?: 0;
            if($origin == 'receipt') {
                $result = DB::table('inventory_receipt')
                    ->join('material_names', 'material_id', 'receipt_material_id')
                    ->where('receipt_to_microlocation_id', '=', $ml_id)
                    ->where('material_type', 'refined')
                    ->where('is_for_issue','!=',1)
                    ->orderBy('receipt_date', 'DESC')
                    ->get();
                $output .= '<label class="col-sm-2 col-form-label" for="pre_receipt">Saapuneiden materiaalien kirjaus:</label><div class="col-sm-10">';
                $output .= '<select class="form-control element-width-auto form-field-width" name="pre_receipt" id="pre_receipt">';
                if($result->count()>0) {
                    $output .= '<option selected="selected" disabled hidden value=""></option>';
                    foreach ($result as $key => $value) {
                        $used = DB::table('refined_sorting')->where('refined_receipt_id',$value->receipt_id)->sum('refined_weight');
                        if($pre_receipt_id != $value->receipt_id && $used >= $value->receipt_weight){
                            continue;
                        }
                        $output .= '<option value="'.$value->receipt_id.'" '.($value->receipt_id == $pre_receipt_id ? 'selected="selected"' : '').'>'.title_case($value->material_name.', '.$value->receipt_date.', '.$value->receipt_weight.' kg (Sorted: '.$used.'kg)').'</option>';
                    }
                }
                else{
                    $output .= '<option>ei sopivia kirjauksia</option></select></div>';
                }
                return Response($output);
            }
            elseif($origin == 'presort'){
                $result = DB::table('pre_sorting')
                    ->join('inventory_receipt','pre_sorting_receipt_id','receipt_id')
                    ->join('material_names', 'pre_sorting.pre_sorting_material_id', 'material_names.material_id')
                    ->where('receipt_to_microlocation_id', '=', $ml_id)
                    ->where('pre_sorting.is_for_issue','!=',1)
                    ->where('material_type', 'refined')
                    ->orderBy('receipt_date', 'DESC')
                    ->get();
                $output .= '<label class="col-sm-2 col-form-label" for="pre_receipt">Esilajittelun kirjaus:</label><div class="col-sm-10">';
                $output .= '<select class="form-control element-width-auto form-field-width" name="pre_receipt" id="pre_receipt">';
                if($result->count()>0) {
                    $output .= '<option selected="selected" disabled hidden value=""></option>';
                    foreach ($result as $key => $value) {
                        $used = DB::table('refined_sorting')->where('pre_sorting_id',$value->pre_sorting_id)->sum('refined_weight');
                        if($pre_receipt_id != $value->pre_sorting_id && $used >= $value->pre_sorting_weight){
                            continue;
                        }
                        $output .= '<option value="'.$value->pre_sorting_id.'" '.($value->pre_sorting_id == $pre_receipt_id ? 'selected="selected"' : '').'>'.title_case($value->material_name.', '.$value->pre_sorting_date.', '.$value->pre_sorting_weight.' kg (Sorted: '.$used.'kg)').'</option>';
                    }
                    return Response($output);
                }
                else{
                    $output .= '<option>ei sopivia kirjauksia</option></select></div>';
                }
                return Response($output);
            }
            else{
                return Response('ERROR');
            }
        }
    }
}


