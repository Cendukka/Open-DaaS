<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_types extends Model
{
	protected $table = "status_types";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['Status_name'];
	
}