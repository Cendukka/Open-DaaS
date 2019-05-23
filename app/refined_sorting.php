<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class refined_sorting extends Model
{
	protected $table = "refined_sorting";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['Weight_KG','Date'];
	
}