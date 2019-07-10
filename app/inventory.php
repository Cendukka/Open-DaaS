<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventory extends Model {
	public $incrementing = true;
	protected $table = "inventory";
	protected $primaryKey = "inventory_id";
	protected $fillable = ['inventory_microlocation_id','inventory_material_id', 'inventory_weight'];
	
	public function microlocation() {
		return $this->belongsTo(microlocations::class,'microlocation_id');
	}
	
	public function refined_sorting() {
		return $this->belongsTo(material_names::class,'material_id');
	}
}
