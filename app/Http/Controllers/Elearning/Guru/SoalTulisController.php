<?php

namespace App\Http\Controllers\Elearning\Guru;

use App\Http\Controllers\Controller;
use App\Models\Elearning\Kelas;
use App\Models\Elearning\MataPelajaran;
use App\Models\Elearning\TahunAjaran;
use Illuminate\Http\Request;
use Auth;

class SoalTulisController extends Controller
{
	public function main(Request $request)
	{
		return view('elearning.guru.soal-materi.main');
	}

	public function add(Request $request)
	{
		$user_id = Auth::user()->id;
		$data['kelas'] = Kelas::get();
		$data['tahunAjaran'] = TahunAjaran::get();
		$data['mataPelajaran'] = MataPelajaran::whereHas('kelas_mapel', function ($q) use ($user_id) {
			$q->whereHas('guru', function ($qq) use ($user_id) {
				$qq->where('users_id', $user_id);
			});
		})->get();
		$content = view('elearning.guru.soal-materi.form', $data)->render();
		return ['status' => 'success', 'content' => $content];
	}
}
