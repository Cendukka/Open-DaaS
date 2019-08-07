<?php

namespace App\Exports;

use App\company;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class receipt_export implements ShouldAutoSize, FromCollection, WithHeadings {
    use Exportable;
    protected $company;

    public function __construct(company $company, Request $request) {
        $this->company = $company;
        $this->request = $request;
    }

    public function collection() {
        $company = $this->company;
        $request = $this->request;

        $data = app('App\Http\Controllers\receipt_controller')
            ->query($request,$company)
            ->select('receipt_date','to_microlocations.microlocation_name as to_microlocation_name','from_microlocations.microlocation_name as from_microlocation_name','community_city','from_supplier','material_name','receipt_weight','distance_km','receipt_ewc_code')
            ->get();

        return $data;
    }

    public function headings(): array {
        return [
            'Päivämäärä',
            'Vastaanottaja',
            'Lähettävä Mikrolokaatio',
            'Lähettävä Community',
            'Lähettävä Toimittaja',
            'Materiaali',
            'Paino (Kg)',
            'Matka (Km)',
            'EWC-Koodi'
        ];
    }
}