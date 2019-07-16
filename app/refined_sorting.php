<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class refined_sorting extends Model {
	public $incrementing = true;
	public $timestamps = true;
	protected $table = "refined_sorting";
	protected $primaryKey = "refined_id";
	protected $fillable = ['refined_id', 'refined_receipt_id', 'pre_sorting_id', 'refined_material_id', 'refined_user_id', 'refined_weight', 'refined_date', 'description'];
	
	public function textile_inventory() {
		return $this->belongsTo(textile_inventory::class, 'textile inventory_id');
	}
	
	public function pre_sorting() {
		return $this->belongsTo(pre_sorting::class,'pre_sorting_id');
	}
	
	public function users() {
		return $this->belongsTo(users::class,'user_id');
	}
	
	public function receipt() {
		return $this->belongsTo(inventory_receipt::class,'inventory_receipt_id');
	}

	public function material() {
		return $this->belongsTo(material_names::class,'material_id');
	}
}