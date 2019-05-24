<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pre_sorting extends Model {
	public $incrementing = true;
	protected $table = "pre_sorting";
	protected $primaryKey = "ID";
	protected $fillable = ['Recyclable_textile_KG', 'Date'];
	
	public function refined_sorting() {
		return $this->hasMany(refined_sorting::class);
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