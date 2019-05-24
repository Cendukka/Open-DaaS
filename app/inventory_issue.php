<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventory_issue extends Model {
	public $incrementing = true;
	protected $table = "inventory_issue";
	protected $primaryKey = "ID";
	protected $fillable = ['Date'];
	
	public function microlocations() {
		return $this->hasMany(microlocations::class);
	}
	
	public function inventory_issue_details() {
		return $this->hasMany(inventory_issue_details::class);
	}
	
	public function company() {
		return $this->belongsTo(company::class);
	}
	
	public function ewc_code() {
		return $this->belongsTo(ewc_codes::class);
	}
	
	public function issue_type() {
		return $this->belongsTo(issue_types::class);
	}
	
	public function users() {
		return $this->belongsTo(users::class);
	}
}