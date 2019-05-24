<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_types extends Model {
	public $incrementing = true;
	protected $table = "status_types";
	protected $primaryKey = "ID";
	protected $fillable = ['Status_name'];
	
	public function pre_sorting() {
		return $this->hasMany(pre_sorting::class);
	}
	
	public function refined_sorting() {
		return $this->hasMany(refined_sorting::class);
	}
}