<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class company_manage_controller extends Controller {
	
	public function microlocations_index(company $company) {
		return view('pages.company.manage.microlocations')->with('company', $company);
	}
	
	public function users_index(company $company) {
		return view('pages.company.manage.users')->with('company', $company);
	}
}
