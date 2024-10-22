<?php

namespace App\Http\Controllers\Main\ProgramSekolah\KaryaSiswa;

use App\Http\Controllers\Controller;
use App\Models\Reels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use DB;

class KaryaSiswaController extends Controller
{
    protected $data;

	public function __construct()
	{
		$this->data['title'] = 'Karya Siswa';
	}

    public function main(Request $request) {
        $data = $this->data;
        if ($request->ajax()) {
			$praktek = [];
			return DataTables::of($praktek)->addIndexColumn()->addColumn('tanggal', function ($row) {
				return date('Y F d H:i:s', strtotime($row->created_at));
			})->addColumn('judul', function ($row) {
				$mapel = '';
				if (strlen($row->judul) > 20) {
					$mapel = substr($row->judul, 0, 20) . '...';
				} else {
					$mapel = $row->judul;
				}
				return $mapel;
			})->editColumn('status', function ($row) {
				if ($row->status) {
					return 'aktif';
				} else {
					return 'tidak aktif';
				}
			})->addColumn('actions', function ($row) {
				$html = "<button onclick='tambahBerita($row->id_praktek_baik_guru)' class='btn btn-dark btn-purple p-2'><i class='bx bx-edit-alt mx-1'></i></button>";
				if ($row->status) {
					$html .= "<button onclick='aktifBerita($row->id_praktek_baik_guru)' class='btn ms-1 btn-secondary p-2'><i class='bx bx-power-off mx-1'></i></button>";
				} else {
					$html .= "<button onclick='aktifBerita($row->id_praktek_baik_guru)' class='btn ms-1 btn-primary p-2'><i class='bx bx-power-off mx-1'></i></button>";
				}
				$html .= "<button onclick='hapusBerita($row->id_praktek_baik_guru)' class='btn ms-1 btn-danger p-2'><i class='bx bx-trash mx-1'></i></button>";
				return $html;
			})->rawColumns(['actions'])->toJson();
		}
		return view('main.content.karya-siswa.main', $data);
	}

	public function add(Request $request) {
        $data['reels'] = Reels::find($request->id);
		$data['curNav'] = 'Menu Utama';
		$data['curMenu'] = 'REELS';
		$content = view('main.content.karya-siswa.form',$data)->render();
		return ['status' => 'success', 'content' => $content];
	}

    public function store(Request $request) {
        $params = [
			'judul' => 'required',
			'status' => 'required',
			'isi' => 'required',
			// 'gambar' => 'required_without:id'
		];
		$message = [
			'judul.required' => 'Judul harus diisi',
			'status.required' => 'Status harus diisi',
			'siswa.required' => 'Isi tidak boleh kosong',
			'isi.required' => 'Isi tidak boleh kosong',
			// 'gambar.required_without' => 'Gambar Wajib Diisi',
		];
		$validator = Validator::make($request->all(), $params, $message);
		if ($validator->fails()) {
			foreach ($validator->errors()->toArray() as $key => $val) {
				$msg = $val[0]; # Get validation messages, only one
				break;
			}
			return ['status' => 'fail', 'message' => $msg];
		}

        DB::beginTransaction();
        try {
            
        } catch(\Throwable $e) {

        }
    }
}
