<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;

# HELPERS
use Help,CLog;
use Illuminate\Support\Facades\Validator;

class AlumniController extends Controller
{
    private $data;

	public function __construct()
	{
		$this->data = Help::websiteSetting();
		$this->data['curNav'] = 'Alumni';
		$this->data['curNavParentId'] = '7';
        $this->data['pathGambar'] = 'uploads/alumni/';
	}

    public function alumni() {
        $data = $this->data;
        $data['curMenu'] = 'Alumni';
		return view('landing-page.page.alumni-page',$data);
    }

	public function sendAlumni(Request $request) {
		$rules = [
			'nisn'=>'required',
			'nama'=>'required',
			'tahun_lulus'=>'required',
			'kondisi'=>'required',
		];
		$message = [
			'nisn.required'=>'Kolom NISN Wajib Diisi',
			'nama.required'=>'Kolom Nama Lengkap Diisi',
			'tahun_lulus.required'=>'Kolom Tahun Lulus Wajib Diisi',
			'kondisi.required'=>'Kolom Keterangan Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);
		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0],'code'=>201], 201);
		}

		try {
			if (!$alumni = Alumni::where('nisn',$request->nisn)->first()) {
				return response()->json(['message'=>'NISN Tidak Terdaftar','code'=>201], 201);
			}
			if ($alumni->nama!='') {
				return response()->json(['message'=>'Tidak bisa mengubah data yang telah tersimpan','code'=>201], 201);
			}
			if ($alumni->tahun_lulus!=$request->tahun_lulus) {
				return response()->json(['message'=>'Data tidak sesuai dengan sistem!','code'=>201], 201);
			}
			$alumni->nama = $request->nama;
			$alumni->keterangan = $request->kondisi;
			if (!$alumni->save()) {
				return response()->json(['message'=>'Gagal mengupdate data, coba lagi!','code'=>201], 201);
			}
			return response()->json(['message'=>'Berhasil memasukkan data, Terima kasih!','code'=>200], 200);
		} catch (\Throwable $e) {
			$request->merge([
				'file' => $e->getFile(),
				'message' => $e->getMessage(),
				'line' => $e->getLine(),
			]);
			CLog::catchError($request);
			return response()->json(['message'=>'Terjadi Kesalahan Sistem!','code'=>500], 500);
		}
	}
}
