<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sorted_waste extends Model
{
	protected $table = "sorted_waste";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['Waste_name','Weight_KG'];
	
}