<?php

namespace App\Http\Controllers\Main\MenuUtama\Reels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReelsController extends Controller
{
    public function main()
    {
    //   $status = isset($request->status) ? $request->status : '';
    //   $data = Amtv::orderBy('id_amtv','DESC')
    //     ->when(($status!=''), function ($q) use ($status) {
    //         $q->where('status_amtv',$status);
    //     })
    //     ->get();
    //     if ($request->ajax()) {
    //     return DataTables::of($data)->
    //         addIndexColumn()->
    //         // addColumn('penerbitan',function($row){
    //         // 	return $row->tanggal . ' ' . $row->jam;
    //         // })->
    //         addColumn('status_amtv',function($row){
    //             return $row->status_amtv ? 'Aktif' : 'Tidak Aktif';
    //         })->
    //         addColumn('actions',function($row){
    //             $html = "<button onclick='tambahAmtv($row->id_amtv)' class='btn btn-dark btn-purple p-2'><i class='bx bx-edit-alt mx-1'></i></button>";
    //             if ($row->status_amtv) {
    //                 $html .= "<button onclick='aktifAmtv($row->id_amtv)' class='btn ms-1 btn-secondary p-2'><i class='bx bx-power-off mx-1'></i></button>";
    //             } else {
    //                 $html .= "<button onclick='aktifAmtv($row->id_amtv)' class='btn ms-1 btn-primary p-2'><i class='bx bx-power-off mx-1'></i></button>";
    //             }
    //             $html .= "<button onclick='hapusAmtv($row->id_amtv)' class='btn ms-1 btn-danger p-2'><i class='bx bx-trash mx-1'></i></button>";
    //             return $html;
    //         })->
    //         rawColumns(['actions'])->toJson();
    //     }
        return view('main.content.reels.main');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
