<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SIM extends Model
{
	use HasFactory;
	protected $table = "sim";
	protected $primaryKey = "id_sim";
	public $timestamps = false;

	public static function getSimPaginate() {
		return SIM::where('status',true)
			->orderBy('id_sim','desc')
			->paginate(12);
	}
}
