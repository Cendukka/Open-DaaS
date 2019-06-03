<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_types extends Model {
	public $incrementing = true;
	protected $table = "status_types";
	protected $primaryKey = "status_type_id";
	protected $fillable = ['status_name'];
	
	public function pre_sorting() {
		return $this->hasMany(pre_sorting::class,'status_type_id');
	}
	
	public function refined_sorting() {
		return $this->hasMany(refined_sorting::class,'status_type_id');
	}
}