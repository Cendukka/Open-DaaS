<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\refined_sorting;

class refined_controller extends Controller {


	public function index(company $company) {
        return view('pages.company.refined')->with('company', $company);
	}


	public function create(company $company) {
        return view('pages.company.manage.refined_create')->with('company', $company);
	}


	public function store(Request $request, company $company) {
        # ADD MORE AUTHENTICATION HERE

        $request->validate([
            'user' => 'required|integer',
            'datetime' => 'required|date_format:Y-m-d H:i:s',
            'pre_receipt' => 'required|integer',
            'material' => 'required|integer',
            'weight' => 'required|integer',
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
        $microlocation = ($receipt ?
            DB::table('inventory_receipt')
                ->where('receipt_id',$receipt)
                ->first()->receipt_to_microlocation_id
            :
            DB::table('pre_sorting')
                ->join('inventory_receipt','pre_sorting_receipt_id','receipt_id')
                ->where('pre_sorting_id',$pre_sorting)
                ->first()->receipt_to_microlocation_id
            );

        $material = $request->get('material');
        $weight = $request->get('weight');

        $refined = new refined_sorting([
            'refined_user_id' => $request->get('user'),
            'refined_date' => $request->get('datetime'),
            'refined_receipt_id' => $receipt,
            'pre_sorting_id' => $pre_sorting,
            'refined_material_id' => $material,
            'refined_weight' => $weight,
            'description' => ($request->get('description') ?: ''),
        ]);
        $refined->save();

        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation, '2', -$weight);
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation, $material, $weight);
        return redirect()->action('refined_controller@index', ['company' => $company])->withErrors(['Refined-Sorting successfully created.']);
	}


	public function show(company $company, refined_sorting $refined) {

	}


	public function edit(company $company, refined_sorting $refined) {
        return view('pages.company.manage.refined_edit')->with(['company' => $company, 'refined' => $refined]);
	}


	public function update(Request $request, company $company, refined_sorting $refined) {
        # ADD MORE AUTHENTICATION HERE

        $request->validate([
            'user' => 'required|integer',
            'datetime' => 'required|date_format:Y-m-d H:i:s',
            'pre_receipt' => 'required|integer',
            'material' => 'required|integer',
            'weight' => 'required|integer',
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
        $refinedNew->refined_user_id = $request->get('user');
        $refinedNew->refined_date = $request->get('datetime');
        $refinedNew->refined_receipt_id = $receipt;
        $refinedNew->pre_sorting_id = $pre_sorting;
        $refinedNew->refined_material_id = $material;
        $refinedNew->refined_weight = $weight;
        $refinedNew->description = ($request->get('description') ?: '');


        $microlocation_orig = ($refinedNew->getOriginal('refined_receipt_id') ?
            DB::table('inventory_receipt')
                ->where('receipt_id',$refinedNew->getOriginal('refined_receipt_id'))
                ->first()->receipt_to_microlocation_id
            :
            DB::table('pre_sorting')
                ->join('inventory_receipt','pre_sorting_receipt_id','receipt_id')
                ->where('pre_sorting_id',$refinedNew->getOriginal('pre_sorting_id'))
                ->first()->receipt_to_microlocation_id
        );
        $microlocation_new = ($receipt ?
            DB::table('inventory_receipt')
                ->where('receipt_id',$receipt)
                ->first()->receipt_to_microlocation_id
            :
            DB::table('pre_sorting')
                ->join('inventory_receipt','pre_sorting_receipt_id','receipt_id')
                ->where('pre_sorting_id',$pre_sorting)
                ->first()->receipt_to_microlocation_id
        );


        # Remove original weights from the inventory
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_orig, '2', $refinedNew->getOriginal('refined_weight'));
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_orig, $refinedNew->getOriginal('refined_material_id'), -$refinedNew->getOriginal('refined_weight'));

        $refinedNew->save();

        # Add new weights to the inventory
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_new, '2', -$weight);
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_new, $material, $weight);
        return redirect()->action('refined_controller@index',['company' => $company])->withErrors(['Refined-Sorting successfully updated.']);
	}


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

			$result=DB::table('refined_sorting')
                    ->whereIn('receipt_to_microlocation_id', $microlocation_ids)
					->when(($request->from && $request->to), function($query) use ($request){
						$query->whereBetween('refined_date', [date("Y-m-d",strtotime($request->from)), date("Y-m-d H:i:s",strtotime($request->to.' 23:59:59'))]);
					})
					->where(function ($query) use ($request){
						$query
						->where('microlocation_name','LIKE','%'.$request->search."%")
						->orWhere('material_name','LIKE','%'.$request->search."%")
						->orWhere('refined_weight','LIKE','%'.$request->search."%")
						->orWhere('username','LIKE','%'.$request->search."%");
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
					->orderBy('receipt_to_microlocation_id')
                    ->select(['refined_id','username','refined_weight','material_name','refined_date','refined_receipt_id','microlocation_name'])
					->get();
			if($result){
				foreach ($result as $key => $value){
					$output.='<tr>'.
						'<td>'.title_case($value->microlocation_name).'</td>'.
                        '<td>'.date("Y-m-d",strtotime($value->refined_date)).'</td>'.
						'<td>'.$value->refined_weight.'</td>'.
						'<td>'.$value->material_name.'</td>'.
						'<td>'.$value->username.'</td>'.
                        '<td><a href="'.url('companies/'.$company->company_id.'/manage/refined/'.$value->refined_id.'/edit').'">Edit</a></td>'.
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
                    ->orderBy('receipt_date', 'DESC')
                    ->get();
                $output .= '<label for="pre_receipt">Receipt:&nbsp</label>';
                if($result->count()) {
                    $output .= '<select name="pre_receipt" id="pre_receipt">';
                    $output .= '<option selected="selected" disabled hidden value=""></option>';
                    foreach ($result as $key => $value) {
                        $used = DB::table('refined_sorting')->where('refined_receipt_id',$value->receipt_id)->sum('refined_weight');
                        $output .= '<option value="'.$value->receipt_id.'" '.($value->receipt_id == $pre_receipt_id ? 'selected="selected"' : '').'>'.title_case($value->material_name.', '.$value->receipt_date.', '.$value->receipt_weight.' kg (Sorted: '.$used.'kg)').'</option>';
                    }
                    $output .= '</select>';
                    return Response($output);
                }
                else{
                    $output .= 'No raw textile receipts found.';
                    return Response($output);
                }
            }
            elseif($origin == 'presort'){
                $result = DB::table('pre_sorting')
                    ->join('inventory_receipt','pre_sorting_receipt_id','receipt_id')
                    ->join('material_names', 'pre_sorting.pre_sorting_material_id', 'material_names.material_id')
                    ->where('receipt_to_microlocation_id', '=', $ml_id)
                    ->where('material_type', 'refined')
                    ->orderBy('receipt_date', 'DESC')
                    ->get();
                $output .= '<label for="pre_receipt">Pre-sorting:&nbsp</label>';
                if($result->count()) {
                    $output .= '<select name="pre_receipt" id="pre_receipt">';
                    $output .= '<option selected="selected" disabled hidden value=""></option>';
                    foreach ($result as $key => $value) {
                        $used = DB::table('refined_sorting')->where('pre_sorting_id',$value->pre_sorting_id)->sum('refined_weight');
                        $output .= '<option value="'.$value->pre_sorting_id.'" '.($value->pre_sorting_id == $pre_receipt_id ? 'selected="selected"' : '').'>'.title_case($value->material_name.', '.$value->pre_sorting_date.', '.$value->receipt_weight.' kg (Sorted: '.$used.'kg)').'</option>';
                    }
                    $output .= '</select>';
                    return Response($output);
                }
                else{
                    $output .= 'No pre-sorted raw textiles found.';
                    return Response($output);
                }
            }
            else{
                return Response('ERROR');
            }
        }
    }
}


