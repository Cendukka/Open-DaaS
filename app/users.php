<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model {
	public $incrementing = true;
	protected $table = "users";
	protected $primaryKey = "user_id";
	protected $fillable = ['last_name', 'first_name', 'username', 'password'];
	
	public function user_types() {
		return $this->belongsTo(user_types::class,'user_type_id');
	}
	
	public function company() {
		return $this->belongsTo(company::class, 'company_id');
	}
	
	public function inventory_issue() {
		return $this->hasMany(inventory_issue::class,'user_id');
	}
	
	public function inventory_receipt() {
		return $this->hasMany(inventory_receipt::class,'user_id');
	}
	
	public function pre_sorting() {
		return $this->hasMany(pre_sorting::class,'user_id');
	}
	
	public function refined_sorting() {
		return $this->hasMany(refined_sorting::class,'user_id');
	}
}