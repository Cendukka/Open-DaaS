<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\refined_sorting;

class refined_controller extends Controller {


	public function index(company $company) {
	
	}


	public function create(company $company) {
	
	}


	public function store(Request $request, refined_sorting $refined) {
	
	}


	public function show(company $company, refined_sorting $refined) {
	
	}


	public function edit(company $company, refined_sorting $refined) {
	
	}


	public function update(Request $request, company $company, refined_sorting $refined) {
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
					->join('inventory_receipt','receipt_id','=','refined_receipt_id')
					->join('microlocations','receipt_to_microlocation_id','=','microlocation_id')
					->join('material_names','material_id','=','refined_material_id')
                    ->join('users','users.user_id','=','refined_user_id')
					->orderBy('refined_date','DESC')
					->orderBy('receipt_to_microlocation_id')
					->get();
			if($result){
				$sumweight = 0;
				foreach ($result as $key => $value){
					$output.='<tr>'.
						'<td>'.title_case($value->microlocation_name).'</td>'.
                        '<td>'.date("Y-m-d",strtotime($value->refined_date)).'</td>'.
						'<td>'.$value->refined_weight.'</td>'.
						'<td>'.$value->material_name.'</td>'.
						'<td>'.$value->username.'</td>'.
						'</tr>';
					$sumweight += $value->refined_weight;
				}
				$output.='<tr>'.
					'<td></td>'.
					'<td></td>'.
					'<td>'.$sumweight.' Total</td>'.
					'<td></td>'.
					'<td></td>'.
					'</tr>';
				return Response($output);
			}
		}
	}
}
