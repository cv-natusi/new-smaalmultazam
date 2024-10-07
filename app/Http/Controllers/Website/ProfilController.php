<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

# MODEL
use App\Models\Exkul;
use App\Models\Identitas;
use App\Models\Elearning\Guru;

# HELPERS
use Help;

class ProfilController extends Controller
{
    private $data;

	public function __construct()
	{
		$this->data = Help::websiteSetting();
		$this->data['curNav'] = 'Profil';
		$this->data['curNavParentId'] = '3';
        $this->data['pathGambar'] = 'uploads/identitas/';
	}

    public function sejarahSingkat() 
	{
		$data = $this->data;
		$data['pathGambar'] = 'uploads/sejarah/';
		$data['curMenu'] = 'Sejarah Singkat';
		$data['detail'] = Identitas::getSejarah();
		return view('landing-page.menu-utama',$data);
	}

    public function visiDanMisi() 
	{
		$data = $this->data;
		$data['curMenu'] = 'Visi dan Misi';
		$data['detail'] = Identitas::getVisiDanMisi();
		return view('landing-page.menu-utama',$data);
	}

    public function sambutanKepalaSekolah() 
	{
		$data = $this->data;
		$data['pathGambar'] = 'uploads/sambutan/';
		$data['curMenu'] = 'Sambutan Kepala Sekolah';
		$data['detail'] = Identitas::getSambutanKepalaSekolah();
		return view('landing-page.menu-utama',$data);
	}

    public function strukturOrganisasi() 
	{
		$data = $this->data;
		$data['curMenu'] = 'Struktur Organisasi';
		$data['detail'] = Identitas::getStrukturOrganisasi();
        $data['pathGambar'] = 'uploads/strukturorganisasi/';
		return view('landing-page.menu-utama',$data);
	}

    public function profilGuruDanTenagaPendidik() 
	{
		$data = $this->data;
		$data['curMenu'] = 'Profil Guru dan Tenaga Pendidik';
		$data['guru'] = Guru::getGuruPaginate();
		return view('landing-page.menu-utama',$data);
	}

    public function fasilitasSekolah() 
	{
		$data = $this->data;
		$data['curMenu'] = 'Fasilitas Sekolah';
		$data['fasilitas'] = Exkul::getFasilitasSekolahPaginate();
        $data['pathGambar'] = 'uploads/exkul/';
		return view('landing-page.menu-utama',$data);
	}
}
