<?php

namespace App\Http\Controllers\Main\ProgramSekolah\Uks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UksController extends Controller
{
    public function main() {
		return view('main.content.uks.main');
	}
}
