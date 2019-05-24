<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model {
	public $incrementing = true;
	protected $table = "company";
	protected $primaryKey = "ID";
	protected $fillable = ['Name', 'Street_address', 'Postal_code', 'City'];
	
	public function microlocations() {
		return $this->hasMany(microlocations::class);
	}
	
	public function users() {
		return $this->hasMany(users::class);
	}
	
	public function inventory_issue() {
		return $this->hasMany(inventory_issue::class);
	}
}