<?php

namespace App\Models\Elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
	use HasFactory;
	protected $table = "mata_pelajaran";
	protected $primaryKey = "id_mapel";
	protected $connection = "elearning";
	public $timestamps = false;

	public function materi_share()
	{
		return $this->hasMany(MateriShare::class, 'mapel_id', 'id_mapel');
	}

	public function kelas_mapel()
	{
		return $this->hasMany(KelasMapel::class, 'mapel_id', 'id_mapel');
	}
}
