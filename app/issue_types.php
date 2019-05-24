<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class issue_types extends Model {
	public $incrementing = true;
	protected $table = "issue_types";
	protected $primaryKey = "ID";
	protected $fillable = ['Typename'];
	
	public function inventory_issue() {
		return $this->hasMany(inventory_issue::class);
	}
}