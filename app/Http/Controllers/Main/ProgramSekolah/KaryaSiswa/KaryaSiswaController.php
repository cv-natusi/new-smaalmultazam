<?php

namespace App\Http\Controllers\Main\ProgramSekolah\KaryaSiswa;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Elearning\Siswa;
use App\Models\Reels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

# HELPERS
use App\Http\Libraries\compressFile;
use App\Models\KaryaSiswaFile;
use Help, DB;
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
			$praktek = Berita::with('siswa')->where('kategori', 6)->get();
			return DataTables::of($praktek)->addIndexColumn()->addColumn('tanggal', function ($row) {
				// return date('Y F d H:i:s', strtotime($row->tanggal_acara));
                $tanggal = $row->tanggal_acara;
                $jam = date('H:i:s', strtotime($row->jam));
                return $tanggal . ' ' . $jam;
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
					return 'AKTIF';
				} else {
					return 'TIDAK AKTIF';
				}
			})->addColumn('actions', function ($row) {
				$html = "<button onclick='tambahKaryaSiswa($row->id_berita)' class='btn btn-dark btn-purple p-2'><i class='bx bx-edit-alt mx-1'></i></button>";
				if ($row->status) {
					$html .= "<button onclick='aktifKarya($row->id_berita)' class='btn ms-1 btn-secondary p-2'><i class='bx bx-power-off mx-1'></i></button>";
				} else {
					$html .= "<button onclick='aktifKarya($row->id_berita)' class='btn ms-1 btn-primary p-2'><i class='bx bx-power-off mx-1'></i></button>";
				}
				$html .= "<button onclick='hapusKarya($row->id_berita)' class='btn ms-1 btn-danger p-2'><i class='bx bx-trash mx-1'></i></button>";
				return $html;
			})->rawColumns(['actions'])->toJson();
		}
		return view('main.content.karya-siswa.main', $data);
	}

	public function add(Request $request) {
        $data['data'] = Berita::with('karya_siswa_file')->find($request->id);
		$data['curNav'] = 'Menu Utama';
		$data['curMenu'] = 'Karya Siswa';
        $data['siswa'] = Siswa::get();
		$content = view('main.content.karya-siswa.form',$data)->render();
		return ['status' => 'success', 'content' => $content];
	}

    public function store(Request $request) {
        // return $request->all();
        $params = [
			'judul' => 'required',
			'status' => 'required',
			'isi' => 'required',
			// 'gambar' => 'required_without:id'
		];
		$message = [
			'judul.required' => 'Judul harus diisi',
			'status.required' => 'Status harus diisi',
			'siswa.required' => 'Siswa tidak boleh kosong',
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
            if (empty($request->id)) {
				$karya = new Berita;
			} else {
				$karya = Berita::find($request->id);
			}
            $karya->editor_id = 1;
            $karya->judul = $request->judul;
            $karya->tanggal_acara = date('Y-m-d');
            $karya->isi = $request->isi;
            $karya->jam = date('H:i');
            $karya->tanggal = date('Y-m-d');
            $karya->status = $request->status;
            $karya->kategori = 6;
            $karya->siswa_id = $request->siswa;
            if (!empty($request->id)) {
				$idFile = !empty($request->id_file)?$request->id_file:[];
				$pbgFile = KaryaSiswaFile::where('berita_id',$request->id)->whereNotIn('id_karya_siswa_file',$idFile);
				$pbgFileGet = $pbgFile->get();
				$pbgFileDelete = $pbgFile->delete();
			}
            if (!empty($request->file_gambar)) { # SIMPAN GAMBAR
                if(!empty($request->id) && $karya->gambar!=''){
                    if(file_exists('uploads/karya/'.$karya->gambar)){
                        unlink('uploads/karya/'.$karya->gambar);
                    }
                }
                $ukuranFile1 = filesize($request->foto);
                if ($ukuranFile1 <= 500000) {
                    $ext_foto1 = $request->file_gambar->getClientOriginalExtension();
                    $filename1 = "Berita-".date('Ymd-His').".".$ext_foto1;
                    $temp_foto1 = 'uploads/karya/';
                    $proses1 = $request->file_gambar->move($temp_foto1, $filename1);
                    $karya->gambar = $filename1;
                }else{
                    $file1=$_FILES['foto']['name'];
                    $ext_foto1 = $request->file_gambar->getClientOriginalExtension();
                    if(!empty($file1)){
                        $direktori1='uploads/karya/'; // tempat upload foto
                        $name1='foto'; //name pada input type file
                        $namaBaru1="Berita-".date('Ymd-His'); //name pada input type file
                        $quality1=50; //konversi kualitas gambar dalam satuan %
                        $upload1 = compressFile::UploadCompress($namaBaru1,$name1,$direktori1,$quality1);
                    }
                    $karya->gambar = $namaBaru1.".".$ext_foto1;
                }
            }
            $karya->save();
            if($karya) { # SIMPAN FILE
                if (!empty($request->file)) {
					foreach ($request->file as $key => $value) {
						$karyaFile = new KaryaSiswaFile;
						// $ukuranFile1 = filesize($value);
						$ext_file = $value->getClientOriginalExtension();
						$nama_file = $value->getClientOriginalName();
						$filename1 = "Karya" . date('Ymd-His') . "_" . $key . "." . $ext_file;
						$temp_foto1 = 'uploads/karya_file/'; # Tempat simpan file pdf
						$proses1 = $value->move($temp_foto1, $filename1);
						$karyaFile->berita_id = $karya->id_berita;
						$karyaFile->original_name = $nama_file;
						$karyaFile->file_name = $filename1;
						if (!$karyaFile->save()) {
							DB::rollBack();
							return ['code' => 201, 'status' => 'error', 'Gagal.'];
						}
					}
				}
                if (!empty($request->id)) {
					foreach ($pbgFileGet as $key => $value) {
						if (file_exists('uploads/karya_file/' . $value->file_name)) {
							unlink('uploads/karya_file/' . $value->file_name);
						}
					}
				}
				DB::commit();
				return ['code' => 200, 'status' => 'success', 'Berhasil.'];
            } else {
				DB::rollBack();
				return ['code' => 201, 'status' => 'error', 'Gagal.'];
			}

        } catch(\Throwable $e) {
            DB::rollBack();
			\Log::info(json_encode($e,JSON_PRETTY_PRINT));
            return response()->json(['message' => $e->getMessage()]);
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

		$karya = Berita::find($request->id);
		$karya->status = !$karya->status;

		if (!$karya->save()) {
			return response()->json(['message'=>'Gagal'], 201);
		}
		if ($karya->status) {
			return Help::resMsg('reels Berhasil Diaktifkan',200);
		}
		return Help::resMsg('reels Berhasil Dinonaktifkan',200);
    }

    public function delete(Request $request)
	{
		$data = Berita::where('id_berita',$request->id)->delete();
		if ($data) {
			return Help::resMsg('Berhasil Menghapus',200);
		} else {
			return Help::resMsg('Gagal Menghapus',201);
		}
	}

    public function downloadFile($id) {
        if (!$file = KaryaSiswaFile::find($id)) {
			return ['status' => 'fail', 'message' => 'File tidak ditemukan!'];
		}
		if (!file_exists('uploads/karya/' . $file->file_name)) {
			return ['status' => 'fail', 'message' => 'File tidak ditemukan!'];
		}
		$fileMateri = public_path("uploads/karya/$file->file_name");
		return response()->download($fileMateri,$file->original_name);
    }
}
