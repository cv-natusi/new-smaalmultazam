<?php

namespace App\Http\Controllers\Main\MenuUtama\Amtv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

# MODELS
use App\Models\Amtv;

# HELPERS
use Help, DataTables;

class AmtvController extends Controller
{
	public function main(Request $request) {
		$status = isset($request->status) ? $request->status : '';
		$data = Amtv::orderBy('id_amtv','DESC')
			->when(($status!=''), function ($q) use ($status) {
				$q->where('status_amtv',$status);
			})
			->get();
		if ($request->ajax()) {
			return DataTables::of($data)->
				addIndexColumn()->
				// addColumn('penerbitan',function($row){
				// 	return $row->tanggal . ' ' . $row->jam;
				// })->
				addColumn('status_amtv',function($row){
					return $row->status_amtv ? 'Aktif' : 'Tidak Aktif';
				})->
				addColumn('actions',function($row){
					$html = "<button onclick='tambahAmtv($row->id_amtv)' class='btn btn-dark btn-purple p-2'><i class='bx bx-edit-alt mx-1'></i></button>";
					if ($row->status_amtv) {
						$html .= "<button onclick='aktifAmtv($row->id_amtv)' class='btn ms-1 btn-secondary p-2'><i class='bx bx-power-off mx-1'></i></button>";
					} else {
						$html .= "<button onclick='aktifAmtv($row->id_amtv)' class='btn ms-1 btn-primary p-2'><i class='bx bx-power-off mx-1'></i></button>";
					}
					$html .= "<button onclick='hapusAmtv($row->id_amtv)' class='btn ms-1 btn-danger p-2'><i class='bx bx-trash mx-1'></i></button>";
					return $html;
				})->
				rawColumns(['actions'])->toJson();
		}
		return view('main.content.amtv.main');
	}
	
	public function add(Request $request) {
		$data['amtv'] = Amtv::find($request->id);
		$data['curNav'] = 'Menu Utama';
		$data['curMenu'] = 'AMTV';
		$content = view('main.content.amtv.form',$data)->render();
		return ['status' => 'success', 'content' => $content];
	}

	public function save(Request $request) {
		$rules = [
			'judul_amtv'=>'required',
			'status_amtv'=>'required',
			'file'=>'required',
		];
		$message = [
			'judul_amtv.required'=>'Kolom Judul Wajib Diisi',
			'file.required'=>'Kolom Isi Wajib Diisi',
			'status_amtv.required'=>'Kolom Status Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);
		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0]], 201);
		}

		if (empty($request->id)) {
			$amtv = new Amtv;
		} else {
			$amtv = Amtv::find($request->id);
		}
		$amtv->judul_amtv = $request->judul_amtv;
		$amtv->file = $request->file;
		$amtv->status_amtv = $request->status_amtv;
		$amtv->save();
		if ($amtv) {
			return ['code'=>200,'status'=>'success','Berhasil.'];
		} else {
			return ['code'=>201,'status'=>'error','Gagal.'];
		}
	}

	public function delete(Request $request)
	{
		$data = Amtv::where('id_amtv',$request->id)->delete();
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

		$amtv = Amtv::find($request->id);
		$amtv->status_amtv = !$amtv->status_amtv;

		if (!$amtv->save()) {
			return response()->json(['message'=>'Gagal'], 201);
		}
		if ($amtv->status_amtv) {
			return Help::resMsg('AMTV Berhasil Diaktifkan',200);
		}
		return Help::resMsg('AMTV Berhasil Dinonaktifkan',200);
	}
}
