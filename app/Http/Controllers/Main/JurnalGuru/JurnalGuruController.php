<?php

namespace App\Http\Controllers\Main\JurnalGuru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JurnalGuruController extends Controller
{
    public function main() {
		return view('main.content.jurnal-guru.main');
	}
}
