<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class microlocation_types extends Model
{
	protected $table = "microlocation_types";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['Typename'];
	
}