<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_types extends Model {
	public $incrementing = true;
	protected $table = "user_types";
	protected $primaryKey = "user_type_id";
	protected $fillable = ['typename'];
	
	public function users() {
		return $this->hasMany(users::class,'user_type_id');
	}
}