<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
//use Notifiable;
use \Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

	public $incrementing = true;
	public $timestamps = false;
	protected $table = "users";
	protected $primaryKey = "user_id";
	protected $fillable = ['user_company_id','user_microlocation_id','user_type_id','last_name', 'first_name', 'username', 'email', 'password','is_disabled'];

	public function user_type() {
		return $this->belongsTo(user_types::class,'user_type_id');
	}

	public function company() {
		return $this->belongsTo(company::class, 'company_id');
	}

	public function inventory_issue() {
		return $this->hasMany(inventory_issue::class,'user_id');
	}

	public function inventory_receipt() {
		return $this->hasMany(inventory_receipt::class,'user_id');
	}

	public function pre_sorting() {
		return $this->hasMany(pre_sorting::class,'user_id');
	}

	public function refined_sorting() {
		return $this->hasMany(refined_sorting::class,'user_id');
	}
}
