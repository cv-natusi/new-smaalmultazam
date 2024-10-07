<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exkul extends Model
{
	protected $table = 'exkul';
	protected $primaryKey = "id_exkul";
	public $timestamps = false;

    public static function getFasilitasSekolahPaginate() {
		return Exkul::where('status_exkul',true)
            ->where('type_exkul',2)
            ->orderBy('id_exkul','desc')
            ->paginate(8);
	}

	public static function getEkstrakulikulerPaginate(){
		return Exkul::selectRaw('id_exkul as id_berita, deskripsi as isi, nama_exkul as judul, foto as gambar')
            ->where('type_exkul', 1)
			->where('status_exkul', true)
			->orderBy('id_exkul', 'DESC')
			->paginate(8);
	}

	public static function getEkstrakulikulerDetail($id) {
		return Exkul::selectRaw('id_exkul as id_berita, deskripsi as isi, nama_exkul as judul, foto as gambar')
            ->where('id_exkul',$id)
			->where('type_exkul', 1)
			->where('status_exkul', true)
			->first();
	}

	public static function getPraktekBaikGuruPaginate(){
		return Exkul::selectRaw('id_exkul as id_berita, deskripsi as isi, nama_exkul as judul, foto as gambar')
            ->where('type_exkul', 10)
			->where('status_exkul', true)
			->orderBy('id_exkul', 'DESC')
			->paginate(8);
	}

	public static function getPraktekBaikGuruDetail($id) {
		return Exkul::selectRaw('id_exkul as id_berita, deskripsi as isi, nama_exkul as judul, foto as gambar')
            ->where('id_exkul',$id)
			->where('type_exkul', 10)
			->where('status_exkul', true)
			->first();
	}
}
