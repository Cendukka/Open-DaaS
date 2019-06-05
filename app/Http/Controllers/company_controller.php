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
		$id = $company->company_id;
		return redirect('companies/' . $id . '/warehouse')->with('company', $company);
		#return Redirect::to('/companies/'.$id);
		#return view('pages.company.warehouse');
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
	
	public function sorting_index(company $company) {
		return view('pages.company.sorting')->with('company', $company);
	}
	
	public function sorted_index(company $company) {
		return view('pages.company.sorted')->with('company', $company);
	}
	
	public function issues_index(company $company) {
		return view('pages.company.issues')->with('company', $company);
	}
}
