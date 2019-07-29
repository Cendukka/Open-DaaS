<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventory_receipt extends Model {
	public $incrementing = true;
	public $timestamps = true;
	protected $table = "inventory_receipt";
	protected $primaryKey = "receipt_id";
	protected $fillable = ['receipt_material_id','from_company_id','from_community_id','from_supplier','receipt_from_microlocation_id','receipt_to_microlocation_id',
		'distance_km','receipt_weight','receipt_date','receipt_ewc_code','receipt_user_id'];
	
	public function ewc_code() {
		return $this->belongsTo(ewc_codes::class,'ewc_code','receipt_ewc_code');
	}
	
	public function from_community() {
		return $this->belongsTo(community::class,'community_id','from_community_id');
	}
	
	public function from_company() {
		return $this->belongsTo(company::class,'company_id','from_company_id');
	}
	
	public function from_microlocation() {
		return $this->belongsTo(microlocations::class,'microlocation_id','from_microlocation_id_id');
	}
	
	public function to_microlocation() {
		return $this->belongsTo(microlocations::class,'microlocation_id','to_microlocation_id_id');
	}
	
	public function user() {
		return $this->belongsTo(users::class,'user_id','receipt_user_id');
	}
	
	public function pre_sorting() {
		return $this->hasMany(pre_sorting::class);
	}
	
	public function refined_sorting() {
		return $this->hasMany(refined_sorting::class);
	}
}