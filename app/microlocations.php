<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class microlocations extends Model {
	public $incrementing = true;
	protected $table = "microlocations";
	protected $primaryKey = "ID";
	protected $fillable = ['Name', 'Street_address', 'Postal_code', 'City'];
	
	public function company() {
		return $this->belongsTo(company::class);
	}
	
	public function microlocation_types() {
		return $this->belongsTo(microlocation_types::class);
	}
	
	public function inventory_issue() {
		return $this->hasMany(inventory_issue::class);
	}
	
	public function textile_inventory() {
		return $this->hasMany(textile_inventory::class);
	}
	
	public function inventory_receipt() {
		return $this->hasMany(inventory_receipt::class);
	}
}