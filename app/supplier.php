<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model {
	public $incrementing = true;
	protected $table = "supplier";
	protected $primaryKey = "supplier_id";
	protected $fillable = ['name', 'street_address', 'postal_code', 'city', 'contact_person', 'email', 'phone_number'];
	
	public function inventory_receipt() {
		return $this->hasMany(inventory_receipt::class,'supplier_id');
	}
}