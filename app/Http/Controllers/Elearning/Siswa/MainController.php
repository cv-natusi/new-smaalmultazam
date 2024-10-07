<?php

namespace App\Http\Controllers\Elearning\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function kerjakan()
    {
        return view('elearning.siswa.soal.lembar-kerja');
    }
}
