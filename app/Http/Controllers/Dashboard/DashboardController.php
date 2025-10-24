<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Berita;
use App\Models\Elearning\Guru;
use App\Models\Elearning\Siswa;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
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

        $subQuery = DB::table('visitors')
            ->selectRaw("
                DATE(created_at) as date,
                ip_address,
                MAX(CASE WHEN user_id IS NOT NULL THEN 1 ELSE 0 END) as is_user
            ")
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date', 'ip_address');

        // Langkah 2: Query Utama
        // Sekarang kita hitung hasil dari subquery di atas
        $visitorData = DB::table(DB::raw("({$subQuery->toSql()}) as sub"))
            ->mergeBindings($subQuery) // Ini penting untuk binding parameter
            ->selectRaw("
                sub.date,
                SUM(CASE WHEN sub.is_user = 0 THEN 1 ELSE 0 END) as guest_visitors,
                SUM(CASE WHEN sub.is_user = 1 THEN 1 ELSE 0 END) as user_visitors
            ")
            ->groupBy('sub.date')
            ->orderBy('sub.date', 'asc')
            ->get();

        // Format data untuk Chart.js
        $data['labels'] = $visitorData->pluck('date');
        $data['guestData'] = $visitorData->pluck('guest_visitors');
        $data['userData'] = $visitorData->pluck('user_visitors');

        return view('main.content.dashboard.main', $data);
    }
}
