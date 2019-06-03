<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pre_sorting extends Model {
	public $incrementing = true;
	protected $table = "pre_sorting";
	protected $primaryKey = "pre_sorting_id";
	protected $fillable = ['recyclable_textile_kg', 'date'];
	
	public function refined_sorting() {
		return $this->hasMany(refined_sorting::class,'pre_sorting_id');
	}
	
	public function users() {
		return $this->belongsTo(users::class,'user_id');
	}
	
	public function inventory_receipt() {
		return $this->belongsTo(inventory_receipt::class,'inventory_receipt_id');
	}
	
	public function status_types() {
		return $this->belongsTo(status_types::class,'status_type_id');
	}

	public function presorted_material() {
		return $this->belongsTo(presorted_material::class,'presorted_material_id');
	}
}