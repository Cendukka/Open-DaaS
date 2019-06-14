<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\inventory_receipt;

class receipt_controller extends Controller {
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
}
