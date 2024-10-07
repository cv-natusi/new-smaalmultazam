<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

# HELPERS
use Help;

class GaleriController extends Controller
{
    private $data;

	public function __construct()
	{
		$this->data = Help::websiteSetting();
		$this->data['curNav'] = 'Galeri';
		$this->data['curNavParentId'] = '5';
        $this->data['pathGambar'] = 'uploads/galeri/';
	}

    public function galeri()
	{
        $data = $this->data;
        $data['curMenu'] = 'Galeri';
		$data['galeri'] = Galeri::getGaleriPaginate();
		return view('landing-page.page.galeri-page',$data);
    }
}
