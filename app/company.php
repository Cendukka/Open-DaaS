<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model {
	public $incrementing = true;
	protected $table = "company";
	protected $primaryKey = "company_id";
	protected $fillable = ['name', 'street_address', 'postal_code', 'city'];
	
	public function microlocations() {
		return $this->hasMany(microlocations::class, 'company_id');
	}
	
	public function users() {
		return $this->hasMany(users::class, 'company_id');
	}
	
	public function inventory_issue() {
		return $this->hasMany(inventory_issue::class,'company_id');
	}
	
	public function community() {
		return $this->hasMany(community::class,'company_id');
	}
}