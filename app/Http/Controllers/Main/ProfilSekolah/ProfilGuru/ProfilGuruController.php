<?php

namespace App\Http\Controllers\Main\ProfilSekolah\ProfilGuru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilGuruController extends Controller
{
	public function main()
	{
		return view('main.content.profil-guru.main');
	}

	public function add()
	{
		return view('main.content.profil-guru.form');
	}

	# Guru
	public function mainGuru()
	{
		return view('main.content.profil-guru.guru.form');
	}
}
