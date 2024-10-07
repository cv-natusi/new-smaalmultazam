<?php

namespace App\Http\Controllers\Main\ProfilSekolah\SejarahSingkat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

# MODELS
use App\Models\Identitas;

# HELPERS
use App\Http\Libraries\compressFile;
use Help;

class SejarahSingkatController extends Controller
{
    public function main() {
		$data['sejarah'] = Identitas::first();
		$data['curNav'] = 'Profil Sekolah';
		$data['curMenu'] = 'Sejarah Singkat';
		return view('main.content.sejarah-singkat.main',$data);
	}

	public function save(Request $request) {
		$rules = [
			'sejarah'=>'required',
			'foto_sejarah'=>'required_without|foto',
		];
		$message = [
			'sejarah.required'=>'Kolom Deskripsi Wajib Diisi',
			'foto_sejarah.required'=>'Kolom Foto Sekolah Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);
		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0]], 201);
		}

		$sejarah = Identitas::first();
		$sejarah->sejarah = $request->sejarah;
		if (!empty($request->foto_sejarah)) {
			if($sejarah->foto_sejarah!=''){
				if(file_exists('./uploads/sejarah/'.$sejarah->foto_sejarah)){
					unlink('./uploads/sejarah/'.$sejarah->foto_sejarah);
				}
			}
			$ukuranFile1 = filesize($request->foto_sejarah);
			if ($ukuranFile1 <= 500000) {
				$ext_foto1 = $request->foto_sejarah->getClientOriginalExtension();
				$filename1 = "Sejarah".date('Ymd-His').".".$ext_foto1;
				$temp_foto1 = 'uploads/sejarah/';
				$proses1 = $request->foto_sejarah->move($temp_foto1, $filename1);
				$sejarah->foto_sejarah = $filename1;
			}else{
				$file1=$_FILES['gambar']['name'];
				$ext_foto1 = $request->foto_sejarah->getClientOriginalExtension();
				if(!empty($file1)){
					$direktori1='uploads/sejarah/'; //tempat upload foto
					$name1='gambar'; //name pada input type file
					$namaBaru1="Sejarah".date('Ymd-His'); //name pada input type file
					$quality1=50; //konversi kualitas gambar dalam satuan %
					$upload1 = compressFile::UploadCompress($namaBaru1,$name1,$direktori1,$quality1);
				}
				$sejarah->foto_sejarah = $namaBaru1.".".$ext_foto1;
			}
		}
		if (!$sejarah->save()) {
			return Help::resMsg('Gagal Mengupdate Sejarah Sekolah',201);
		}
		return Help::resMsg('Berhasil Mengupdate Sejarah Sekolah',200);
	}
}
