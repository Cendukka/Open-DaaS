<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventory_receipt extends Model
{
	protected $table = "inventory_receipt";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['Distance_KM','Weight_KG','Date'];
	
}
