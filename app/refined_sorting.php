<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class refined_sorting extends Model {
	public $incrementing = true;
	protected $table = "refined_sorting";
	protected $primaryKey = "ID";
	protected $fillable = ['Weight_KG', 'Date'];
	
	public function textile_inventory() {
		return $this->belongsTo(textile_inventory::class);
	}
	
	public function pre_sorting() {
		return $this->belongsTo(pre_sorting::class);
	}
	
	public function users() {
		return $this->belongsTo(users::class);
	}
	
	public function inventory_receipt() {
		return $this->belongsTo(inventory_receipt::class);
	}
	
	public function status_types() {
		return $this->belongsTo(status_types::class);
	}
}