<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class textile_inventory extends Model {
	public $incrementing = true;
	protected $table = "textile_inventory";
	protected $primaryKey = "ID";
	protected $fillable = ['Fraction', 'Weight_KG'];
	
	public function inventory_issue_details() {
		return $this->hasMany(inventory_issue_details::class);
	}
	
	public function microlocations() {
		return $this->belongsTo(microlocations::class);
	}
	
	public function refined_sorting() {
		return $this->hasMany(refined_sorting::class);
	}
}
