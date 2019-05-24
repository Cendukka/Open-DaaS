<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventory_issue_details extends Model {
	public $incrementing = true;
	protected $table = "inventory_issue_details";
	protected $primaryKey = "ID";
	protected $fillable = ['Weight_KG'];
	
	public function inventory_issue() {
		return $this->belongsTo(inventory_issue::class);
	}
	
	public function textile_inventory() {
		return $this->belongsTo(textile_inventory::class);
	}
	
	public function ewc_codes() {
		return $this->belongsTo(ewc_codes::class);
	}
}
