<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    
    protected $table = "alumni";
    protected $primaryKey = "id";
    // public $timestamps = false;
    protected $guarded = ['id'];

    // protected $fillable = [
    //     'nisn',
    //     'tahun_lulus',
    // ];
}
