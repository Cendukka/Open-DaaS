<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class microlocation_types extends Model {
	public $incrementing = true;
	protected $table = "microlocation_types";
	protected $primaryKey = "ID";
	protected $fillable = ['Typename'];
	
	public function microlocations() {
		return $this->hasMany(microlocations::class);
	}
}