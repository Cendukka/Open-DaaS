<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class microlocations extends Model
{
	protected $table = "microlocations";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['Name','Street_address','Postal_code','City'];
	
}