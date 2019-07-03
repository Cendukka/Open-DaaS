<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pre_sorting extends Model {
	public $incrementing = true;
	public $timestamps = true;
	protected $table = "pre_sorting";
	protected $primaryKey = "pre_sorting_id";
	protected $fillable = ['pre_sorting_user_id', 'pre_sorting_date', 'pre_sorting_receipt_id', 'presorted_material_id', 'pre_sorting_weight'];
	
	public function refined_sorting() {
		return $this->hasMany(refined_sorting::class,'pre_sorting_id');
	}
	
	public function users() {
		return $this->belongsTo(users::class,'user_id','receipt_user_id');
	}
	
	public function receipt() {
		return $this->belongsTo(inventory_receipt::class,'receipt_id','pre_sorting_receipt_id');
	}

	public function presorted_material() {
		return $this->belongsTo(presorted_material::class,'presorted_material_id','presorted_material_id');
	}
}

