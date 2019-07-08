<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\pre_sorting;

class pre_controller extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(company $company) {
	
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(company $company) {
	
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, pre_sorting $pre) {
	
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(company $company, pre_sorting $pre) {
	
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(company $company, pre_sorting $pre) {
	
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, company $company, pre_sorting $pre) {
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
			$result=DB::table('pre_sorting')
					->whereIn('receipt_to_microlocation_id', $microlocation_ids)
					->when(($request->from && $request->to), function($query) use ($request){
						$query->whereBetween('pre_sorting_date', [date("Y-m-d",strtotime($request->from)), date("Y-m-d H:i:s",strtotime($request->to.' 23:59:59'))]);
					})
					->where(function ($query) use ($request){
						$query
						->where('microlocation_name','LIKE','%'.$request->search."%")
						->orWhere('presorted_material_name','LIKE','%'.$request->search."%");
					})
					->join('inventory_receipt','receipt_id','=','pre_sorting_receipt_id')
					->join('microlocations','receipt_to_microlocation_id','=','microlocation_id')
					->join('presorted_material','presorted_material.presorted_material_id','=','pre_sorting.presorted_material_id')
					->join('users','pre_sorting.pre_sorting_user_id','=','users.user_id')
					->orderBy('pre_sorting_date')
					->orderBy('receipt_to_microlocation_id')
					->get();
			if($result){
				$sumweight = 0;
				foreach ($result as $key => $value){
					$output.='<tr>'.
                        '<td>'.$value->pre_sorting_date.'</td>'.
						'<td>'.title_case($value->microlocation_name).'</td>'.
                        '<td>'.date("Y-m-d",strtotime($value->pre_sorting_date)).'</td>'.
						'<td>'.$value->pre_sorting_weight.'</td>'.
						'<td>'.$value->presorted_material_name.'</td>'.
						'<td>'.$value->username.'</td>'.
						'</tr>';
					$sumweight += $value->pre_sorting_weight;
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
