<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class textile_inventory extends Model {
	public $incrementing = true;
	protected $table = "textile_inventory";
	protected $primaryKey = "textile_inventory_id";
	protected $fillable = ['fraction', 'weight_kg'];
	
	public function inventory_issue_details() {
		return $this->hasMany(inventory_issue_details::class, 'textile_inventory_id');
	}
	
	public function microlocations() {
		return $this->belongsTo(microlocations::class,'microlocation_type_id');
	}
	
	public function refined_sorting() {
		return $this->hasMany(refined_sorting::class,'refined_sorting_id');
	}
}
