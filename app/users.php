<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
	protected $table = "users";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['Last_name','First_name','Username','Password'];
	
}