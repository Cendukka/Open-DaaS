<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\community;

class community_controller extends Controller {


	public function index(company $company) {
		return view('pages.company.manage.communities')->with('company', $company);
	}


	public function create(company $company) {
		return view('pages.company.manage.community_create')->with('company', $company);
	}


	public function store(Request $request, company $company) {
		# ADD MORE AUTHENTICATION HERE

		$request->validate([
			'city'=> 'required|max:50',
		]);
		
		
		$communityNew = new community([
			'community_company_id' => $company->company_id,
			'community_city' => $request->get('city'),
		]);
		$communityNew->save();
		return redirect()->action('community_controller@index', ['company' => $company])->withErrors(['Community successfully created.']);
	}


	public function show(company $company,community $community) {
		return redirect()->action('community_controller@index', ['company' => $company]);
	}


	public function edit(company $company, community $community) {
		return view('pages.company.manage.community_edit')->with(['company' => $company, 'community' => $community]);
	}


	public function update(Request $request, company $company, community $community) {
		# ADD MORE AUTHENTICATION HERE

		$request->validate([
			'city'=> 'required|max:50',
		]);
		
		$communityNew = community::find($community->community_id);

		$communityNew->community_city = $request->get('city');
		$communityNew->save();
		
		return redirect()->action('community_controller@index',['company' => $company])->withErrors(['Community successfully updated.']);
	}


    public function destroy($id){
        //
    }
}
