<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventory_receipt extends Model {
	public $incrementing = true;
	protected $table = "inventory_receipt";
	protected $primaryKey = "ID";
	protected $fillable = ['Distance_KM', 'Weight_KG', 'Date'];
	
	public function ewc_codes() {
		return $this->belongsTo(ewc_codes::class);
	}
	
	public function community() {
		return $this->belongsTo(community::class);
	}
	
	public function company() {
		return $this->belongsTo(company::class);
	}
	
	public function users() {
		return $this->belongsTo(users::class);
	}
	
	public function supplier() {
		return $this->belongsTo(supplier::class);
	}
	
	public function microlocations() {
		return $this->belongsTo(microlocations::class);
	}
	
	public function pre_sorting() {
		return $this->hasMany(pre_sorting::class);
	}
	
	public function refined_sorting() {
		return $this->hasMany(refined_sorting::class);
	}
}