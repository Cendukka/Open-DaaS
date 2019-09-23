<?php

// This file contains functions for exporting documents possible

namespace App\Http\Controllers;

use App\company;
use App\Exports\material_export;
use App\Exports\pre_export;
use App\Exports\refined_export;
use App\Exports\receipt_export;
use App\Exports\issue_export;

class excel_controller extends Controller {
    public function pre(company $company) {
        $exporter = app()->makeWith(pre_export::class, compact('company'));
        return $exporter->download('pre.csv');
    }


    public function refined(company $company) {
        $exporter = app()->makeWith(refined_export::class, compact('company'));
        return $exporter->download('refined.csv');
    }


    public function receipt(company $company) {
        $exporter = app()->makeWith(receipt_export::class, compact('company'));
        return $exporter->download('receipt.csv');
    }


    public function issue(company $company) {
        $exporter = app()->makeWith(issue_export::class, compact('company'));
        return $exporter->download('issue.csv');
    }


    public function materials() {
        $exporter = app()->makeWith(material_export::class);
        return $exporter->download('materialsOpenData.csv');
    }
}
