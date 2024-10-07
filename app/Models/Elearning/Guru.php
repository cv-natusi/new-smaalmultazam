<?php

namespace App\Models\Elearning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
	use HasFactory;
	protected $table = "gurus";
	protected $primaryKey = "id_guru";
	protected $connection = "elearning";
	public $timestamps = false;

	public function kelas_mapel()
	{
		return $this->hasMany(KelasMapel::class, 'guru_id', 'id_guru');
	}

	public function kelas() {
		return $this->hasMany(Kelas::class, 'guru_id', 'id_guru');
	}

	public static function getGuruPaginate()
	{
		return Guru::select('nama', 'nip', 'id_guru')
			->selectRaw("(case when foto!='' then foto when (gender='Perempuan') then 'ukhti.png' when (gender='Laki-Laki') then 'akhi.png' else foto end) foto")
			->has('kelas_mapel')
			->with('kelas_mapel', function ($q) {
				$q->has('mata_pelajaran')
					->with('mata_pelajaran')
					->with('kelas')
					->when(in_array((int) date('m'), [1, 2, 3, 4, 5, 6]), function ($qq) {
						$qq->whereHas('tahun_ajaran', function ($qqq) {
							$nama_tahun_ajaran=date('Y',strtotime('-1 year')).'/'.date('Y');
				// 			$nama_tahun_ajaran = "2018/2019";
							$qqq->where('nama_tahun_ajaran', $nama_tahun_ajaran);
						});
					})
					->when(in_array((int) date('m'), [7, 8, 9, 10, 11, 12]), function ($qq) {
						$qq->whereHas('tahun_ajaran', function ($qqq) {
							$nama_tahun_ajaran = date('Y') . '/' . date('Y', strtotime('+1 year'));
				// 			$nama_tahun_ajaran = "2019/2020";
							$qqq->where('nama_tahun_ajaran', $nama_tahun_ajaran);
						});
					});
			})
			->orderBy('id_guru', 'DESC')
			->paginate(12);
	}
}
