<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class community extends Model {
	public $incrementing = true;
	protected $table = "community";
	protected $primaryKey = "ID";
	protected $fillable = ['City'];
	
	public function company() {
		return $this->belongsTo(company::class);
	}
	
	
}