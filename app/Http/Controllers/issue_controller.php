<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\inventory_issue;
use mysql_xdevapi\Collection;

class issue_controller extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(company $company) {
		return view('pages.company.manage.receipts')->with('company', $company);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(company $company) {
		return view('pages.company.manage.receipt_create')->with('company', $company);
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
			'datetime' => 'required|date_format:Y-m-d H:i:s',
			'source' => 'required',
			'from_microlocation' => 'required|integer',
			'to_microlocation' =>'required|integer',
			'distance' => 'required|integer',
			'weight' => 'required|integer',
			'ewc' => 'required|max:6|digits_between:0,9',
			'material' => 'required|integer',
		]);
		
		
		$receipt = new inventory_receipt([
			'receipt_material_id' => $request->get('material'),
			'receipt_from_microlocation_id' => $request->get('from_microlocation'),
			'receipt_to_microlocation_id' => $request->get('to_microlocation'),
			'distance_km' => $request->get('distance'),
			'receipt_weight' => $request->get('weight'),
			'receipt_date' => $request->get('datetime'),
			'receipt_ewc_code' => $request->get('ewc'),
			'receipt_user_id' => $request->get('user'),
		]);
		$receipt->save();
		return redirect()->action('receipt_controller@index', ['company' => $company])->withErrors(['Receipt successfully created.']);
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(company $company, receipt $receipt) {
		return redirect()->action('receipt_controller@index', ['company' => $company]);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(company $company, receipt $receipt) {
		return view('pages.company.manage.receipt_edit')->with(['company' => $company, 'receipt' => $receipt]);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, company $company, receipt $receipt) {
		# ADD MORE AUTHENTICATION HERE
		
		$request->validate([
			'user_type' => 'required|integer',
			'company' => 'required|integer',
			'microlocation' => 'nullable|integer',
			'first_name'=>'required|max:50',
			'last_name'=> 'required|max:50',
			'password'=> 'required',
		]);
		
		#####################
		$receiptNew = inventory_receipt::find($receipt->receipt_id);
		$receiptNew->user_type_id = $request->get('user_type');
		$receiptNew->user_company_id = $request->get('company');
		$receiptNew->user_microlocation_id = $request->get('microlocation');
		$receiptNew->last_name = $request->get('last_name');
		$receiptNew->first_name = $request->get('first_name');
		$receiptNew->password = $request->get('password');
		$receiptNew->save();
		
		
		
		return redirect()->action('receipt_controller@index',['company' => $company])->withErrors(['Receipt successfully updated.']);
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
						return $query->whereBetween('issue_date', [date("Y-m-d",strtotime($request->from)), date("Y-m-d",strtotime($request->to))]);
					})
					->where(function ($query) use ($request){
						$query
						->where('microlocation_name','LIKE','%'.$request->search."%")
						->orWhere('material_name','LIKE','%'.$request->search."%")
						->orWhere('issue_typename','LIKE','%'.$request->search."%");
					})
					->join('issue_types','inventory_issue.issue_type_id','=','issue_types.issue_type_id')
					->join('microlocations','issue_to_microlocation_id','=','microlocation_id')
					->join('inventory_issue_details','detail_issue_id','=','issue_id')
					->join('material_names','material_names.material_id','=','inventory_issue_details.detail_material_id')
					->orderBy('issue_from_microlocation_id')
					->orderBy('issue_date')
					->get();
			if($result){
				$lastId = 0;
				foreach ($result as $key => $value){
					if($value->issue_id == $lastId){
						continue;
					}
					$materials = DB::table('inventory_issue_details')
								->select('inventory_issue_details.detail_weight','material_names.material_name')
								->join('material_names','material_names.material_id','=','inventory_issue_details.detail_material_id')
								->where('detail_issue_id','=',$value->issue_id)
								->get();
					$material_list = '';
					foreach ($materials as $material){
						$material_list .= title_case($material->material_name).' '.$material->detail_weight.' kg <br>';
					}
					$output.='<tr>'.
						'<td>'.title_case($value->microlocation_name).'</td>'.
						'<td>'.title_case($value->issue_from_microlocation_id).'</td>'.
						'<td>'.$value->issue_date.'</td>'.
						'<td>'.$value->issue_user_id.'</td>'.
						'<td>'.$value->issue_typename.'</td>'.
						'<td>'.$material_list.'</td>'.
						'</tr>';
					$lastId = $value->issue_id;
				}
				return Response($output);
			}
		}
	}
}
