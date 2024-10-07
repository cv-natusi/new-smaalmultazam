<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Berita;
use App\Models\Elearning\Guru;
use App\Models\Elearning\Siswa;
use Illuminate\Http\Request;

use Help, Auth;

class DashboardController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data = Help::mainSetting();
    }

    function main()
    {
        $data = $this->data;
        // if (Auth::user()->level_user === 4) {
        //     return view('elearning.siswa.dashboard.main', $data);
        // }
        $data['siswa'] = Siswa::where('status', 'Siswa Aktif')->count();
        $data['alumni'] = Alumni::count();
        $data['guru'] = Guru::count();
        $data['prestasi'] = Berita::where('status', 1)->where('kategori',1)->count();
        return view('main.content.dashboard.main', $data);
    }
}
