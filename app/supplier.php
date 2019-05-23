<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
	protected $table = "supplier";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['Name','Street_address','Postal_code','City','Contact_person','Email','Phone_number'];
	
}