<?php

namespace App\Models\Elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{
	use HasFactory;
	protected $table = "kelas_siswa";
	protected $primaryKey = "id_kelas_siswa";
	protected $connection = "elearning";
	public $timestamps = false;

	public function siswa() {
		return $this->belongsTo(Siswa::class,'siswa_id','id_siswa');
	}

	public function kelas() {
		return $this->belongsTo(Kelas::class,'kelas_id','id_kelas');
	}
}
