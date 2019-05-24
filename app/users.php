<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model {
	public $incrementing = true;
	protected $table = "users";
	protected $primaryKey = "ID";
	protected $fillable = ['Last_name', 'First_name', 'Username', 'Password'];
	
	public function user_types() {
		return $this->belongsTo(user_types::class);
	}
	
	public function company() {
		return $this->belongsTo(company::class);
	}
	
	public function inventory_issue() {
		return $this->hasMany(inventory_issue::class);
	}
	
	public function inventory_receipt() {
		return $this->hasMany(inventory_receipt::class);
	}
	
	public function pre_sorting() {
		return $this->hasMany(pre_sorting::class);
	}
	
	public function refined_sorting() {
		return $this->hasMany(refined_sorting::class);
	}
}