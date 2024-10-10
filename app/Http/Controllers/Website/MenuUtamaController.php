<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

# MODEL
use App\Models\Amtv;
use App\Models\Berita;
use App\Models\Identitas;
use App\Models\Menu;
use App\Models\Reels;
# HELPERS
use Help;

class MenuUtamaController extends Controller
{
	private $data;

	public function __construct()
	{
		$this->data = Help::websiteSetting();
		$this->data['curNav'] = 'Menu Utama';
		$this->data['curNavParentId'] = '2';
		$this->data['pathGambar'] = 'uploads/berita/';
	}

	public function beritaSekolah($id='')
	{
		$data = $this->data;
		$data['curMenu'] = 'Berita Sekolah';
		if($id) {
			$data['detail'] = Berita::getBeritaDetail($id);
		} else {
			$data['berita'] = Berita::getBeritaPaginate();
		}
		return view('landing-page.menu-utama',$data);
	}

	public function prestasi($id='')
	{
		$data = $this->data;
		$data['curMenu'] = 'Prestasi';
		if($id) {
			$data['detail'] = Berita::getPrestasiDetail($id);
		} else {
			$data['berita'] = Berita::getPrestasiPaginate();
		}
		return view('landing-page.menu-utama',$data);
	}

	public function pengumuman($id='')
	{
		$data = $this->data;
		$data['curMenu'] = 'Pengumuman';
		if($id) {
			$data['detail'] = Berita::getPengumumanDetail($id);
		} else {
			$data['berita'] = Berita::getPengumumanPaginate();
		}
		return view('landing-page.menu-utama',$data);
	}

	public function event($id='')
	{
		$data = $this->data;
		$data['curMenu'] = 'Event';
		if($id) {
			$data['detail'] = Berita::getEventDetail($id);
		} else {
			$data['berita'] = Berita::getEventPaginate();
		}
		return view('landing-page.menu-utama',$data);
	}

	public function amtv()
	{
		$data = $this->data;
		$data['curMenu'] = 'AMTV';
		$data['amtv'] = Amtv::getPaginate();
		return view('landing-page.menu-utama',$data);
	}

    public function reels()
	{
		$data = $this->data;
		$data['curMenu'] = 'REELS';
		$data['reels'] = Reels::getPaginate();
		return view('landing-page.menu-utama',$data);
	}
}
