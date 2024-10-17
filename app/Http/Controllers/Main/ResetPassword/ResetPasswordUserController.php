<?php

namespace App\Http\Controllers\Main\ResetPassword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

 # Models
use App\Models\Users;

# HELPERS
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class ResetPasswordUserController extends Controller
{
    public function main(Request $request) {
        $data = Users::orderBy('id','DESC')
        ->get();
        if ($request->ajax()) {
        return DataTables::of($data)->
            addIndexColumn()->
            addColumn('status',function($row){
                return $row->active ? 'Aktif' : 'Tidak Aktif';
            })->
            addColumn('actions',function($row){
                $html = "<button onclick='resetPassword($row->id)' class='btn ms-1 btn-secondary p-2'><i class='bx bx-refresh mx-1'></i></button>";
                return $html;
            })->
            rawColumns(['actions'])->toJson();
        }
        return view('main.content.reset-password.user.main');
    }

    public function resetPassword(Request $request) {
        try {
            DB::beginTransaction();
            $data = Users::where('id', $request->id)->first();

          if (!$data) {
            DB::rollback();
            return response()->json([
              'error' => 'Data not found'
            ], 404);
          }

          $data->password = Hash::make($data->email);
          $data->save();

          DB::commit();
          return response()->json([
            'success' => 'Data Berhasil Direset'
          ]);
        } catch (\Exception $e) {
            DB::rollback();
          return response()->json([
            'error' => 'Terjadi kesalahan, silahkan coba lagi'
          ], 500);
        }
    }
}
