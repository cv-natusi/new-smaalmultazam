<?php

namespace App\Models\Elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = "kelas";
    protected $primaryKey = "id_kelas";
    protected $connection = "elearning";
    public $timestamps = false;

    public function guru() {
        return $this->belongsTo(Guru::class,'guru_id','id_guru');
    }

    public function kelas_siswa() {
        return $this->hasMany(KelasSiswa::class,'kelas_id','id_kelas');
    }

    public function kelas_mapel() {
        return $this->hasMany(KelasMapel::class,'kelas_id','id_kelas');
    }
}
