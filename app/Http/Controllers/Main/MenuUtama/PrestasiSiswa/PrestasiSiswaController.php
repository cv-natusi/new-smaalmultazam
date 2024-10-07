<?php

namespace App\Http\Controllers\Main\MenuUtama\PrestasiSiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

# MODELS
use App\Models\Berita;

# HELPERS
use DataTables, Help;
use App\Http\Libraries\compressFile;

class PrestasiSiswaController extends Controller
{
	public function main(Request $request) {
		$status = isset($request->status) ? $request->status : '';
		$data = Berita::where('kategori','5')
			->orderBy('id_berita','DESC')
			->when(($status!=''), function ($q) use ($status) {
				$q->where('status',$status);
			})
			->get();
		if ($request->ajax()) {
			return DataTables::of($data)->
				addIndexColumn()->
				addColumn('penerbitan',function($row){
					return $row->tanggal . ' ' . $row->jam;
				})->
				addColumn('status',function($row){
					return $row->status ? 'Aktif' : 'Tidak Aktif';
				})->
				addColumn('actions',function($row){
					$html = "<button onclick='tambahPrestasi($row->id_berita)' class='btn btn-dark btn-purple p-2'><i class='bx bx-edit-alt mx-1'></i></button>";
					if ($row->status) {
						$html .= "<button onclick='aktifBerita($row->id_berita)' class='btn ms-1 btn-secondary p-2'><i class='bx bx-power-off mx-1'></i></button>";
					} else {
						$html .= "<button onclick='aktifBerita($row->id_berita)' class='btn ms-1 btn-primary p-2'><i class='bx bx-power-off mx-1'></i></button>";
					}
					$html .= "<button onclick='hapusBerita($row->id_berita)' class='btn ms-1 btn-danger p-2'><i class='bx bx-trash mx-1'></i></button>";
					return $html;
				})->
				rawColumns(['actions'])->toJson();
		}
		$data['curNav'] = 'Menu Utama';
		$data['curMenu'] = 'Prestasi Siswa';
		$data['title'] = 'Prestasi Siswa';
		return view('main.content.prestasi.main',$data);
	}

	public function add(Request $request) {
		$data['berita'] = Berita::find($request->id);
		$data['curNav'] = 'Menu Utama';
		$data['curMenu'] = 'Prestasi Siswa';
		// $content = view('main.content.prestasi.form',$data)->render();
		$content = view('main.include.form-berita',$data)->render();
		return ['status' => 'success', 'content' => $content];
	}

	public function save(Request $request) {
		$rules = [
			'judul'=>'required',
			'status'=>'required',
			'isi'=>'required',
			'gambar'=>'required_without:id'
		];
		$message = [
			'judul.required'=>'Kolom Judul Wajib Diisi',
			'isi.required'=>'Kolom Isi Wajib Diisi',
			'status.required'=>'Kolom Status Wajib Diisi',
			'gambar.required_without'=>'Gambar Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);
		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0]], 201);
		}

		if (empty($request->id)) {
			$berita = new Berita;
		} else {
			$berita = Berita::find($request->id);
		}
		$berita->editor_id = 1;
		$berita->judul = $request->judul;
		$berita->isi = $request->isi;
		$berita->status = $request->status;
		$berita->tanggal_acara = date('Y-m-d');
		$berita->tanggal = date('Y-m-d');
		$berita->jam = date('H:i');
		$berita->kategori = 5;
		$foto = date('YmdHis');
		if (!empty($request->gambar)) {
			if(!empty($request->id) && $berita->gambar!=''){
				if(file_exists('uploads/berita/'.$berita->gambar)){
					unlink('uploads/berita/'.$berita->gambar);
				}
			}
			$ukuranFile1 = filesize($request->gambar);
			if ($ukuranFile1 <= 500000) {
				$ext_foto1 = $request->gambar->getClientOriginalExtension();
				$filename1 = "Berita".date('Ymd-His').".".$ext_foto1;
				$temp_foto1 = 'uploads/berita/';
				$proses1 = $request->gambar->move($temp_foto1, $filename1);
				$berita->gambar = $filename1;
			}else{
				$file1=$_FILES['gambar']['name'];
				$ext_foto1 = $request->gambar->getClientOriginalExtension();
				if(!empty($file1)){
					$direktori1='uploads/berita/'; //tempat upload foto
					$name1='gambar'; //name pada input type file
					$namaBaru1="Berita".date('Ymd-His'); //name pada input type file
					$quality1=50; //konversi kualitas gambar dalam satuan %
					$upload1 = compressFile::UploadCompress($namaBaru1,$name1,$direktori1,$quality1);
				}
				$berita->gambar = $namaBaru1.".".$ext_foto1;
			}
		}
		$berita->save();
		if ($berita) {
			return ['code'=>200,'status'=>'success','Berhasil.'];
		} else {
			return ['code'=>201,'status'=>'error','Gagal.'];
		}
	}

	public function delete(Request $request)
	{
		$data = Berita::where('id_berita',$request->id)->delete();
		if ($data) {
			return Help::resMsg('Berhasil Menghapus',200);
		} else {
			return Help::resMsg('Gagal Menghapus',201);
		}
	}

	public function aktif(Request $request) {
		$rules = [
			'id'=>'required',
		];
		$message = [
			'id.required'=>'Id Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);

		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0]], 201);
		}

		$berita = Berita::find($request->id);
		$berita->status = !$berita->status;

		if (!$berita->save()) {
			return response()->json(['message'=>'Gagal'], 201);
		}
		if ($berita->status) {
			return Help::resMsg('Prestasi Siswa Berhasil Diaktifkan',200);
		}
		return Help::resMsg('Prestasi Siswa Berhasil Dinonaktifkan',200);
	}
}
