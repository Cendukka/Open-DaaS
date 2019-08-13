<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class company_controller extends Controller {
	public function __construct()
    {
        $this->middleware('auth');
    }
	public function index() {
		return view('pages.companies');
	}
	public function companyinfo(company $company) {
		$company=DB::table('company')->get();
	return view('includes.welcomepageHeader')->with('company', $company);
	}

	public function create() {
		return view('pages.company.manage.company_create');
	}


	public function store(Request $request) {
		# ADD MORE AUTHENTICATION HERE

		$request->validate([
			'nimi' => 'required|max:191',
			'katuosoite'=>'required|max:191',
			'postinumero'=> 'required|min:5|max:5|digits_between:0,9',
			'kaupunki'=> 'required|max:50',
		]);


		$company = new company([
			'company_name' => $request->get('nimi'),
			'company_street_address' => $request->get('katuosoite'),
			'company_postal_code' => $request->get('postinumero'),
			'company_city' => $request->get('kaupunki'),
            'is_disabled' => ($request->get('is_disabled') == 'on' ? 1 : 0),
		]);
		$company->save();
		return redirect()->action('user_controller@create', ['company' => $company]);
		#return redirect()->action('company_controller@show', ['company' => $company])->withErrors(['Company successfully created.']);
	}


	public function show(company $company) {
		//$company=Auth::user()->user_company_id;
		//dd($company);
		// $company=company::findorfail($company)->first();
		// if($company->company_id=== Auth::user()->user_company_id);
		// 		// dd($company);

		return view('pages.company.company_home')->with('company', $company);
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
        $companyNew->is_disabled = ($request->get('is_disabled') == 'on' ? 1 : 0);
		$companyNew->save();

		return redirect()->action('company_controller@manage_index',['company' => $company])->withErrors(['Organisaatio päivitetty']);

	}

	public function instructions(company $company){
        return view('pages.instructions')->with('company', $company);
    }

	public function destroy(company $company) {
		if ($company->delete()) {
			return true;
		}
	}


	public function manage_index(company $company) {

		return view('pages.company.company_home')->with('company', $company);
	}


	public function warehouse_index(company $company) {
	    		return view('pages.company.warehouse')->with('company', $company);
	}
}
