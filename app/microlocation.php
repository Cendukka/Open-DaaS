<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class microlocation extends Model {
	public $incrementing = true;
	public $timestamps = false;
	protected $table = "microlocations";
	protected $primaryKey = "microlocation_id";
	protected $fillable = ['microlocation_company_id','microlocation_type_id','microlocation_name', 'microlocation_street_address', 'microlocation_postal_code', 'microlocation_city'];
	
	public function company() {
		return $this->belongsTo(company::class, 'company_id');
	}
	
	public function microlocation_type() {
		return $this->belongsTo(microlocation_types::class,'microlocation_type_id');
	}
	
	public function inventory_issue() {
		return $this->hasMany(inventory_issue::class,'issue_microlocation_id');
	}
	
	public function inventory() {
		return $this->hasMany(inventory::class,'inventory_microlocation_id');
	}
	
	public function inventory_receipt() {
		return $this->hasMany(inventory_receipt::class,'receipt_microlocation_id');
	}
}