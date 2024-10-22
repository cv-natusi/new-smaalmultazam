<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Elearning\Guru;
use App\Models\Exkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

# HELPERS
use Help;

class ProgramController extends Controller
{
    private $data;

	public function __construct()
	{
		$this->data = Help::websiteSetting();
		$this->data['curNav'] = 'Program';
		$this->data['curNavParentId'] = '4';
        $this->data['pathGambar'] = 'uploads/berita/';
	}

  public function programUnggulan($id='')
	{
        $data = $this->data;
        $data['curMenu'] = 'Program Unggulan';
		if($id) {
			$data['detail'] = Berita::getProgramUnggulanDetail($id);
		} else {
			$data['berita'] = Berita::getProgramUnggulanPaginate();
		}
		return view('landing-page.menu-utama',$data);
	}

  public function ekstrakurikuler($id='')
	{
        $data = $this->data;
        $data['curMenu'] = 'Ekstrakurikuler';
        $data['pathGambar'] = 'uploads/exkul/';
		if($id) {
			$data['detail'] = Exkul::getEkstrakulikulerDetail($id);
		} else {
			$data['berita'] = Exkul::getEkstrakulikulerPaginate();
		}
		return view('landing-page.menu-utama',$data);
	}

  public function praktekBaikGuru($id='')
	{
        $data = $this->data;
		$data['curMenu'] = 'Praktek Baik Guru';
		$data['pathGambar'] = 'uploads/praktek/';
		if($id) {
			$data['detail'] = Http::get('https://learning.smaalmultazam-mjk.sch.id/api/praktek-baik-guru/'.$id)->object();
		} else {
			$data['berita'] = Http::get('https://learning.smaalmultazam-mjk.sch.id/api/praktek-baik-guru')->object();
		}
        $dataGuru = Http::get('https://learning.smaalmultazam-mjk.sch.id/api/praktek-baik-guru/')->object();
        $data['guru'] = Guru::where('users_id',$dataGuru->data[0]->user_id)->first();

        // return $data;
		return view('landing-page.menu-utama',$data);
	}

  public function karyaSiswa($id='')
	{
        $data = $this->data;
        $data['curMenu'] = 'Karya Siswa';
        $data['pathGambar'] = 'uploads/karya/';
		if($id) {
			$data['detail'] = Berita::getKaryaSiswaDetail($id);
		} else {
			$data['berita'] = Berita::getKaryaSiswaPaginate();
		}
		return view('landing-page.menu-utama',$data);
	}
}
