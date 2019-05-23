<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class textile_inventory extends Model
{
	protected $table = "textile_inventory";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['Fraction','Weight_KG'];
	
}
