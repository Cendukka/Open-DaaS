<?php

namespace App\Http\Controllers;

use App\company;
use App\Exports\pre_export;
use App\Exports\refined_export;
use App\Exports\receipt_export;
use App\Exports\issue_export;



class excel_controller extends Controller {
    public function pre(company $company){
        $exporter = app()->makeWith(pre_export::class, compact('company'));
        return $exporter ->download('pre.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }


    public function refined(company $company){
        $exporter = app()->makeWith(refined_export::class, compact('company'));
        return $exporter ->download('refined.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }


    public function receipt(company $company){
        $exporter = app()->makeWith(receipt_export::class, compact('company'));
        return $exporter ->download('receipt.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }


    public function issue(company $company){
        $exporter = app()->makeWith(issue_export::class, compact('company'));
        return $exporter ->download('issue.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
