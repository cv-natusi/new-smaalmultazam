<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
	protected $primaryKey = "id_galeri";
	public $timestamps = false;

    public static function getGaleriPaginate() {
		return Galeri::where('status_galeri',true)
            ->where('kategori_galeri',1)
            ->orderBy('id_galeri','desc')
            ->paginate(12);
	}
}
