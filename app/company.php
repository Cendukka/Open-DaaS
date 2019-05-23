<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
	protected $table = "company";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['Name','Street_address','Postal_code','City'];
	
}