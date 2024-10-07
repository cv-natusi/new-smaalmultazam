<?php

namespace App\Http\Controllers\Main\PesanDanSaran;

use App\Http\Controllers\Controller;
use App\Models\PesanPengunjung;
use Illuminate\Http\Request;

use Help;

class PesanDanSaranController extends Controller
{
	private $data;

	public function __construct()
	{
		$this->data = Help::mainSetting();
		$this->data['curNav'] = 'Pesan dan Saran';
		$this->data['curMenu'] = 'Pesan dan Saran';
		$this->data['title'] = 'Pesan dan Saran';
	}
    // public function main() {
	// 	return view('main.content.pesan-dan-saran.main');
	// }

	public function main(Request $request) {
		$pesan = PesanPengunjung::orderBy('created_at','DESC')
			->get();
		if ($request->ajax()) {
			return DataTables::of($pesan)->
				addIndexColumn()->
				addColumn('actions',function($row){
					$html = "<button onclick='read($row->id)' class='btn btn-success p-2'><i class='bx bx-envelope-open'></i></button>";
					return $html;
				})->
				rawColumns(['actions'])->toJson();
			}
		$data = $this->data;
		return view('main.content.pesan-dan-saran.main',$data);
	}
}
