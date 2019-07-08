<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class microlocation_types extends Model {
	public $incrementing = true;
	protected $table = "microlocation_types";
	protected $primaryKey = "microlocation_type_id";
	protected $fillable = ['typename'];
	
	public function microlocations() {
		return $this->hasMany(microlocations::class,'microlocation_type_id');
	}
}