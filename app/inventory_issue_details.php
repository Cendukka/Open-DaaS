<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventory_issue_details extends Model
{
	protected $table = "inventory_issue_details";
	protected $primaryKey = "ID";
	public $incrementing = true;
	protected $fillable = ['Weight_KG'];
	
}
