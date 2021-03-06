<?php

// This file contains functions for controlling communities

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
		$request->validate([
			'city'=> 'required|max:50',
		]);

		$communityNew = new community([
			'community_company_id' => $company->company_id,
			'community_city' => $request->get('city'),
            'is_disabled' => ($request->get('is_disabled') == 'on' ? 1 : 0),
		]);
		$communityNew->save();
		return redirect()->action('community_controller@index', ['company' => $company])->withErrors(['Kunta rekisteröity onnistuneesti']);
	}


	public function show(company $company,community $community) {
		return redirect()->action('community_controller@index', ['company' => $company]);
	}


	public function edit(company $company, community $community) {
		return view('pages.company.manage.community_edit')->with(['company' => $company, 'community' => $community]);
	}


	public function update(Request $request, company $company, community $community) {
		$request->validate([
			'city'=> 'required|max:50',
		]);

		$communityNew = community::find($community->community_id);

		$communityNew->community_city = $request->get('city');
        $communityNew->is_disabled = ($request->get('is_disabled') == 'on' ? 1 : 0);
		$communityNew->save();

		return redirect()->action('community_controller@index',['company' => $company])->withErrors(['Kunnan tiedot päivitetty onnistuneesti.']);
	}


    public function destroy($id){
        //
    }
}
