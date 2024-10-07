<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

# MODELS
use App\Models\SIM;

# HELPERS
use Help;

class SimController extends Controller
{
    private $data;

	public function __construct()
	{
		$this->data = Help::websiteSetting();
		$this->data['curNav'] = 'SIM';
		$this->data['curNavParentId'] = '6';
        $this->data['pathGambar'] = 'uploads/sim/';
	}

    public function sim() {
        $data = $this->data;
        $data['curMenu'] = 'SIM';
        $data['sim'] = SIM::getSimPaginate();
		return view('landing-page.page.sim-page',$data);
    }
}
