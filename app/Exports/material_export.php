<?php

// This file is for exporting inventory values.
// In this we select which columns we want and give them custom names

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use phpDocumentor\Reflection\Types\Array_;

class material_export implements ShouldAutoSize, FromCollection, WithHeadings {
    use Exportable;
/*----------------------------------------------------------------------------------------------------------------------
        Fetches each textiles from inventory and sums their total amounts of every company
----------------------------------------------------------------------------------------------------------------------*/
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
