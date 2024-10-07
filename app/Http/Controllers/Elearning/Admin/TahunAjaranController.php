<?php

namespace App\Http\Controllers\Elearning\Admin;

use App\Http\Controllers\Controller;
use App\Models\Elearning\TahunAjaran;
use Illuminate\Http\Request;
use DataTables;

class TahunAjaranController extends Controller
{
	public function main(Request $request)
	{
		$data = TahunAjaran::orderBy('nama_tahun_ajaran', 'DESC')
			->get();
		if ($request->ajax()) {
			return DataTables::of($data)->addIndexColumn()->addColumn('actions', function ($row) {
				$html = "<button onclick='tambahTahunAjaran($row->id_tahun_ajaran)' class='btn ms-1 btn-primary p-2'><i class='bx bx-edit-alt mx-1'></i></button>";
				$html .= "<button onclick='hapusTahunAjaran($row->id_tahun_ajaran)' class='btn ms-1 btn-danger p-2'><i class='bx bx-trash mx-1'></i></button>";
				return $html;
			})->rawColumns(['actions'])->toJson();
		}
		return view('elearning.admin.master.tahun-ajaran.main');
	}

	public function add(Request $request)
	{
		$data['tahun_ajaran'] = TahunAjaran::find($request->id);
		$content = view('elearning.admin.master.tahun-ajaran.form', $data)->render();
		return ['status' => 'success', 'content' => $content];
	}
}
