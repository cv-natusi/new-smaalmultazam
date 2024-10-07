<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
	protected $table = "menu";
	protected $primaryKey = "id_menu";
	public $timestamps = false;

	public static function getMenuUtama(){
		return Menu::where('parent_id', 2)
			->where('aktif', true)
			->get();
	}

	public static function getProfil(){
		return Menu::where('parent_id', 3)
			->where('aktif', true)
			->get();
	}

	public static function getProgram(){
		return Menu::where('parent_id', 4)
			->where('aktif', true)
			->get();
	}

	public static function getMenu(){
		return Menu::where('parent_id', 0)
			->where('aktif', true)
			->get();
	}

	public static function getChildMenu(){
		return Menu::where('parent_id', '!=', 0)
			->where('aktif', true)
			->get();
	}
}
