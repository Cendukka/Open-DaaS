<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class company_controller extends Controller {
	public function index() {
		$allCompanies = DB::table('company')->get();
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
		return view('pages.company.company')->with('company', $company);;
		
		#$id = $company->company_id;
		#return redirect('companies/' . $id . '/warehouse')->with('company', $company);
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
	
	public function manage_index(company $company) {
		return view('pages.company.manage')->with('company', $company);
	}
	
	public function warehouse_index(company $company) {
		return view('pages.company.warehouse')->with('company', $company);
	}
	
	public function receipts_index(company $company) {
		return view('pages.company.receipts')->with('company', $company);
	}
	
	public function pre_index(company $company) {
		return view('pages.company.pre')->with('company', $company);
	}
	
	public function refined_index(company $company) {
		return view('pages.company.refined')->with('company', $company);
	}
	
	public function issues_index(company $company) {
		return view('pages.company.issues')->with('company', $company);
	}
}
