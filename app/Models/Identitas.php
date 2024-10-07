<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identitas extends Model
{
	protected $table = 'identitas';
	// protected $fillable = ['id_identitas','nama_web','url','email','alamat','fb','gplus','instagram','twitter','youtube','phone','meta','favicon','icon','logo_kiri','logo_tengah','logo_kanan','rekening','redaksi_isi','pedoman','karir','info_iklan','info'];
	protected $primaryKey = "id_identitas";
	public $timestamps = false;

	public static function getSejarah() {
		return Identitas::selectRaw('foto_sejarah as gambar, sejarah as isi, "Sejarah Singkat" as judul')->first();
	}

	public static function getVisiDanMisi() {
		return Identitas::selectRaw('"" as gambar, vm as isi, "Visi dan Misi" as judul')->first();
	}

	public static function getSambutanKepalaSekolah() {
		return Identitas::selectRaw('foto_sambutan as gambar, sambutan_kepsek as isi, "Sambutan Kepala Sekolah" as judul')->first();
	}

	public static function getStrukturOrganisasi() {
		return Identitas::selectRaw('struktur_organisasi as gambar, "" as isi, "Struktur Organisasi" as judul')->first();
	}
}
