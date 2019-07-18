<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company;
use App\Exports\user_export;
use App\Exports\pre_export;
use Maatwebsite\Excel\Facades\Excel;



class excel_controller extends Controller {
    public function pre(company $company){
        $exporter = app()->makeWith(pre_export::class, compact('company'));
        return $exporter ->download('pre.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
