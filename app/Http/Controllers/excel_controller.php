<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\company;
use App\Exports\user_export;
use App\Imports\user_import;
use Maatwebsite\Excel\Facades\Excel;



class excel_controller extends Controller
{

    function index(company $company){
        $data = User::all();
        return view('pages.company.manage.users_excel', compact('data'))
            ->with('i', (request()->input('page',1)-1)*10)
            ->with('company',$company);
    }

    public function export_csv(company $company){
        $exporter = app()->makeWith(user_export::class, compact('company'));
        return $exporter ->download('users.xlsx', \Maatwebsite\Excel\Excel::XLSX);

    }
    public function import_csv(){
        Excel::import(new user_import, request()->file('file'));
        return back();
    }
}
