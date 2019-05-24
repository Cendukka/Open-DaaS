<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;

class company_controller extends Controller {
	public function index() {
		$allCompanies = company::all();
		return view('pages.companies')->with('allCompanies', $allCompanies);
	}
	
	public function create() {
		//
	}
	
	public function store(Request $request) {
		if (Request::Create($request->all())) {
			return true;
		}
	}
	
	public function show(company $company) {
		$allMicrolocations = $company->microlocations;
		return view('pages.microlocations')->with('allMicrolocations', $allMicrolocations);
	}
	
	public function edit(company $company) {
		//
	}
	
	public function update(Request $request, company $company) {
		if ($company->fill($request->all())->save()) {
			return true;
		}
	}
	
	public function destroy(company $company) {
		if ($company->delete()) {
			return true;
		}
	}
}
