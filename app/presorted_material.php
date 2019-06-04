<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presorted_material extends Model {
	public $incrementing = true;
	protected $table = "status_types";
	protected $primaryKey = "status_type_id";
	protected $fillable = ['status_name'];
	
	public function pre_sorting() {
		return $this->hasMany(pre_sorting::class,'presorted_material_id');
	}
}