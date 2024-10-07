<?php

namespace App\Models\Elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
	use HasFactory;
	protected $table = "siswas";
	protected $primaryKey = "id_siswa";
	protected $connection = "elearning";
	public $timestamps = false;

	public function kelas_siswa()
	{ 
		return $this->hasOne(KelasSiswa::class,'siswa_id','id_siswa');
	}
}
