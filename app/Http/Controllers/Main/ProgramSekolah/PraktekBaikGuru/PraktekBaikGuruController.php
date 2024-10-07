<?php

namespace App\Http\Controllers\Main\ProgramSekolah\PraktekBaikGuru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PraktekBaikGuruController extends Controller
{
    public function main() {
		return view('main.content.praktek-baik-guru.main');
	}

	public function add() {
		return view('main.content.praktek-baik-guru.form');
	}
}
