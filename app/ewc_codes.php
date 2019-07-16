<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ewc_codes extends Model {
	public $incrementing = false;
	public $timestamps = false;
	protected $table = "ewc_codes";
	protected $primaryKey = "ewc_code";
	protected $fillable = ['ewc_code','description'];
	
	public function inventory_issue_details() {
		return $this->hasMany(inventory_issue_details::class,'detail_ewc_code','ewc_code');
	}
	
	public function inventory_receipt() {
		return $this->hasMany(inventory_receipt::class,'receipt_ewc_code','ewc_code');
	}
}