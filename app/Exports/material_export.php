<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use phpDocumentor\Reflection\Types\Array_;

class material_export implements ShouldAutoSize, FromCollection, WithHeadings
{
    use Exportable;
    public function collection()
    {
        $materialID = DB::table('inventory')->select('inventory_material_id')->count();

        $materialIDs = [];
        $data = [];
        for ($i = $materialID; $i <= 0; --$i) {
            foreach (DB::table('inventory')->where('inventory_material_id', $i)->get() as $ml) {
                array_push($materialIDs, $ml);
            }
        }

        return dd($materialIDs);
//        foreach ($materialIDs as $materialId){
//
//
//        }
//        $amount = DB::table('inventory')
//                            ->where('inventory_material_id' '=')
//                            ->select('inventory_material_id', 'inventory_weight')
//                            ->;

    }


    public function headings(): array {
        return [
            'Materiaali',
            'Määrä Kg'
        ];
    }
}
