<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ewc_codes extends Model
{
	protected $table = "ewc_codes";
	protected $primaryKey = "ID";
	public $incrementing = false;
	protected $fillable = ['Description'];
	
}