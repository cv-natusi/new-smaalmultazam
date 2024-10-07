<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Menu::truncate();
		$data = [
			[
				'parent_id' => 0,
				'nama_menu' => 'Beranda',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 0,
				'nama_menu' => 'Menu Utama',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 0,
				'nama_menu' => 'Profil',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 0,
				'nama_menu' => 'Program',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 0,
				'nama_menu' => 'Galeri',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 0,
				'nama_menu' => 'SIM',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 0,
				'nama_menu' => 'Alumni',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 2,
				'nama_menu' => 'Berita Sekolah',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 2,
				'nama_menu' => 'Prestasi',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 2,
				'nama_menu' => 'Pengumuman',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 2,
				'nama_menu' => 'Event',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 2,
				'nama_menu' => 'AMTV',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 3,
				'nama_menu' => 'Sejarah Singkat',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 3,
				'nama_menu' => 'Sambutan Kepala Sekolah',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 3,
				'nama_menu' => 'Visi dan Misi',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 3,
				'nama_menu' => 'Struktur Organisasi',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 3,
				'nama_menu' => 'Profil Guru dan Tenaga Pendidik',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 3,
				'nama_menu' => 'Fasilitas Sekolah',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 4,
				'nama_menu' => 'Program Unggulan',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 4,
				'nama_menu' => 'Ekstrakurikuler',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 4,
				'nama_menu' => 'Praktek Baik Guru',
				'aktif' => true,
				'kunjungan' => 0
			],
			[
				'parent_id' => 4,
				'nama_menu' => 'Karya Siswa',
				'aktif' => true,
				'kunjungan' => 0
			],
		];
		Menu::insert($data);
	}
}
