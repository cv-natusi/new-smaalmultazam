<?php
namespace App\Helpers;

use App\Models\Identitas;
use App\Models\Menu;
use Validator;

class Helpers {
	public static function resHttp($data=[]){
		$keyData = ['message','code','response'];
		$arr = [];
		foreach($keyData as $key => $val){
			$arr[$val] = isset($data[$val]) ? $data[$val] : ( # Cek key, apakah sudah di set
				$val=='code' ? 500 : (
					$val=='message' ? '-' : []
				)
			);
		}
		$code = $arr['code'];
		$msg = $arr['message'];

		$metadata = [
			'code'    => $arr['code'],
			'message' => $arr['message'],
		];
		$payload['metadata'] = $metadata;
		$payload['response'] = $arr['response'];
		return response()->json($payload,$code);
	}

	public static function resMsg($message='Terjadi Kesalahan Sistem',$code=500) {
		return response()->json(['message'=>$message,'code'=>$code], $code);
	}

	public static function websiteSetting() {
		$data['identitas'] = Identitas::first();
        $data['menu'] = Menu::getMenu();
        $data['childMenu'] = Menu::getChildMenu();
		return $data;
	}

	public static function mainSetting() {
		$data['identitas'] = Identitas::first();
		return $data;
	}

	function errorLog() {
		
	}
}