<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class community extends Model
{
	protected $table = "community";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['City'];
	
}