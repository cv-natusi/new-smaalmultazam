<?php

namespace App\Http\Controllers\Main\ProgramSekolah\KaryaSiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KaryaSiswaController extends Controller
{
    public function main() {
		return view('main.content.karya-siswa.main');
	}

	public function add() {
		return view('main.content.karya-siswa.form');
	}
}
