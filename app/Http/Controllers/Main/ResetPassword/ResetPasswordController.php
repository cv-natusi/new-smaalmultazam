<?php

namespace App\Http\Controllers\Main\ResetPassword;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Help,Validator,DB,Auth,Hash;

class ResetPasswordController extends Controller
{
    public function main(Request $request)
    {
		$data['curNav'] = 'Menu Utama';
		$data['curMenu'] = 'REELS';
        return view('main.content.reset-password.main', $data);
    }

    public function store(Request $request) {
        // return $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'password_sekarang' => 'required',
                'password_baru' => 'required',
                // 'email' => 'email|required',
            ],
            [
                'required' => 'Kolom :attribute tidak boleh kosong',
                // 'email' => 'Kolom :attribute format email tidak sesuai'
            ]
        );

        if ($validator->fails()) {
          $pesan = $validator->errors();
          $pakai_pesan = join(',',$pesan->all());
          $return = ['status' => 'warning', 'code' => 201, 'message' => $pakai_pesan];
          return response()->json($return);
        }
        try {
            $user = Auth::user();
            // return $user->id;
          if(!Hash::check($request->password_sekarang, $user->password)){
            return response()->json(['status' => 'warning', 'code' => 402, 'message' => 'Password sebelumnya tidak sesuai']);
          }else{
            User::where('id',$user->id)->update([
              'password' => Hash::make($request->password_baru)
            ]);
            DB::commit();
            return response()->json(['status' => 'success', 'code' => 200, 'message' => 'Password Berhasil dirubah']);
          }
        } catch(\Exception $e) {
          DB::rollback();
          return response()->json([
            'status' => 'error',
            'code' => 500,
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
          ]);
        }
    }
}
