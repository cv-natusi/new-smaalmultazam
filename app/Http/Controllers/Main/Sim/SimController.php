<?php

namespace App\Http\Controllers\Main\Sim;

use App\Http\Controllers\Controller;
use App\Http\Libraries\compressFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

# Model
use App\Models\SIM;

# Helper
use Help, DataTables;

class SimController extends Controller
{
	public function __construct()
	{
		$this->data = Help::mainSetting();
		$this->data['curNav'] = 'SIM';
		$this->data['title'] = 'SIM';
	}
	public function main(Request $request)
	{
		if ($request->ajax()) {
			$sim = SIM::when($request->status != '', function ($q) use ($request) {
				$q->where('status', $request->status);
			})
				->get();
			return DataTables::of($sim)->addIndexColumn()->addColumn('status', function ($row) {
				return $row->status ? 'Aktif' : 'Tidak Aktif';
			})->addColumn('actions', function ($row) {
				$html = "<button onclick='tambahSim($row->id_sim)' class='btn btn-dark btn-purple p-2'><i class='bx bx-edit-alt mx-1'></i></button>";
				if ($row->status) {
					$html .= "<button onclick='aktifSim($row->id_sim)' class='btn ms-1 btn-secondary p-2'><i class='bx bx-power-off mx-1'></i></button>";
				} else {
					$html .= "<button onclick='aktifSim($row->id_sim)' class='btn ms-1 btn-primary p-2'><i class='bx bx-power-off mx-1'></i></button>";
				}
				$html .= "<button onclick='hapusSim($row->id_sim)' class='btn ms-1 btn-danger p-2'><i class='bx bx-trash mx-1'></i></button>";
				return $html;
			})->rawColumns(['actions'])->toJson();
		}
		$data = $this->data;
		return view('main.content.sim.main', $data);
	}

	public function add(Request $request)
	{
		$data = $this->data;
		$data['sim'] = SIM::find($request->id);
		$content = view('main.content.sim.form', $data)->render();
		return ['status' => 'success', 'content' => $content];
	}

	public function save(Request $request)
	{
		$rules = [
			'nama' => 'required',
			'link' => 'required',
			'status' => 'required',
			'keterangan' => 'required',
			'foto' => 'required_without:id'
		];
		$message = [
			'nama.required' => 'Kolom Nama Wajib Diisi',
			'link.required' => 'Kolom Link Wajib Diisi',
			'status.required' => 'Kolom Status Wajib Diisi',
			'keterangan.required' => 'Kolom Keterangan Wajib Diisi',
			'foto.required_without' => 'Gambar Wajib Diisi',
		];
		$validate = Validator::make($request->all(), $rules, $message);
		if ($validate->fails()) {
			return response()->json(['message' => $validate->errors()->all()[0]], 201);
		}

		if (empty($request->id)) {
			$sim = new SIM;
		} else {
			$sim = SIM::find($request->id);
		}
		$sim->nama = $request->nama;
		$sim->link = $request->link;
		$sim->status = $request->status;
		$sim->keterangan = $request->keterangan;
		$sim->penerbitan = date('Y-m-d');
		if (!empty($request->foto)) {
			if (!empty($request->id) && $sim->foto != '') {
				if (file_exists('uploads/sim/' . $sim->foto)) {
					unlink('uploads/sim/' . $sim->foto);
				}
			}
			$ukuranFile1 = filesize($request->foto);
			if ($ukuranFile1 <= 500000) {
				$ext_foto1 = $request->foto->getClientOriginalExtension();
				$filename1 = "Berita" . date('Ymd-His') . "." . $ext_foto1;
				$temp_foto1 = 'uploads/sim/';
				$proses1 = $request->foto->move($temp_foto1, $filename1);
				$sim->foto = $filename1;
			} else {
				$file1 = $_FILES['foto']['name'];
				$ext_foto1 = $request->foto->getClientOriginalExtension();
				if (!empty($file1)) {
					$direktori1 = 'uploads/sim/'; //tempat upload foto
					$name1 = 'foto'; //name pada input type file
					$namaBaru1 = "Berita" . date('Ymd-His'); //name pada input type file
					$quality1 = 50; //konversi kualitas gambar dalam satuan %
					$upload1 = compressFile::UploadCompress($namaBaru1, $name1, $direktori1, $quality1);
				}
				$sim->foto = $namaBaru1 . "." . $ext_foto1;
			}
		}
		if ($sim->save()) {
			return ['code' => 200, 'status' => 'success', 'Berhasil.'];
		} else {
			return ['code' => 201, 'status' => 'error', 'Gagal.'];
		}
	}

	public function aktif(Request $request)
	{
		$rules = [
			'id' => 'required',
		];
		$message = [
			'id.required' => 'Id Wajib Diisi',
		];
		$validate = Validator::make($request->all(), $rules, $message);

		if ($validate->fails()) {
			return response()->json(['message' => $validate->errors()->all()[0]], 201);
		}

		$sim = SIM::find($request->id);
		$sim->status = !$sim->status;

		if (!$sim->save()) {
			return response()->json(['message' => 'Gagal'], 201);
		}
		if ($sim->status) {
			return Help::resMsg('SIM Berhasil Diaktifkan', 200);
		}
		return Help::resMsg('SIM Berhasil Dinonaktifkan', 200);
	}

	public function delete(Request $request)
	{
		$data = SIM::where('id_sim', $request->id)->first();
		if ($delete = $data->delete()) {
			if (file_exists('uploads/sim/' . $data->foto)) {
				unlink('uploads/sim/' . $data->foto);
			}
			return Help::resMsg('Berhasil Menghapus', 200);
		} else {
			return Help::resMsg('Gagal Menghapus', 201);
		}
	}
}
