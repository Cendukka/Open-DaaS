<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventory_issue extends Model {
	public $incrementing = true;
    public $timestamps = false;
	protected $table = "inventory_issue";
	protected $primaryKey = "issue_id";
	protected $fillable = ['issue_from_microlocation_id','issue_to_microlocation_id','issue_type_id','issue_date','issue_user_id'];
	
	public function microlocations() {
		return $this->hasMany(microlocations::class);
	}
	
	public function inventory_issue_details() {
		return $this->hasMany(inventory_issue_details::class);
	}

	public function issue_type() {
		return $this->belongsTo(issue_types::class);
	}
	
	public function users() {
		return $this->belongsTo(users::class);
	}
}