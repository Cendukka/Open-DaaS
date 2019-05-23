<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class issue_types extends Model
{
	protected $table = "issue_types";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['Typename'];
	
}