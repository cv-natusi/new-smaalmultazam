<?php

namespace App\Http\Controllers\Main\Dokumen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function main() {
		return view('main.content.dokumen.main');
	}

	public function add() {
		return view('main.content.dokumen.form');
	}
}
