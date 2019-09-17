<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use phpDocumentor\Reflection\Types\Array_;

class material_export implements ShouldAutoSize, FromCollection, WithHeadings {
    use Exportable;

    public function collection() {
        $data = DB::table('inventory')
            ->join('material_names','inventory_material_id','=','material_names.material_id')
            ->groupBy('material_name')
            ->select('material_name',DB::raw('SUM(inventory_weight) as sumweight'))
            ->get();
        return $data;
    }


    public function headings(): array {
        return [
            'Materiaali',
            'Määrä Kg'
        ];
    }
}
