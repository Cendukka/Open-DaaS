<?php

// This file is for exporting issue events.
// In this we select which columns we want and give them custom names

namespace App\Exports;

use App\company;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class issue_export implements ShouldAutoSize, FromCollection, WithHeadings {
    use Exportable;
    protected $company;

    public function __construct(company $company, Request $request) {
        $this->company = $company;
        $this->request = $request;
    }

    public function collection() {
        $company = $this->company;
        $request = $this->request;

        $data = app('App\Http\Controllers\issue_controller')
            ->query($request,$company)
            ->select('issue_date','from_microlocations.microlocation_name as from_microlocation','issue_typename','to_microlocations.microlocation_name as to_microlocation','company_name','users.username','sumweight')
            ->get();

        return $data;
    }

    public function headings(): array {
        return [
            'Päivämäärä',
            'Lähetyksen lähde',
            'Lähetyksen tyyppi',
            'Lähetyksen kohde',
            'Lähetyksen kohde',
            'Kirjauksen tekijä',
            'Määrä (Kg)'
        ];
    }
}
