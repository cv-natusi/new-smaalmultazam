<?php

namespace App\Models\Elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriShare extends Model
{
	use HasFactory;
	protected $table = "materi_share";
	protected $primaryKey = "id_materi";
	protected $connection = "elearning";
	public $timestamps = false;

	public function mata_pelajaran()
	{
		return $this->belongsTo(MataPelajaran::class, 'mapel_id', 'id_mapel');
	}
}
