<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reels extends Model
{
    protected $table = "reels";
    protected $primaryKey = "id_reels";
    public $timestamps = false;

    public static function getPaginate() {
        return Reels::where('status_reels', true)
			->orderBy('id_reels', 'DESC')
			->paginate(8);
    }
}
