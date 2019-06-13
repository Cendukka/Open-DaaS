<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class material extends Model {
	public $incrementing = true;
	public $timestamps = false;
	protected $table = "material_names";
	protected $primaryKey = "material_id";
	protected $fillable = ['material_name'];
	
	public function inventory() {
		return $this->hasMany(inventory::class, 'inventory_material_id');
	}
	
	public function receipt() {
		return $this->hasMany(inventory_receipt::class, 'receipt_material_id');
	}
	
	public function detail() {
		return $this->hasMany(inventory_issue_details::class,'detail_material_id');
	}
}