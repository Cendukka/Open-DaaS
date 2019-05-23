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
		if (Location::Create($request->all())) {
			return true;
		}
	}
	
	public function show(company $company) {
		return $company;
	}
	
	public function edit(Location $location) {
		//
	}
	
	public function update(Request $request, Location $location) {
		if ($location->fill($request->all())->save()) {
			return true;
		}
	}
	
	public function destroy(Location $location) {
		if ($location->delete()) {
			return true;
		}
	}
}
