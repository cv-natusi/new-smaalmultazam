<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Help;

class testingController extends Controller
{
	public $menuUtama = ['Berita Sekolah','Prestasi','Pengumuman','AMTV'];
	public $profil = ['Sejarah Singkat','Sambutan Kepala Sekolah','Visi dan Misi','Struktur Organisasi','Profil Guru dan Tenaga Pendidik','Fasilitas Sekolah'];
	public $program = ['Program Unggulan','Ekstrakulikuler','Praktek Baik Guru','Karya Siswa','UKS'];

	function tests() {
		return Help::resHttp(['code'=>200,'message'=>Auth::user()]);
	}

	public function menuUtama(string $curMenu='', string $subCurMenu='') {
		$data['curNav'] = 'Menu Utama';
		$data['menuList'] = $this->menuUtama;
		if ($curMenu == 'berita-sekolah') {
			$data['curMenu'] = 'Berita Sekolah';
			$data['content'] = $this->beritaSekolahGetter($subCurMenu);
		} else if ($curMenu == 'prestasi') {
			$data['curMenu'] = 'Prestasi';
		} else if ($curMenu == 'pengumuman') {
			$data['curMenu'] = 'Pengumuman';
		} else if ($curMenu == 'amtv') {
			$data['curMenu'] = 'AMTV';
		} else {
			return redirect()->route('menuUtama',[strtolower(str_replace(' ','-',$this->menuUtama[0]))]);
		}

		return view('landing-page.menu-utama', $data);
	}

	public function profil(string $curMenu='', string $subCurMenu='') {
		$data['curNav'] = 'Profil';
		$data['menuList'] = $this->profil;
		if ($curMenu == 'sejarah-singkat') {
			$data['curMenu'] = 'Sejarah Singkat';
			$data['content'] = $this->beritaSekolahGetter($subCurMenu);
		} else if ($curMenu == 'sambutan-kepala-sekolah') {
			$data['curMenu'] = 'Sambutan Kepala Sekolah';
		} else if ($curMenu == 'visi-dan-misi') {
			$data['curMenu'] = 'Visi dan Misi';
		} else if ($curMenu == 'struktur-organisasi') {
			$data['curMenu'] = 'Struktur Organisasi';
		} else if ($curMenu == 'profil-guru-dan-tenaga-pendidik') {
			$data['curMenu'] = 'Profil Guru dan Tenaga Pendidik';
		} else if ($curMenu == 'fasilitas-sekolah') {
			$data['curMenu'] = 'Fasilitas Sekolah';
		} else {
			return redirect()->route('profil',[strtolower(str_replace(' ','-',$this->profil[0]))]);
		}

		return view('landing-page.menu-utama', $data);
	}

	public function program(string $curMenu='', string $subCurMenu='') {
		$data['curNav'] = 'Program';
		$data['menuList'] = $this->program;
		if ($curMenu == 'program-unggulan') {
			$data['curMenu'] = 'Program Unggulan';
		} else if ($curMenu == 'ekstrakulikuler') {
			$data['curMenu'] = 'Ekstrakulikuler';
		} else if ($curMenu == 'visi-dan-misi') {
			$data['curMenu'] = 'Visi dan Misi';
		} else if ($curMenu == 'praktek-baik-guru') {
			$data['curMenu'] = 'Praktek Baik Guru';
		} else if ($curMenu == 'karya-siswa') {
			$data['curMenu'] = 'Karya Siswa';
		} else if ($curMenu == 'uks') {
			$data['curMenu'] = 'uks';
		} else {
			return redirect()->route('program',[strtolower(str_replace(' ','-',$this->program[0]))]);
		}

		return view('landing-page.menu-utama', $data);
	}
	
	public function galeri() {
		$data['curNav'] = 'Galeri';
		$data['curMenu'] = 'Galeri';
		return view('landing-page.page.galeri-page', $data);
	}

	public function sim() {
		$data['curNav'] = 'SIM';
		$data['curMenu'] = 'Sistem Informasi Management (SIM)';
		return view('landing-page.page.sim-page', $data);
	}

	public function alumni() {
		$data['curNav'] = 'Alumni';
		$data['curMenu'] = 'Portal Alumni';
		return view('landing-page.page.alumni-page', $data);
	}
	
	public function beritaSekolahGetter($isDetail) {
		if ($isDetail!='') {
			$data['isDetail'] = true;
		}
		$data['beritaSekolah'] = (object)[];
		return $data;
	}

	public function dashboard() {
		return view('main.content.dashboard.main');
	}

	public function identitas() {
		return view('main.content.identitas.main');
	}

	public function agendaEvent() {
		return view('main.content.agenda.main');
	}

	public function addAgendaEvent() {
		return view('main.content.agenda.form');
	}

	public function beritaSekolah() {
		return view('main.content.berita.main');
	}

	public function addBeritaSekolah() {
		return view('main.content.berita.form');
	}

	public function prestasiSiswa() {
		return view('main.content.prestasi.main');
	}

	public function addPrestasiSiswa() {
		return view('main.content.prestasi.form');
	}

	public function pengumuman() {
		return view('main.content.pengumuman.main');
	}

	public function addPengumuman() {
		return view('main.content.pengumuman.form');
	}

	public function amtv() {
		return view('main.content.amtv.main');
	}
	
	public function addAmtv() {
		return view('main.content.amtv.form');
	}
	
	public function sejarahSingkat() {
		return view('main.content.sejarah-singkat.main');
	}
	
	public function sambutanKepalaSekolah() {
		return view('main.content.sambutan-kepala-sekolah.main');
	}
	
	public function visiDanMisi() {
		return view('main.content.visi-dan-misi.main');
	}

	public function strukturOrganisasi() {
		return view('main.content.struktur-organisasi.main');
	}

	public function profilGuru() {
		return view('main.content.profil-guru.main');
	}

	public function addProfilGuru() {
		return view('main.content.profil-guru.form');
	}

	public function fasilitasSekolah() {
		return view('main.content.fasilitas.main');
	}

	public function addFasilitasSekolah() {
		return view('main.content.fasilitas.form');
	}

	public function programUnggulan() {
		return view('main.content.program-unggulan.main');
	}

	public function addProgramUnggulan() {
		return view('main.content.program-unggulan.form');
	}

	public function ekstrakulikuler() {
		return view('main.content.ekstrakulikuler.main');
	}

	public function addEkstrakulikuler() {
		return view('main.content.ekstrakulikuler.form');
	}

	public function praktekBaikGuru() {
		return view('main.content.praktek-baik-guru.main');
	}

	public function addPraktekBaikGuru() {
		return view('main.content.praktek-baik-guru.form');
	}

	public function karyaSiswa() {
		return view('main.content.karya-siswa.main');
	}

	public function addKaryaSiswa() {
		return view('main.content.karya-siswa.form');
	}
	
	public function uks() {
		return view('main.content.uks.main');
	}

	public function galeriMain() {
		return view('main.content.galeri.main');
	}

	public function addGaleri() {
		return view('main.content.galeri.form');
	}

	public function simMain() {
		return view('main.content.sim.main');
	}

	public function addSim() {
		return view('main.content.sim.form');
	}

	public function sliderGambar() {
		return view('main.content.slider.main');
	}

	public function addSliderGambar() {
		return view('main.content.slider.form');
	}

	public function dokumen() {
		return view('main.content.dokumen.main');
	}
	
	public function addDokumen() {
		return view('main.content.dokumen.form');
	}

	public function jurnalGuru() {
		return view('main.content.jurnal-guru.main');
	}

	public function alumniMain() {
		return view('main.content.alumni.main');
	}

	public function pesanDanSaran() {
		return view('main.content.pesan-dan-saran.main');
	}
}
