<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ewc_codes extends Model {
	public $incrementing = false;
	protected $table = "ewc_codes";
	protected $primaryKey = "ID";
	protected $fillable = ['Description'];
	
	public function inventory_issue_details() {
		return $this->hasMany(inventory_issue_details::class);
	}
	
	public function inventory_receipt() {
		return $this->hasMany(inventory_receipt::class);
	}
}