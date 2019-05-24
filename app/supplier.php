<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model {
	public $incrementing = true;
	protected $table = "supplier";
	protected $primaryKey = "ID";
	protected $fillable = ['Name', 'Street_address', 'Postal_code', 'City', 'Contact_person', 'Email', 'Phone_number'];
	
	public function inventory_receipt() {
		return $this->hasMany(inventory_receipt::class);
	}
}