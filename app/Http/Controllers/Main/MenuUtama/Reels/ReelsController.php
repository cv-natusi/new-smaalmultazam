<?php

namespace App\Http\Controllers\Main\MenuUtama\Reels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
# MODELS
use App\Models\Reels;
# HELPERS
use Help, DataTables;

class ReelsController extends Controller
{
    public function main(Request $request) {    
      $status = isset($request->status) ? $request->status : '';
      $data = Reels::orderBy('id_reels','DESC')
        ->when(($status!=''), function ($q) use ($status) {
            $q->where('status_reels',$status);
        })
        ->get();
        if ($request->ajax()) {
        return DataTables::of($data)->
            addIndexColumn()->            
            addColumn('status_reels',function($row){
                return $row->status_reels ? 'Aktif' : 'Tidak Aktif';
            })->
            addColumn('actions',function($row){
                $html = "<button onclick='tambahReels($row->id_reels)' class='btn btn-dark btn-purple p-2'><i class='bx bx-edit-alt mx-1'></i></button>";
                if ($row->status_reels) {
                    $html .= "<button onclick='aktifReels($row->id_reels)' class='btn ms-1 btn-secondary p-2'><i class='bx bx-power-off mx-1'></i></button>";
                } else {
                    $html .= "<button onclick='aktifReels($row->id_reels)' class='btn ms-1 btn-primary p-2'><i class='bx bx-power-off mx-1'></i></button>";
                }
                $html .= "<button onclick='hapusReels($row->id_reels)' class='btn ms-1 btn-danger p-2'><i class='bx bx-trash mx-1'></i></button>";
                return $html;
            })->
            rawColumns(['actions'])->toJson();
        }
        return view('main.content.reels.main');
    }

    public function add(Request $request) {
		$data['reels'] = Reels::find($request->id);
		$data['curNav'] = 'Menu Utama';
		$data['curMenu'] = 'REELS';
		$content = view('main.content.reels.form',$data)->render();
		return ['status' => 'success', 'content' => $content];
	}

	public function save(Request $request) {
		$rules = [
			'judul_reels'=>'required',
			'status_reels'=>'required',
			'file'=>'required',
		];
		$message = [
			'judul_reels.required'=>'Kolom Judul Wajib Diisi',
			'file.required'=>'Kolom Isi Wajib Diisi',
			'status_reels.required'=>'Kolom Status Wajib Diisi',
		];
		$validate = Validator::make($request->all(),$rules,$message);
		if ($validate->fails()) {
			return response()->json(['message'=>$validate->errors()->all()[0]], 201);
		}

		if (empty($request->id)) {
			$reels = new Reels;
		} else {
			$reels = Reels::find($request->id);
		}
		$reels->judul_reels = $request->judul_reels;
		$reels->file = $request->file;
		$reels->status_reels = $request->status_reels;
		$reels->save();
		if ($reels) {
			return ['code'=>200,'status'=>'success','Berhasil.'];
		} else {
			return ['code'=>201,'status'=>'error','Gagal.'];
		}
	}

	public function delete(Request $request)
	{
		$data = Reels::where('id_reels',$request->id)->delete();
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

		$reels = Reels::find($request->id);
		$reels->status_reels = !$reels->status_reels;

		if (!$reels->save()) {
			return response()->json(['message'=>'Gagal'], 201);
		}
		if ($reels->status_reels) {
			return Help::resMsg('reels Berhasil Diaktifkan',200);
		}
		return Help::resMsg('reels Berhasil Dinonaktifkan',200);
	}
}
