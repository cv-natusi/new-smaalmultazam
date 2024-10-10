<?php

namespace App\Http\Controllers\Website;

use App\Helpers\Helpers as Help;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Identitas;
use App\Models\Slider;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
	private $data;

	public function __construct()
	{
		$this->data = Help::websiteSetting();
	}

	public function main() {
		$data = $this->data;		
		$data['identitas'] = Identitas::first();
		$data['slider'] = Slider::orderByRaw('coalesce(position,100) asc')->orderBy('id_slider','DESC')->limit(10)->get();
		$data['prestasi'] = Berita::where('kategori','5')->limit(4)->orderBy('id_berita', 'DESC')->where('status',true)->get();
		$data['event'] = Berita::where('kategori','2')->limit(8)->orderBy('id_berita', 'DESC')->where('status',true)->get();
		$data['berita'] = Berita::where('kategori','1')->limit(4)->orderBy('id_berita', 'DESC')->where('status',true)->get();
		return view('landing-page.landing-page',$data);
	}
}
