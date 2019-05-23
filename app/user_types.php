<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_types extends Model
{
	protected $table = "user_types";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['Typename'];
	
}