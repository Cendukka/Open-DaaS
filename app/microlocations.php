<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class microlocations extends Model {
	public $incrementing = true;
	protected $table = "microlocations";
	protected $primaryKey = "microlocation_id";
	protected $fillable = ['name', 'street_address', 'postal_code', 'city'];
	
	public function company() {
		return $this->belongsTo(company::class, 'company_id');
	}
	
	public function microlocation_types() {
		return $this->belongsTo(microlocation_types::class,'microlocation_type_id');
	}
	
	public function inventory_issue() {
		return $this->hasMany(inventory_issue::class,'microlocation_id');
	}
	
	public function textile_inventory() {
		return $this->hasMany(textile_inventory::class,'microlocation_id');
	}
	
	public function inventory_receipt() {
		return $this->hasMany(inventory_receipt::class,'microlocation_id');
	}
}