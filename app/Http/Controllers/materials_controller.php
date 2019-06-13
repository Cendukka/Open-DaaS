<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\material;

class materials_controller extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(material $material) {
		return view('pages.materials');
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(material $material) {
		return view('pages.materials.materials_create');
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, material $material) {
		# ADD MORE AUTHENTICATION HERE
		
		#$request->validate([
		#	'company' => 'required|integer',
		#	'type' => 'required|integer',
		#	'name' => 'max:191',
		#	'address'=>'required|max:191',
		#	'postal_code'=> 'required|min:5|max:5|digits_between:0,9',
		#	'city'=> 'required|max:50',
		#]);
		#
		#
		#$ml = new microlocation([
		#	'microlocation_company_id' => $request->get('company'),
		#	'microlocation_type_id' => $request->get('type'),
		#	'microlocation_name' => $request->get('name'),
		#	'microlocation_street_address' => $request->get('address'),
		#	'microlocation_postal_code' => $request->get('postal_code'),
		#	'microlocation_city' => $request->get('city'),
		#]);
		#$ml->save();
		#return redirect()->action(
		#	'microlocation_controller@index', ['company' => $company]
		#);
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(material $material) {
		return view('pages.materials_edit')->with('material',$material);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	#public function edit(company $company, microlocation $microlocation) {
	#	return view('pages.company.manage.microlocation_edit')->with(['company' => $company, 'microlocation' => $microlocation]);
	#}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, company $company, microlocation $microlocation) {
		# ADD MORE AUTHENTICATION HERE
		
		#$request->validate([
		#	'company' => 'required|integer',
		#	'type' => 'required|integer',
		#	'name' => 'max:191',
		#	'address'=>'required|max:191',
		#	'postal_code'=> 'required|min:5|max:5|digits_between:0,9',
		#	'city'=> 'required|max:50',
		#]);
		#
		#
		#$microlocationNew = microlocation::find($microlocation->microlocation_id);
		#
		#$microlocationNew->microlocation_company_id = $request->get('company');
		#$microlocationNew->microlocation_type_id = $request->get('type');
		#$microlocationNew->microlocation_name = $request->get('name');
		#$microlocationNew->microlocation_street_address = $request->get('address');
		#$microlocationNew->microlocation_postal_code = $request->get('postal_code');
		#$microlocationNew->microlocation_city = $request->get('city');
		#$microlocationNew->save();
		#
		#return redirect()->action('microlocation_controller@index',['company' => $company]);
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
