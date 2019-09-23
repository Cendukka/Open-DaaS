<?php

// This file is for exporting refined-sorting events.
// In this we select which columns we want and give them custom names

namespace App\Exports;

use App\company;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class refined_export implements ShouldAutoSize, FromCollection, WithHeadings {
    use Exportable;
    protected $company;

    public function __construct(company $company, Request $request) {
        $this->company = $company;
        $this->request = $request;
    }

    public function collection() {
        $company = $this->company;
        $request = $this->request;

        $data = app('App\Http\Controllers\refined_controller')
            ->query($request,$company)
            ->select('refined_date','microlocation_name','material_name','refined_weight','username')
            ->get();

        return $data;
    }

    public function headings(): array {
        return [
            'Päivämäärä',
            'Lähteen tyyppi',
            'Saapuneen tavaran lähde',
            'Saapuneen tavaran kohde',
            'Saapunut materiaali',
            'Paino (Kg)',
            'Matka (Km)',
            'EWC-Koodi'
        ];
    }
}