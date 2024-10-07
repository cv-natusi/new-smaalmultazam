<?php

namespace App\Http\Controllers\Main\ProfilSekolah\VisiDanMisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

# MODELS
use App\Models\Identitas;

# HELPERS
use Help;

class VisiDanMisiController extends Controller
{
    public function main() {
		$data['identitas'] = Identitas::first();
		$data['curNav'] = 'Profil Sekolah';
		$data['curMenu'] = 'Visi dan Misi';
		return view('main.content.visi-dan-misi.main',$data);
	}
	
	public function save(Request $request) {
		$rules = [
			'vm'=>'required',
		];
		$message = [
			'vm.required'=>'Kolom Deskripsi Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);
		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0]], 201);
		}

		$sejarah = Identitas::first();
		$sejarah->vm = $request->vm;
		if (!$sejarah->save()) {
			return Help::resMsg('Gagal Mengupdate Sejarah Sekolah',201);
		}
		return Help::resMsg('Berhasil Mengupdate Sejarah Sekolah',200);
	}
}
