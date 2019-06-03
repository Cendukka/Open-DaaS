<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class community extends Model {
	public $incrementing = true;
	protected $table = "community";
	protected $primaryKey = "community_id";
	protected $fillable = ['city'];
	
	public function company() {
		return $this->belongsTo(company::class,'company_id');
	}
	
	
}