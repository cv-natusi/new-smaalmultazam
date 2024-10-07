<?php

namespace App\Http\Controllers\Main\Identitas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

# MODELS
use App\Models\Identitas;

# HELPERS
use App\Http\Libraries\compressFile;
use Help;

class IdentitasController extends Controller
{
	private $data;

	public function __construct()
	{
		$this->data = Help::mainSetting();
	}

    public function main() {
		$data = $this->data;
		$data['identitas'] = Identitas::first();
		return view('main.content.identitas.main',$data);
	}

	public function saveDataUmum(Request $request) {
		$rules = [
			'nama_web'=>'required',
			'url'=>'required',
			'meta'=>'required',
			'alamat'=>'required',
			'alamat_1'=>'required',
			'email'=>'required',
			'phone'=>'required',
			'logo_kiri'=>'required_without:id',
			'favicon'=>'required_without:id',
		];
		$message = [
			'nama_web.required'=>'Kolom Nama Website Wajib Diisi',
			'meta.required'=>'Kolom Meta Wajib Diisi',
			'alamat.required'=>'Kolom Alamat SMA Putra Wajib Diisi',
			'alamat_1.required'=>'Kolom Alamat SMA Putri Wajib Diisi',
			'email.required'=>'Kolom Email Wajib Diisi',
			'phone.required'=>'Kolom Phone Wajib Diisi',
			'url.required'=>'Kolom Url Wajib Diisi',
			'logo_kiri.required_without'=>'Logo Website Wajib Diisi',
			'favicon.required_without'=>'Gambar Icon Website Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);
		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0]], 201);
		}

		$identitas = Identitas::first();
		$identitas->nama_web = $request->nama_web;
		$identitas->url = $request->url;
		$identitas->meta = $request->meta;
		$identitas->alamat = $request->alamat;
		$identitas->alamat_1 = $request->alamat_1;
		$identitas->email = $request->email;
		$identitas->phone = $request->phone;
		$identitas->url = $request->url;
		if (!empty($request->favicon)) {
			if($identitas->favicon!=''){
				if(file_exists('./uploads/identitas/'.$identitas->favicon)){
					unlink('./uploads/identitas/'.$identitas->favicon);
				}
			}
			$ukuranFile1 = filesize($request->favicon);
			if ($ukuranFile1 <= 500000) {
				$ext_foto1 = $request->favicon->getClientOriginalExtension();
				$filename1 = "Icon_".date('Ymd-His').".".$ext_foto1;
				$temp_foto1 = 'uploads/identitas/';
				$proses1 = $request->favicon->move($temp_foto1, $filename1);
				$identitas->favicon = $filename1;
			}else{
				$file1=$_FILES['favicon']['name'];
				$ext_foto1 = $request->favicon->getClientOriginalExtension();
				if(!empty($file1)){
					$direktori1='uploads/identitas/'; //tempat upload foto
					$name1='favicon'; //name pada input type file
					$namaBaru1="Icon_".date('Ymd-His'); //name pada input type file
					$quality1=50; //konversi kualitas gambar dalam satuan %
					$upload1 = compressFile::UploadCompress($namaBaru1,$name1,$direktori1,$quality1);
				}
				$identitas->favicon = $namaBaru1.".".$ext_foto1;
			}
		}
		if (!empty($request->logo_kiri)) {
			if($identitas->logo_kiri!=''){
				if(file_exists('./uploads/identitas/'.$identitas->logo_kiri)){
					unlink('./uploads/identitas/'.$identitas->logo_kiri);
				}
			}
			$ukuranFile1 = filesize($request->logo_kiri);
			if ($ukuranFile1 <= 500000) {
				$ext_foto1 = $request->logo_kiri->getClientOriginalExtension();
				$filename1 = "Logo_Kiri".date('Ymd-His').".".$ext_foto1;
				$temp_foto1 = 'uploads/identitas/';
				$proses1 = $request->logo_kiri->move($temp_foto1, $filename1);
				$identitas->logo_kiri = $filename1;
			}else{
				$file1=$_FILES['logo_kiri']['name'];
				$ext_foto1 = $request->logo_kiri->getClientOriginalExtension();
				if(!empty($file1)){
					$direktori1='uploads/identitas/'; //tempat upload foto
					$name1='logo_kiri'; //name pada input type file
					$namaBaru1="Logo_Kiri".date('Ymd-His'); //name pada input type file
					$quality1=50; //konversi kualitas gambar dalam satuan %
					$upload1 = compressFile::UploadCompress($namaBaru1,$name1,$direktori1,$quality1);
				}
				$identitas->logo_kiri = $namaBaru1.".".$ext_foto1;
			}
		}
		
		if (!$identitas->save()) {
			return Help::resMsg('Gagal Mengupdate Data',201);
		}
		return Help::resMsg('Berhasil Mengupdate Data', 200);
	}

	public function saveDataKontak(Request $request) {
		$rules = [
			'fans_page'=>'required',
			'fb'=>'required',
			'instagram'=>'required',
			'twitter'=>'required',
			'googleplus'=>'required',
			'youtube'=>'required',
			'tiktok'=>'required',
		];
		$message = [
			'fans_page.required'=>'Kolom Facebook Fans Page Wajib Diisi',
			'fb.required'=>'Kolom Facebook Wajib Diisi',
			'instagram.required'=>'Kolom Instagram Wajib Diisi',
			'twitter.required'=>'Kolom Twitter SMA Putra Wajib Diisi',
			'googleplus.required'=>'Kolom Alamat SMA Putri Wajib Diisi',
			'youtube.required'=>'Kolom Youtube Wajib Diisi',
			'tiktok.required'=>'Kolom Tiktok Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);
		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0]], 201);
		}

		$identitas = Identitas::first();
		$identitas->fans_page = $request->fans_page;
		$identitas->fb = $request->fb;
		$identitas->instagram = $request->instagram;
		$identitas->twitter = $request->twitter;
		$identitas->googleplus = $request->googleplus;
		$identitas->youtube = $request->youtube;
		$identitas->tiktok = $request->tiktok;
		
		if (!$identitas->save()) {
			return Help::resMsg('Gagal Mengupdate Data',201);
		}
		return Help::resMsg('Berhasil Mengupdate Data', 200);
	}
}
