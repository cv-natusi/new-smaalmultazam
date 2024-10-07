<?php

namespace App\Http\Controllers\Main\ProfilSekolah\FasilitasSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

# MODELS
use App\Models\Exkul;

# HELPERS
use App\Http\Libraries\compressFile;
use Help, DataTables;

class FasilitasSekolahController extends Controller
{
    public function main(Request $request) {
		$status = isset($request->status) ? $request->status : '';
		$data = Exkul::where('type_exkul',2)
			->orderBy('id_exkul','DESC')
			->when(($status!=''), function ($q) use ($status) {
				$q->where('status_exkul',$status);
			})
			->get();
		if ($request->ajax()) {
			return DataTables::of($data)->
				addIndexColumn()->
				addColumn('status',function($row){
					return $row->status_exkul ? 'Aktif' : 'Tidak Aktif';
				})->
				addColumn('actions',function($row){
					$html = "<button onclick='tambahFasilitas($row->id_exkul)' class='btn btn-dark btn-purple p-2'><i class='bx bx-edit-alt mx-1'></i></button>";
					if ($row->status_exkul) {
						$html .= "<button onclick='aktifFasilitas($row->id_exkul)' class='btn ms-1 btn-secondary p-2'><i class='bx bx-power-off mx-1'></i></button>";
					} else {
						$html .= "<button onclick='aktifFasilitas($row->id_exkul)' class='btn ms-1 btn-primary p-2'><i class='bx bx-power-off mx-1'></i></button>";
					}
					$html .= "<button onclick='hapusFasilitas($row->id_exkul)' class='btn ms-1 btn-danger p-2'><i class='bx bx-trash mx-1'></i></button>";
					return $html;
				})->
				rawColumns(['actions'])->toJson();
			}
		$data['curNav'] = 'Profil Sekolah';
		$data['curMenu'] = 'Fasilitas Sekolah';
		$data['title'] = 'Fasilitas Sekolah';
		return view('main.content.fasilitas.main',$data);
	}

	public function add(Request $request) {
		$data['fasilitas'] = Exkul::find($request->id);
		$content = view('main.content.fasilitas.form',$data)->render();
		return ['status' => 'success', 'content' => $content];
	}

	public function save(Request $request) {
		$rules = [
			'nama_exkul'=>'required',
			'status_exkul'=>'required',
			'deskripsi'=>'required',
			'foto'=>'required_without:id'
		];
		$message = [
			'nama_exkul.required'=>'Kolom Nama Fasilitas Wajib Diisi',
			'deskripsi.required'=>'Kolom Deskripsi Wajib Diisi',
			'status_exkul.required'=>'Kolom Status Wajib Diisi',
			'foto.required_without'=>'Gambar Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);
		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0]], 201);
		}

		if (empty($request->id)) {
			$fasilitas = new Exkul;
		} else {
			$fasilitas = Exkul::find($request->id);
		}
		$fasilitas->nama_exkul = $request->nama_exkul;
		$fasilitas->status_exkul = $request->status_exkul;
		$fasilitas->deskripsi = $request->deskripsi;
		$fasilitas->type_exkul = 2;
		if (!empty($request->foto)) {
			if(!empty($request->id) && $fasilitas->foto!=''){
				if(file_exists('uploads/exkul/'.$fasilitas->foto)){
					unlink('uploads/exkul/'.$fasilitas->foto);
				}
			}
			$ukuranFile1 = filesize($request->foto);
			if ($ukuranFile1 <= 500000) {
				$ext_foto1 = $request->foto->getClientOriginalExtension();
				$filename1 = "Fasilitas-".date('Ymd-His').".".$ext_foto1;
				$temp_foto1 = 'uploads/exkul/';
				$proses1 = $request->foto->move($temp_foto1, $filename1);
				$fasilitas->foto = $filename1;
			}else{
				$file1=$_FILES['foto']['name'];
				$ext_foto1 = $request->foto->getClientOriginalExtension();
				if(!empty($file1)){
					$direktori1='uploads/exkul/'; //tempat upload foto
					$name1='foto'; //name pada input type file
					$namaBaru1="Fasilitas-".date('Ymd-His'); //name pada input type file
					$quality1=50; //konversi kualitas gambar dalam satuan %
					$upload1 = compressFile::UploadCompress($namaBaru1,$name1,$direktori1,$quality1);
				}
				$fasilitas->foto = $namaBaru1.".".$ext_foto1;
			}
		}
		$fasilitas->save();
		if ($fasilitas) {
			return ['code'=>200,'status'=>'success','Berhasil.'];
		} else {
			return ['code'=>201,'status'=>'error','Gagal.'];
		}
	}

	public function delete(Request $request)
	{
		$data = Exkul::where('id_exkul',$request->id)->delete();
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

		$fasilitas = Exkul::find($request->id);
		$fasilitas->status_exkul = !$fasilitas->status_exkul;

		if (!$fasilitas->save()) {
			return response()->json(['message'=>'Gagal'], 201);
		}
		if ($fasilitas->status_exkul) {
			return Help::resMsg('Fasilitas Berhasil Diaktifkan',200);
		}
		return Help::resMsg('Fasilitas Berhasil Dinonaktifkan',200);
	}
}
