<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\user;

class user_controller extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(company $company) {
		return view('pages.company.manage.users')->with('company', $company);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(company $company) {
		return view('pages.company.manage.adduser')->with('company', $company);
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$request->validate([
			'user_type' => 'required|integer',
			'company' => 'required|integer',
			'microlocation' => 'required_unless:user_type_id,1,2|integer',
			'first_name'=>'required|max:50',
			'last_name'=> 'required|max:50',
			'username'=> 'required|unique:users|max:50',
			'password'=> 'required',
		]);
		
		
		$user = new user([
			'user_type_id' => $request->get('user_type'),
			'user_company_id' => $request->get('company'),
			'user_microlocation_id' => $request->get('microlocation'),
			'last_name' => $request->get('last_name'),
			'first_name' => $request->get('first_name'),
			'username' => $request->get('username'),
			'password' => $request->get('password'),
		]);
		$user->save();
		
		return redirect('/')->with('success', 'User has been added');
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(company $company,user $user) {
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(company $company, user $user) {
		return view('pages.company.manage.user')->with(['company' => $company, 'user' => $user]);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, company $company, user $user) {
		$request->validate([
			'user_type' => 'required|integer',
			'company' => 'required|integer',
			'microlocation' => 'required_unless:user_type_id,1,2|integer',
			'first_name'=>'required|max:50',
			'last_name'=> 'required|max:50',
			'username'=> 'required|unique:users|max:50',
			'password'=> 'required',
		]);
		
		
		$userNew = user::find($user->user_id);
			$user->user_type_id = $request->get('user_type');
			$user->user_company_id = $request->get('company');
			$user->user_microlocation_id = $request->get('microlocation');
			$user->last_name = $request->get('last_name');
			$user->first_name = $request->get('first_name');
			$user->username = $request->get('username');
			$user->password = $request->get('password');
			dd($userNew);
		#$user->save();
		
		return redirect('/')->with('success', 'User has been updated');
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
