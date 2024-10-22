<?php

namespace App\Models;

use App\Models\Elearning\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
	use HasFactory;
	protected $table = "berita";
	protected $primaryKey = "id_berita";
	public $timestamps = false;

	public static function getBeritaPaginate(){
		return Berita::where('kategori', 1)
			->where('status', true)
			->orderBy('tanggal', 'DESC')
			->paginate(8);
	}

	public static function getBeritaDetail($id) {
		return Berita::where('id_berita',$id)
			->where('kategori', 1)
			->where('status', true)
			->first();
	}

	public static function getPrestasiPaginate(){
		return Berita::where('kategori', 5)
			->where('status', true)
			->orderBy('tanggal', 'DESC')
			->paginate(8);
	}

	public static function getPrestasiDetail($id) {
		return Berita::where('id_berita',$id)
			->where('kategori', 5)
			->where('status', true)
			->first();
	}

	public static function getPengumumanPaginate(){
		return Berita::where('kategori', 3)
			->where('status', true)
			->orderBy('tanggal', 'DESC')
			->paginate(8);
	}

	public static function getPengumumanDetail($id) {
		return Berita::where('id_berita',$id)
			->where('kategori', 3)
			->where('status', true)
			->first();
	}

	public static function getEventPaginate(){
		return Berita::whereIn('kategori', [2,3])
			->where('status', true)
			->orderBy('tanggal', 'DESC')
			->paginate(8);
	}

	public static function getEventDetail($id) {
		return Berita::where('id_berita',$id)
			->whereIn('kategori', [2,3])
			->where('status', true)
			->first();
	}

	public static function getProgramUnggulanPaginate(){
		return Berita::where('kategori', 4)
			->where('status', true)
			->orderBy('tanggal', 'DESC')
			->paginate(8);
	}

	public static function getProgramUnggulanDetail($id) {
		return Berita::where('id_berita',$id)
			->where('kategori', 4)
			->where('status', true)
			->first();
	}

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function karya_siswa_file() {
        return $this->hasMany(KaryaSiswaFile::class, 'berita_id', 'id_berita');
    }
}
