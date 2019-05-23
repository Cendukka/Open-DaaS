<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventory_issue extends Model
{
	protected $table = "inventory_issue";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['Date'];
	
}