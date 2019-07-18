<?php

namespace App\Exports;

use App\company;
use App\pre_sorting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class pre_export implements ShouldAutoSize, FromCollection, WithHeadings {
    use Exportable;
    protected $company;

    public function __construct(company $company, Request $request) {
        $this->company = $company;
        $this->request = $request;
    }

    public function collection() {
        $company = $this->company;
        $request = $this->request;

        $data = app('App\Http\Controllers\pre_controller')
            ->query($company, $request)
            ->select('pre_sorting_date','microlocation_name','material_name','pre_sorting_weight','username')
            ->get();

        return $data;
    }

    public function headings(): array {
        return [
            'Aikaleima',
            'Microlokaatio',
            'Materiaali',
            'Paino (Kg)',
            'Käyttäjä',
        ];
    }
}