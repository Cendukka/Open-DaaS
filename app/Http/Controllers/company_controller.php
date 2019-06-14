<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class company_controller extends Controller {
	public function index() {
		return view('pages.companies');
	}
	
	public function create() {
		return view('pages.company.manage.company_create');
	}
	
	public function store(Request $request) {
		# ADD MORE AUTHENTICATION HERE
		
		$request->validate([
			'name' => 'required|max:191',
			'address'=>'required|max:191',
			'postal_code'=> 'required|min:5|max:5|digits_between:0,9',
			'city'=> 'required|max:50',
		]);
		
		
		$company = new company([
			'company_name' => $request->get('name'),
			'company_street_address' => $request->get('address'),
			'company_postal_code' => $request->get('postal_code'),
			'company_city' => $request->get('city'),
		]);
		$company->save();
		return redirect()->action('company_controller@show', ['company' => $company])->withErrors(['Company successfully created.']);
	}
	
	public function show(company $company) {
		return view('pages.company.company_home')->with('company', $company);
		
		#$id = $company->company_id;
		#return redirect('companies/' . $id . '/warehouse')->with('company', $company);
	}
	
	public function edit(company $company) {
		return view('pages.company.manage.company_edit')->with('company', $company);
	}
	
	public function update(Request $request, company $company) {
		# ADD MORE AUTHENTICATION HERE
		
		$request->validate([
			'name' => 'required|max:191',
			'address'=>'required|max:191',
			'postal_code'=> 'required|min:5|max:5|digits_between:0,9',
			'city'=> 'required|max:50',
		]);
		
		$companyNew = company::find($company->company_id);
		$companyNew->company_name = $request->get('name');
		$companyNew->company_street_address = $request->get('address');
		$companyNew->company_postal_code = $request->get('postal_code');
		$companyNew->company_city = $request->get('city');
		$companyNew->save();
		
		return redirect()->action('company_controller@manage_index',['company' => $company])->withErrors(['Company successfully updated.']);
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
