<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryaSiswaFile extends Model
{
    use HasFactory;

    protected $table = 'karya_siswa_file';
    protected $primaryKey = 'id_karya_siswa_file';
}
