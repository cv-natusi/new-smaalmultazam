<?php

namespace App\Http\Controllers\Main\Alumni;

use App\Http\Controllers\Controller;
use App\Imports\AlumniImport;
use Illuminate\Http\Request;
use App\Models\Alumni;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class AlumniController extends Controller
{
    public function main(Request $request) {
		if ($request->ajax()) {
			$alumni = Alumni::get();
			return DataTables::of($alumni)->
				addIndexColumn()->
				// addColumn('status',function($row){
				// 	return $row->status_galeri ? 'Aktif' : 'Tidak Aktif';
				// })->
				// addColumn('galeri',function($row){
				// 	return "<img src='".asset('uploads/galeri/'.$row->file_galeri)."' class='img-thumbnail'>";
				// })->
				// addColumn('actions',function($row){
				// 	$html = "<button onclick='tambahGaleri($row->id_galeri)' class='btn btn-dark btn-purple p-2'><i class='bx bx-edit-alt mx-1'></i></button>";
				// 	if ($row->status_galeri) {
				// 		$html .= "<button onclick='aktifGaleri($row->id_galeri)' class='btn ms-1 btn-secondary p-2'><i class='bx bx-power-off mx-1'></i></button>";
				// 	} else {
				// 		$html .= "<button onclick='aktifGaleri($row->id_galeri)' class='btn ms-1 btn-primary p-2'><i class='bx bx-power-off mx-1'></i></button>";
				// 	}
				// 	$html .= "<button onclick='hapusGaleri($row->id_galeri)' class='btn ms-1 btn-danger p-2'><i class='bx bx-trash mx-1'></i></button>";
				// 	return $html;
				// })->
				// rawColumns(['galeri','actions'])->
				toJson();
			}
		return view('main.content.alumni.main');
	}

	public function import(Request $request) {
		
		if(Excel::import(new AlumniImport, request()->file('excel'))){
			return ['code'=>200,'status'=>'success','Berhasil.'];
		} else {
			return ['code'=>201,'status'=>'success','Gagal update'];
		}
	}
}
