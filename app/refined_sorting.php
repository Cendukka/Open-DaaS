<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class refined_sorting extends Model {
	public $incrementing = true;
	protected $table = "refined_sorting";
	protected $primaryKey = "refined_sorting_id";
	protected $fillable = ['weight_kg', 'date'];
	
	public function textile_inventory() {
		return $this->belongsTo(textile_inventory::class, 'textile inventory_id');
	}
	
	public function pre_sorting() {
		return $this->belongsTo(pre_sorting::class,'pre_sorting_id');
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
}