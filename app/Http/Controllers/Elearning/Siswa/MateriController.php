<?php

namespace App\Http\Controllers\Elearning\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function main()
    {
        return view('elearning.siswa.materi-elearning.main');
    }
}
