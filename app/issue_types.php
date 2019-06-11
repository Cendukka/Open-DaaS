<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class issue_types extends Model {
	public $incrementing = true;
	protected $table = "issue_types";
	protected $primaryKey = "issue_type_id";
	protected $fillable = ['typename'];
	
	public function inventory_issue() {
		return $this->hasMany(inventory_issue::class);
	}
}