<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amtv extends Model
{
    protected $table = "amtv";
    protected $primaryKey = "id_amtv";
    public $timestamps = false;

    public static function getPaginate() {
        return Amtv::where('status_amtv', true)
			->orderBy('id_amtv', 'DESC')
			->paginate(8);
    }
}
