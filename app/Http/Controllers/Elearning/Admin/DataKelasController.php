<?php

namespace App\Http\Controllers\Elearning\Admin;

use App\Http\Controllers\Controller;
use App\Models\Elearning\Kelas;
use Illuminate\Http\Request;
use DataTables;

class DataKelasController extends Controller
{
    public function main(Request $request)
    {
        $data = Kelas::orderBy('id_kelas', 'DESC')
            ->has('guru')
            ->with('guru')
            ->get();
        if ($request->ajax()) {
            return DataTables::of($data)->addIndexColumn()->addColumn('kelas', function ($row) {
                return '-';
            })->addColumn('guru', function ($row) {
                return $row->guru->nama;
            })->addColumn('actions', function ($row) {
                $html = "<button onclick='tambahGuru($row->id_kelas)' class='btn ms-1 btn-primary p-2'><i class='bx bx-edit-alt mx-1'></i></button>";
                $html .= "<button onclick='hapusGuru($row->id_kelas)' class='btn ms-1 btn-danger p-2'><i class='bx bx-trash mx-1'></i></button>";
                return $html;
            })->rawColumns(['actions', 'foto'])->toJson();
        }
        return view('elearning.admin.master.data-kelas.main');
    }

    public function add(Request $request)
    {
        $data['kelas'] = Kelas::find($request->id);
        $content = view('elearning.admin.master.data-kelas.form', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }
}
