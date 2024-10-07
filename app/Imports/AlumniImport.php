<?php

namespace App\Imports;

use App\Models\Alumni;
use Maatwebsite\Excel\Concerns\ToModel;

class AlumniImport implements ToModel
{
	/**
	* @param array $row
	*
	* @return User|null
	*/
	public function model(array $row)
	{
		// $alumni = new Alumni;
		// $alumni->nisn = $row[0];
		// $alumni->tahun_lulus = $row[1];

		return new Alumni([
			'nisn' => $row[0],
			'tahun_lulus' => $row[1],
		]);
	}
}