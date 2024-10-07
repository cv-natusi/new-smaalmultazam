<?php

namespace App\Http\Controllers\Main\SliderGambar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

# MODELS
use App\Models\Slider;

# HELPERS
use App\Http\Libraries\compressFile;
use Help, DataTables, DB, CLog;

class SliderGambarController extends Controller
{
	private $data;

	public function __construct()
	{
		$this->data = Help::mainSetting();
		$this->data['curNav'] = 'Slider Gambar';
		$this->data['title'] = 'Slider Gambar';
	}

    public function main(Request $request) {
		$slider = Slider::orderByRaw('coalesce(position,100) asc')
			->orderBy('id_slider','DESC')
			->get();
		if ($request->ajax()) {
			return DataTables::of($slider)->
				addIndexColumn()->
				addColumn('gambar',function($row){
					return "<img src='".asset('uploads/slider/'.$row->gambar)."' class='img-fluid' width='200'>";
				})->
				addColumn('icon',function($row){
					return "<p style='font-weight:900;font-size:1.5rem'><i class='bx bx-sort-alt-2 mx-1'></i></p>";
				})->
				addColumn('actions',function($row){
					$html = "<button onclick='tambahSliderGambar($row->id_slider)' class='btn btn-dark btn-purple p-2'><i class='bx bx-edit-alt mx-1'></i></button>";
					$html .= "<button onclick='hapusSliderGambar($row->id_slider)' class='btn ms-1 btn-danger p-2'><i class='bx bx-trash mx-1'></i></button>";
					return $html;
				})->
				rawColumns(['icon','gambar','actions'])->toJson();
			}
		$data = $this->data;
		return view('main.content.slider.main',$data);
	}

	public function add(Request $request) {
		$data = $this->data;
		$data['slider'] = Slider::find($request->id);
		$content = view('main.content.slider.form',$data)->render();
		return ['status' => 'success', 'content' => $content];
	}

	public function save(Request $request) {
		$rules = [
			'gambar'=>'required'
		];
		$message = [
			'gambar.required'=>'Gambar Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);
		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0]], 201);
		}

		try {
			DB::beginTransaction();
			if (empty($request->id)) {
				$slider = new Slider;
				$slider->position = 0;
			} else {
				$slider = Slider::find($request->id);
			}
			if (!empty($request->gambar)) {
				if(!empty($request->id) && $slider->gambar!=''){
					if(file_exists('uploads/slider/'.$slider->gambar)){
						unlink('uploads/slider/'.$slider->gambar);
					}
				}
				$ukuranFile1 = filesize($request->gambar);
				if ($ukuranFile1 <= 500000) {
					$ext_foto1 = $request->gambar->getClientOriginalExtension();
					$filename1 = "Slider-".date('Ymd-His').".".$ext_foto1;
					$temp_foto1 = 'uploads/slider/';
					$proses1 = $request->gambar->move($temp_foto1, $filename1);
					$slider->gambar = $filename1;
				}else{
					$file1=$_FILES['gambar']['name'];
					$ext_foto1 = $request->gambar->getClientOriginalExtension();
					if(!empty($file1)){
						$direktori1='uploads/slider/'; //tempat upload foto
						$name1='gambar'; //name pada input type file
						$namaBaru1="Slider-".date('Ymd-His'); //name pada input type file
						$quality1=50; //konversi kualitas gambar dalam satuan %
						$upload1 = compressFile::UploadCompress($namaBaru1,$name1,$direktori1,$quality1);
					}
					$slider->gambar = $namaBaru1.".".$ext_foto1;
				}
			}
			$slider->save();
			if (!$slider) {
				DB::rollback();
				return ['code'=>201,'status'=>'error','Gagal.'];
			}
			$sliders = Slider::where('position','!=',null)->increment('position',1);
			if (!$sliders) {
				DB::rollback();
				return ['code'=>201,'status'=>'error','Gagal.'];
			}
			DB::commit();
			return ['code'=>200,'status'=>'success','Berhasil.'];
		} catch (\Throwable $e) {
			DB::rollback();
			$request->merge([
				'file' => $e->getFile(),
				'message' => $e->getMessage(),
				'line' => $e->getLine(),
			]);
			CLog::catchError($request);
			return Help::resMsg(null,500);
		}
	}

	public function delete(Request $request)
	{
		$rules = [
			'id'=>'required'
		];
		$message = [
			'id.required'=>'ID Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);
		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0]], 201);
		}

		try {
			DB::beginTransaction();
			if (!$data = Slider::where('id_slider',$request->id)->first()) {
				return Help::resMsg('Data Tidak Ditemukan!',201);
			}
			if(file_exists('uploads/slider/'.$data->gambar)){
				unlink('uploads/slider/'.$data->gambar);
			}
			if($data->position!=null) {
				$sliders = Slider::where('position','!=',null)
					->where('position','>',$data->position)
					->get();
				if(count($sliders)>0) {
					$slidersDecrement = Slider::where('position','!=',null)->where('position','>',$data->position)->decrement('position',1);
					if(!$slidersDecrement) {
						DB::rollback();
						return Help::resMsg('Gagal Menghapus, Data Posisi Tidak Bisa Diubah',201);
					}
				}
			}
			if (!$data->delete()) {
				DB::rollback();
				return Help::resMsg('Gagal Menghapus',201);
			}
			DB::commit();
			return Help::resMsg('Berhasil Menghapus',200);
		} catch (\Throwable $e) {
			DB::rollback();
			$request->merge([
				'file' => $e->getFile(),
				'message' => $e->getMessage(),
				'line' => $e->getLine(),
			]);
			CLog::catchError($request);
			return Help::resMsg(null,500);
		}
	}

	public function updatePosition(Request $request) {
		$rules = [
			'slider.*.id'=>'required',
			'slider.*.position'=>'required',
		];
		$message = [
			'slider.*.id.required'=>'Id Wajib Diisi',
			'slider.*.position.required'=>'Posisi Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);
		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0]], 201);
		}

		try {
			DB::beginTransaction();
			if (isset($request->slider)) {
				foreach ($request->slider as $key => $value) {
					if($updateSlider = Slider::where('id_slider',$value['id'])->first()) {
						$updateSlider->position = $value['position'];
						if(!$updateSlider->save()) {
							DB::rollback();
							return Help::resMsg('Gagal merubah urutan Slider',201);
						}
					}
				}
				DB::commit();
				return Help::resMsg('Berhasil merubah urutan slider',200);
			}
			DB::rollback();
			return Help::resMsg('Tidak ada urutan slider yang berubah',201);
		} catch (\Throwable $e) {
			DB::rollback();
			$request->merge([
				'file' => $e->getFile(),
				'message' => $e->getMessage(),
				'line' => $e->getLine(),
			]);
			CLog::catchError($request);
			return Help::resMsg(null,500);
		}

	}
}
