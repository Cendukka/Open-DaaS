<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\user;

class user_controller extends Controller {


	public function index(company $company) {
		return view('pages.company.manage.users')->with('company', $company);
	}


	public function create(company $company) {
		return view('pages.company.manage.user_create')->with('company', $company);
	}


	public function store(Request $request, company $company) {
		# ADD MORE AUTHENTICATION HERE
		
		$request->validate([
			'user_type' => 'required|integer',
            'microlocation' => 'required_if:user_type,3',
			'first_name'=>'required|max:50',
			'last_name'=> 'required|max:50',
			'username'=> 'required|unique:users|max:50',
			'email'=> 'required|unique:users|max:50',
		]);
		
		$user = new user([
			'user_type_id' => $request->get('user_type'),
			'user_company_id' => $company->company_id,
			'user_microlocation_id' => ($request->get('user_type') > 2 ? $request->get('microlocation') : NULL),
			'last_name' => $request->get('last_name'),
			'first_name' => $request->get('first_name'),
			'username' => $request->get('username'),
			'email' => $request->get('email'),
			'password' => Hash::make('qwerty'),
		]);
		$user->save();
		return redirect()->action('user_controller@index', ['company' => $company])->withErrors(['User successfully created.']);
	}


	public function show(company $company, user $user) {
		return redirect()->action('user_controller@index', ['company' => $company]);
	}


	public function edit(company $company, user $user) {
		return view('pages.company.manage.user_edit')->with(['company' => $company, 'user' => $user]);
	}


	public function update(Request $request, company $company, user $user) {
		# ADD MORE AUTHENTICATION HERE

        # TODO Passowrd saving needs more work

		$request->validate([
			'user_type' => 'required|integer',
			'microlocation' => 'required_if:user_type,3',
			'first_name'=>'required|max:50',
			'last_name'=> 'required|max:50',
		]);
		
		
		$userNew = user::find($user->user_id);

		$userNew->user_type_id = $request->get('user_type');
		$userNew->user_microlocation_id = ($request->get('user_type') > 2 ? $request->get('microlocation') : NULL);
		$userNew->last_name = $request->get('last_name');
		$userNew->first_name = $request->get('first_name');
		#$userNew->password = Hash::make($request->get('password'));
		$userNew->save();
		
		
		
		return redirect()->action('user_controller@index',['company' => $company])->withErrors(['User successfully updated.']);
	}


	public function destroy($id) {
		//
	}
}
