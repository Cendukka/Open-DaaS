<?php

use Illuminate\Database\Seeder;

class inventory_table_seeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
		$microlocations = DB::table('microlocations')->get();
		$materials = DB::table('material_names')->whereIn('material_type',['textile','raw waste','refined'])->get();
        $allMaterials = DB::table('material_names')->orderBy('material_id')->get();
		
		foreach ($microlocations as $ml) {
		    # Make an empty table for all materials
		    $sum = [];
            foreach($allMaterials as $mat){
                $sum[$mat->material_id] = 0;
            }

            # Calculate pre sorted weights
            $pre_sorting = DB::table('pre_sorting')
                ->join('inventory_receipt','pre_sorting_receipt_id','=','receipt_id')
                ->where('receipt_to_microlocation_id',$ml->microlocation_id)
                ->get();
            foreach($pre_sorting as $pre){
                $sum['1'] -= $pre->pre_sorting_weight;
                $sum[$pre->pre_sorting_material_id] += $pre->pre_sorting_weight;
            }

            # Calculate refined sorted weights
            $refined_sorting = DB::table('refined_sorting')
                ->leftJoin('pre_sorting','refined_sorting.pre_sorting_id','pre_sorting.pre_sorting_id')
                ->leftJoin('inventory_receipt', function($join){
                    $join->on('pre_sorting.pre_sorting_receipt_id', '=', 'inventory_receipt.receipt_id')
                        ->orOn('refined_sorting.refined_receipt_id', '=', 'inventory_receipt.receipt_id');
                })
                ->where('receipt_to_microlocation_id',$ml->microlocation_id)
                ->get();
            foreach($refined_sorting as $ref){
                $sum['2'] -= $ref->refined_weight;
                $sum[$ref->refined_material_id] += $ref->refined_weight;
            }

			foreach ($materials as $mat) {
			    $receipt_weight = DB::table('inventory_receipt')
                    ->where('receipt_material_id',$mat->material_id)
                    ->where('receipt_to_microlocation_id',$ml->microlocation_id)
                    ->select('receipt_weight')
                    ->sum('receipt_weight');

			    $issue_weight = DB::table('inventory_issue')
                    ->join('inventory_issue_details','issue_id','=','detail_issue_id')
                    ->where('detail_material_id',$mat->material_id)
                    ->where('issue_from_microlocation_id',$ml->microlocation_id)
                    ->select('detail_weight')
                    ->sum('detail_weight');

				DB::table('inventory')->insert([
					'inventory_microlocation_id' => $ml->microlocation_id,
					'inventory_material_id' => $mat->material_id,
					'inventory_weight' => $receipt_weight - $issue_weight + $sum[$mat->material_id],
				]);
			}
		}
    }
}
