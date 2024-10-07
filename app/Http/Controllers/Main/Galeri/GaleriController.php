<?php

namespace App\Http\Controllers\Main\Galeri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

# MODELS
use App\Models\Galeri;

# HELPERS
use App\Http\Libraries\compressFile;
use Help, DataTables;

class GaleriController extends Controller
{
	private $data;

	public function __construct()
	{
		$this->data = Help::mainSetting();
		$this->data['curNav'] = 'Galeri';
		$this->data['title'] = 'Galeri';
	}

    public function main(Request $request) {
		$status = isset($request->status) ? $request->status : '';
		$galeri = Galeri::where('kategori_galeri',1)
			->orderBy('id_galeri','DESC')
			->when(($status!=''), function ($q) use ($status) {
				$q->where('status_galeri',$status);
			})
			->get();
		if ($request->ajax()) {
			return DataTables::of($galeri)->
				addIndexColumn()->
				addColumn('status',function($row){
					return $row->status_galeri ? 'Aktif' : 'Tidak Aktif';
				})->
				addColumn('galeri',function($row){
					return "<img src='".asset('uploads/galeri/'.$row->file_galeri)."' class='img-thumbnail'>";
				})->
				addColumn('actions',function($row){
					$html = "<button onclick='tambahGaleri($row->id_galeri)' class='btn btn-dark btn-purple p-2'><i class='bx bx-edit-alt mx-1'></i></button>";
					if ($row->status_galeri) {
						$html .= "<button onclick='aktifGaleri($row->id_galeri)' class='btn ms-1 btn-secondary p-2'><i class='bx bx-power-off mx-1'></i></button>";
					} else {
						$html .= "<button onclick='aktifGaleri($row->id_galeri)' class='btn ms-1 btn-primary p-2'><i class='bx bx-power-off mx-1'></i></button>";
					}
					$html .= "<button onclick='hapusGaleri($row->id_galeri)' class='btn ms-1 btn-danger p-2'><i class='bx bx-trash mx-1'></i></button>";
					return $html;
				})->
				rawColumns(['galeri','actions'])->toJson();
			}
		$data = $this->data;
		return view('main.content.galeri.main',$data);
	}

	public function add(Request $request) {
		$data = $this->data;
		$data['galeri'] = Galeri::find($request->id);
		$content = view('main.content.galeri.form',$data)->render();
		return ['status' => 'success', 'content' => $content];
	}

	public function save(Request $request) {
		$rules = [
			'file_galeri'=>'required_without:id',
			'deskripsi_galeri'=>'required',
			'status_galeri'=>'required',
		];
		$message = [
			'file_galeri.required_without'=>'Gambar Wajib Diisi',
			'deskripsi_galeri.required'=>'Kolom Deskripsi Wajib Diisi',
			'status_galeri.required'=>'Kolom Status Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);
		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0]], 201);
		}

		if (empty($request->id)) {
			$galeri = new Galeri;
		} else {
			$galeri = Galeri::find($request->id);
		}
		$galeri->deskripsi_galeri = $request->deskripsi_galeri;
		$galeri->status_galeri = $request->status_galeri;
		$galeri->kategori_galeri = 1;
		if (!empty($request->file_galeri)) {
			if(!empty($request->id) && $galeri->file_galeri!=''){
				if(file_exists('uploads/galeri/'.$galeri->file_galeri)){
					unlink('uploads/galeri/'.$galeri->file_galeri);
				}
			}
			$ukuranFile1 = filesize($request->file_galeri);
			if ($ukuranFile1 <= 500000) {
				$ext_foto1 = $request->file_galeri->getClientOriginalExtension();
				$filename1 = "Galeri-".date('Ymd-His').".".$ext_foto1;
				$temp_foto1 = 'uploads/galeri/';
				$proses1 = $request->file_galeri->move($temp_foto1, $filename1);
				$galeri->file_galeri = $filename1;
			}else{
				$file1=$_FILES['file_galeri']['name'];
				$ext_foto1 = $request->file_galeri->getClientOriginalExtension();
				if(!empty($file1)){
					$direktori1='uploads/galeri/'; //tempat upload foto
					$name1='file_galeri'; //name pada input type file
					$namaBaru1="Galeri-".date('Ymd-His'); //name pada input type file
					$quality1=50; //konversi kualitas gambar dalam satuan %
					$upload1 = compressFile::UploadCompress($namaBaru1,$name1,$direktori1,$quality1);
				}
				$galeri->file_galeri = $namaBaru1.".".$ext_foto1;
			}
		}
		$galeri->save();
		if ($galeri) {
			return ['code'=>200,'status'=>'success','Berhasil.'];
		} else {
			return ['code'=>201,'status'=>'error','Gagal.'];
		}
	}

	public function delete(Request $request)
	{
		$data = Galeri::where('id_galeri',$request->id)->delete();
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

		$galeri = Galeri::find($request->id);
		$galeri->status_galeri = !$galeri->status_galeri;

		if (!$galeri->save()) {
			return response()->json(['message'=>'Gagal'], 201);
		}
		if ($galeri->status_galeri) {
			return Help::resMsg('Ekstrakurikuler Berhasil Diaktifkan',200);
		}
		return Help::resMsg('Ekstrakurikuler Berhasil Dinonaktifkan',200);
	}
}
