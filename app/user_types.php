<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_types extends Model {
	public $incrementing = true;
	protected $table = "user_types";
	protected $primaryKey = "ID";
	protected $fillable = ['Typename'];
	
	public function users() {
		return $this->hasMany(users::class);
	}
}