<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class community extends Model {
	public $incrementing = true;
	public $timestamps = false;
	protected $table = "community";
	protected $primaryKey = "community_id";
	protected $fillable = ['community_company_id','community_city'];
	
	public function company() {
		return $this->belongsTo(company::class,'company_id');
	}
	
	
}