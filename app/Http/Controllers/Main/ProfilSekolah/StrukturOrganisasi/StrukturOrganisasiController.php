<?php

namespace App\Http\Controllers\Main\ProfilSekolah\StrukturOrganisasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

# MODELS
use App\Models\Identitas;

# HELPERS
use App\Http\Libraries\compressFile;
use Help;

class StrukturOrganisasiController extends Controller
{
	private $data;

	public function __construct()
	{
		$this->data = Help::mainSetting();
	}

    public function main() {
		$data = $this->data;
		return view('main.content.struktur-organisasi.main',$data);
	}

	public function save(Request $request) {
		$rules = [
			'struktur_organisasi'=>'required',
		];
		$message = [
			'struktur_organisasi.required'=>'Gambar Struktur Organisasi Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);
		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0]], 201);
		}

		$identitas = Identitas::first();

		if (!empty($request->struktur_organisasi)) {
			if($identitas->struktur_organisasi!=''){
				if(file_exists('./uploads/strukturorganisasi/'.$identitas->struktur_organisasi)){
					unlink('./uploads/strukturorganisasi/'.$identitas->struktur_organisasi);
				}
			}
			$ukuranFile1 = filesize($request->struktur_organisasi);
			if ($ukuranFile1 <= 500000) {
				$ext_foto1 = $request->struktur_organisasi->getClientOriginalExtension();
				$filename1 = "strukturorganisasi".date('Ymd-His').".".$ext_foto1;
				$temp_foto1 = 'uploads/strukturorganisasi/';
				$proses1 = $request->struktur_organisasi->move($temp_foto1, $filename1);
				$identitas->struktur_organisasi = $filename1;
			}else{
				$file1=$_FILES['struktur_organisasi']['name'];
				$ext_foto1 = $request->struktur_organisasi->getClientOriginalExtension();
				if(!empty($file1)){
					$direktori1='uploads/strukturorganisasi/'; //tempat upload foto
					$name1='struktur_organisasi'; //name pada input type file
					$namaBaru1="strukturorganisasi".date('Ymd-His'); //name pada input type file
					$quality1=50; //konversi kualitas gambar dalam satuan %
					$upload1 = compressFile::UploadCompress($namaBaru1,$name1,$direktori1,$quality1);
				}
				$identitas->struktur_organisasi = $namaBaru1.".".$ext_foto1;
			}
		}
		if (!$identitas->save()) {
			return Help::resMsg('Gagal Mengupdate Struktur Organisasi',201);
		}
		return Help::resMsg('Berhasil Mengupdate Struktur Organisasi',200);
	}
}
