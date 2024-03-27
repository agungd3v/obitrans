<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
	use HasFactory;

	public function type() {
		return $this->belongsTo(Type::class, "type_id", "id");
	}

	public function branch() {
		return $this->belongsTo(Branch::class, "branch_id", "id");
	}
}
