<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanPengunjung extends Model
{
    use HasFactory;

    protected $table = 'pesan_pengunjung';
	// protected $fillable = ['id_identitas','nama_web','url','email','alamat','fb','gplus','instagram','twitter','youtube','phone','meta','favicon','icon','logo_kiri','logo_tengah','logo_kanan','rekening','redaksi_isi','pedoman','karir','info_iklan','info'];
    public static function getPesanPaginate(){
		return PesanPengunjung::orderBy('created_at', 'DESC')
			->paginate(8);
	}
}
