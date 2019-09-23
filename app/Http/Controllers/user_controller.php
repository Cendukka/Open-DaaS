<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\user;

class user_controller extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }


    public function index(company $company) {
        return view('pages.company.manage.users')->with('company', $company);
    }


    public function create(company $company) {
        return view('pages.company.manage.user_create')->with('company', $company);
    }


    public function store(Request $request, company $company) {
        $request->validate([
            'käyttäjätyyppi' => 'required|integer',
            'toimipiste' => 'required_if:user_type,==,3',
            'etunimi' => 'required|max:50',
            'sukunimi' => 'required|max:50',
            'username' => 'required|unique:users|max:50',
            'email' => 'required|unique:users|max:50',
        ]);

        $user = new user([
            'user_type_id' => $request->get('käyttäjätyyppi'),
            'user_company_id' => $company->company_id,
            'user_microlocation_id' => ($request->get('käyttäjätyyppi') >= 3 ? $request->get('toimipiste') : NULL),
            'last_name' => $request->get('sukunimi'),
            'first_name' => $request->get('etunimi'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => Hash::make('qwerty'),
            'is_disabled' => ($request->get('is_disabled') == 'on' ? 1 : 0),
        ]);
        $user->save();

//		if(DB::table('microlocations')->where('microlocation_company_id',$company->company_id)->count() == 0){
//            return redirect()->action('microlocation_controller@create', ['company' => $company]);
//        }
//        else{
        return redirect()->action('user_controller@index', ['company' => $company])->withErrors(['Käyttäjä luotu onnistuneesti']);
//        }
    }


    public function show(company $company, user $user) {
        return redirect()->action('user_controller@index', ['company' => $company]);
    }


    public function edit(company $company, user $user) {
        return view('pages.company.manage.user_edit')->with(['company' => $company, 'user' => $user]);
    }


    public function update(Request $request, company $company, user $user) {
        $request->validate([
            'user_type' => 'required|integer',
            'microlocation' => 'required_if:user_type,3',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
        ]);

        $userNew = user::find($user->user_id);

        $userNew->user_type_id = $request->get('user_type');
        $userNew->user_microlocation_id = ($request->get('user_type') >= 3 ? $request->get('microlocation') : NULL);
        $userNew->last_name = $request->get('last_name');
        $userNew->first_name = $request->get('first_name');
        $userNew->is_disabled = ($request->get('is_disabled') == 'on' ? 1 : 0);
        $userNew->save();

        return redirect()->action('user_controller@index', ['company' => $company])->withErrors(['Käyttäjä päivitetty onnistuneesti.']);
    }


    public function destroy($id) {
        //
    }
}
