<?php

namespace App\Http\Controllers\Main\ProfilSekolah\SambutanKepalaSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

# MODELS
use App\Models\Identitas;

# HELPERS
use Help;
use App\Http\Libraries\compressFile;

class SambutanKepalaSekolahController extends Controller
{
    public function main() {
		$data['sambutan'] = Identitas::first();
		$data['curNav'] = 'Profil Sekolah';
		$data['curMenu'] = 'Sambutan Kepala Sekolah';
		return view('main.content.sambutan-kepala-sekolah.main',$data);
	}

	public function save(Request $request) {
		// return $request;
		$rules = [
			'sambutan_kepsek'=>'required',
		];
		$message = [
			'sambutan_kepsek.required'=>'Kolom Deskripsi Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);
		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0]], 201);
		}

		$sambutan = Identitas::first();
		$sambutan->sambutan_kepsek = $request->sambutan_kepsek;
		if (!empty($request->foto_sambutan)) {
			if($sambutan->foto_sambutan!=''){
				if(file_exists('./uploads/sambutan/'.$sambutan->foto_sambutan)){
					unlink('./uploads/sambutan/'.$sambutan->foto_sambutan);
				}
			}
			$ukuranFile1 = filesize($request->foto_sambutan);
			if ($ukuranFile1 <= 500000) {
				$ext_foto1 = $request->foto_sambutan->getClientOriginalExtension();
				$filename1 = "Sambutan".date('Ymd-His').".".$ext_foto1;
				$temp_foto1 = 'uploads/sambutan/';
				$proses1 = $request->foto_sambutan->move($temp_foto1, $filename1);
				$sambutan->foto_sambutan = $filename1;
			}else{
				$file1=$_FILES['sambutan_kepsek']['name'];
				$ext_foto1 = $request->foto_sambutan->getClientOriginalExtension();
				if(!empty($file1)){
					$direktori1='uploads/sambutan/'; //tempat upload foto
					$name1='sambutan_kepsek'; //name pada input type file
					$namaBaru1="Sambutan".date('Ymd-His'); //name pada input type file
					$quality1=50; //konversi kualitas gambar dalam satuan %
					$upload1 = compressFile::UploadCompress($namaBaru1,$name1,$direktori1,$quality1);
				}
				$sambutan->foto_sambutan = $namaBaru1.".".$ext_foto1;
			}
		}
		if (!empty($request->ttd_kepsek)) {
			if($sambutan->ttd_kepsek!=''){
				if(file_exists('./uploads/sambutan/'.$sambutan->ttd_kepsek)){
					unlink('./uploads/sambutan/'.$sambutan->ttd_kepsek);
				}
			}
			$ukuranFile1 = filesize($request->ttd_kepsek);
			if ($ukuranFile1 <= 500000) {
				$ext_foto1 = $request->ttd_kepsek->getClientOriginalExtension();
				$filename1 = "TTD".date('Ymd-His').".".$ext_foto1;
				$temp_foto1 = 'uploads/sambutan/';
				$proses1 = $request->ttd_kepsek->move($temp_foto1, $filename1);
				$sambutan->ttd_kepsek = $filename1;
			}else{
				$file1=$_FILES['ttd_kepsek']['name'];
				$ext_foto1 = $request->ttd_kepsek->getClientOriginalExtension();
				if(!empty($file1)){
					$direktori1='uploads/sambutan/'; //tempat upload foto
					$name1='ttd_kepsek'; //name pada input type file
					$namaBaru1="TTD".date('Ymd-His'); //name pada input type file
					$quality1=50; //konversi kualitas gambar dalam satuan %
					$upload1 = compressFile::UploadCompress($namaBaru1,$name1,$direktori1,$quality1);
				}
				$sambutan->ttd_kepsek = $namaBaru1.".".$ext_foto1;
			}
		}
		
		if (!$sambutan->save()) {
			return Help::resMsg('Gagal Mengupdate Data',201);
		}
		return Help::resMsg('Berhasil Mengupdate Data', 200);
	}
}
