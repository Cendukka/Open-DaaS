<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pre_sorting extends Model
{
	protected $table = "pre_sorting";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['Recyclable_textile_KG','Date'];
	
}