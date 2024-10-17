@php
$title = 'Logo';
@endphp

<div class="sidebar-wrapper sds" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<img src="{{isset($identitas)?asset('uploads/identitas/'.$identitas->logo_kiri):asset('admin/assets/images/logo-profile.png')}}" width="30" alt="logo icon">
		</div>
		<div>
			<h5 class="logo-text" style="font-size: 14px;">{{isset($identitas)?$identitas->nama_web:'SMAS AL MULTAZAM'}}</h5>
		</div>
		<div class="toggle-icon ms-auto"><i class='bx bx-chevron-left-circle'></i></div>
	</div>
	<ul class="metismenu" id="menu">
		@auth
		@if (Auth::User()->level=='4') <!-- Siswa -->
			<li class="{{ ($title == 'Dashboard') ? 'mm-active' : ''}}">
				<a href="{{route('elearning.dashboard.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-home-circle'></i>
					</div>
					<div class="menu-title">Dashboard</div>
				</a>
			</li>
			<li class="menu-label">Content</li>
			<li class="{{ ($title == 'Materi Elearning') ? 'mm-active' : ''}}">
				<a href="{{route('elearning.materiElearning.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-file'></i>
					</div>
					<div class="menu-title">Materi Elearning</div>
				</a>
			</li>
			<li class="{{ ($title == 'Uji Kompetensi') ? 'mm-active' : ''}}">
				<a href="{{route('elearning.ujiKompetensi.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-file'></i>
					</div>
					<div class="menu-title">Uji Kompetensi</div>
				</a>
			</li>
			<li class="{{ ($title == 'Data Nilai') ? 'mm-active' : ''}}">
				<a href="{{route('elearning.dataNilai.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-file'></i>
					</div>
					<div class="menu-title">Data Nilai</div>
				</a>
			</li>
		@endif

		@if (Auth::User()->level=='3') <!-- Guru -->
			<li class="{{ ($title == 'Dashboard') ? 'mm-active' : ''}}">
				<a href="{{route('elearning.dashboard.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-home-circle'></i>
					</div>
					<div class="menu-title">Dashboard</div>
				</a>
			</li>
			<li class="{{ ($title == 'Profil Guru') ? 'mm-active' : ''}}">
				<a href="{{route('elearning.profil-guru.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-globe'></i>
					</div>
					<div class="menu-title">Profil Guru</div>
				</a>
			</li>
			<li class="{{ (in_array($title, ['Materi','Soal Tulis','Soal Listening','Pengerjaan Siswa','Nilai Siswa'])) ? 'mm-active' : ''}}">
				<a href="javascript:;" class="has-arrow">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-folder'></i>
					</div>
					<div class="menu-title">Elearning</div>
				</a>
				<ul>
					<li class="{{ ($title == 'Materi') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('elearning.materi.main')}}"><i class="bx bx-radio-circle"></i>Materi</a>
					</li>
					<li class="{{ ($title == 'Soal Tulis') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('elearning.soalTulis.main')}}"><i class="bx bx-radio-circle"></i>Soal Tulis</a>
					</li>
					<li class="{{ ($title == 'Soal Listening') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('elearning.soalTulis.main')}}"><i class="bx bx-radio-circle"></i>Soal Listening</a>
					</li>
					<li class="{{ ($title == 'Pengerjaan Siswa') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.menuUtama.prestasiSiswa.main')}}"><i class="bx bx-radio-circle"></i>Pengerjaan Siswa</a>
					</li>
					<li class="{{ ($title == 'Nilai Siswa') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.menuUtama.pengumuman.main')}}"><i class="bx bx-radio-circle"></i>Nilai Siswa</a>
					</li>
				</ul>
			</li>
			<li class="menu-label">Content</li>
			<li class="{{ ($title == 'Dokumen') ? 'mm-active' : ''}}">
				<a href="{{route('main.sliderGambar.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-file'></i>
					</div>
					<div class="menu-title">Dokumen</div>
				</a>
			</li>
			<li class="{{ ($title == 'Jurnal Guru') ? 'mm-active' : ''}}">
				<a href="{{route('main.sliderGambar.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-file'></i>
					</div>
					<div class="menu-title">Jurnal Guru</div>
				</a>
			</li>
		@endif

		@if (Auth::User()->level=='2') <!-- Admin Elearning -->
			<li class="{{ ($title == 'Dashboard') ? 'mm-active' : ''}}">
				<a href="{{route('elearning.dashboard.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-home-circle'></i>
					</div>
					<div class="menu-title">Dashboard</div>
				</a>
			</li>
			<li class="{{ (in_array($title, ['Tahun Ajaran','Data Guru','Data Kelas','Data Siswa','Mata Pelajaran'])) ? 'mm-active' : ''}}">
				<a href="javascript:;" class="has-arrow">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-folder'></i>
					</div>
					<div class="menu-title">Data Master</div>
				</a>
				<ul>
					<li class="{{ ($title == 'Tahun Ajaran') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('elearning.tahunAjaran.main')}}"><i class="bx bx-radio-circle"></i>Tahun Ajaran</a>
					</li>
					<li class="{{ ($title == 'Data Guru') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('elearning.dataGuru.main')}}"><i class="bx bx-radio-circle"></i>Data Guru</a>
					</li>
					<li class="{{ ($title == 'Data Kelas') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('elearning.dataKelas.main')}}"><i class="bx bx-radio-circle"></i>Data Kelas</a>
					</li>
					<li class="{{ ($title == 'Data Siswa') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('elearning.dataSiswa.main')}}"><i class="bx bx-radio-circle"></i>Data Siswa</a>
					</li>
					<li class="{{ ($title == 'Mata Pelajaran') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('elearning.mataPelajaran.main')}}"><i class="bx bx-radio-circle"></i>Mata Pelajaran</a>
					</li>
				</ul>
			</li>
			<li class="menu-label">Content</li>
			<li class="{{ ($title == 'Materi Elearning') ? 'mm-active' : ''}}">
				<a href="{{route('elearning.materiElearning.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-file'></i>
					</div>
					<div class="menu-title">Materi Elearning</div>
				</a>
			</li>
			<li class="{{ ($title == 'Soal Elearning') ? 'mm-active' : ''}}">
				<a href="{{route('main.sliderGambar.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-file'></i>
					</div>
					<div class="menu-title">Soal Elearning</div>
				</a>
			</li>
			<li class="{{ ($title == 'Pengerjaan Siswa') ? 'mm-active' : ''}}">
				<a href="{{route('main.sliderGambar.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-file'></i>
					</div>
					<div class="menu-title">Pengerjaan Siswa</div>
				</a>
			</li>
			<li class="{{ ($title == 'Data Nilai') ? 'mm-active' : ''}}">
				<a href="{{route('main.sliderGambar.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-file'></i>
					</div>
					<div class="menu-title">Data Nilai</div>
				</a>
			</li>
		@endif

		@if (Auth::User()->level=='1') <!-- Admin -->
			<li class="{{ ($title == 'Dashboard') ? 'mm-active' : ''}}">
				<a href="{{route('main.dashboard.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-home-circle'></i>
					</div>
					<div class="menu-title">Dashboard</div>
				</a>
			</li>
			<li class="{{ ($title == 'Identitas') ? 'mm-active' : ''}}">
				<a href="{{route('main.identitas.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-globe'></i>
					</div>
					<div class="menu-title">Identitas Website</div>
				</a>
			</li>
			<li class="{{ (in_array($title, ['Agenda / Event','Berita Sekolah','Prestasi Siswa','Pengumuman','AMTV'])) ? 'mm-active' : ''}}">
				<a href="javascript:;" class="has-arrow">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-folder'></i>
					</div>
					<div class="menu-title">Menu Utama</div>
				</a>
				<ul>
					<li class="{{ ($title == 'Agenda / Event') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.menuUtama.agendaEvent.main')}}"><i class="bx bx-radio-circle"></i>Agenda / Event</a>
					</li>
					<li class="{{ ($title == 'Berita Sekolah') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.menuUtama.beritaSekolah.main')}}"><i class="bx bx-radio-circle"></i>Berita Sekolah</a>
					</li>
					<li class="{{ ($title == 'Prestasi Siswa') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.menuUtama.prestasiSiswa.main')}}"><i class="bx bx-radio-circle"></i>Prestasi Siswa</a>
					</li>
					{{-- <li class="{{ ($title == 'Pengumuman') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.menuUtama.pengumuman.main')}}"><i class="bx bx-radio-circle"></i>Pengumuman</a>
					</li> --}}
					<li class="{{ ($title == 'AMTV') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.menuUtama.amtv.main')}}"><i class="bx bx-radio-circle"></i>AMTV</a>
					</li>
                    <li class="{{ ($title == 'REELS') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.menuUtama.reels.main')}}"><i class="bx bx-radio-circle"></i>REELS</a>
					</li>
				</ul>
			</li>
			<li class="{{ (in_array($title, ['Sejarah Singkat','Sambutan Kep.Sek','Visi Misi','Struktur Organisasi','Profil Guru','Fasilitas Sekolah'])) ? 'mm-active' : ''}}">
				<a href="javascript:;" class="has-arrow">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-folder'></i>
					</div>
					<div class="menu-title">Profil Sekolah</div>
				</a>
				<ul>
					<li class="{{ ($title == 'Sejarah Singkat') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.profilSekolah.sejarahSingkat.main')}}"><i class="bx bx-radio-circle"></i>Sejarah Singkat</a>
					</li>
					<li class="{{ ($title == 'Sambutan Kep.Sek') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.profilSekolah.sambutanKepalaSekolah.main')}}"><i class="bx bx-radio-circle"></i>Sambutan Kep.Sek</a>
					</li>
					<li class="{{ ($title == 'Visi Misi') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.profilSekolah.visiDanMisi.main')}}"><i class="bx bx-radio-circle"></i>Visi dan Misi</a>
					</li>
					<li class="{{ ($title == 'Struktur Organisasi') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.profilSekolah.strukturOrganisasi.main')}}"><i class="bx bx-radio-circle"></i>Struktur Organisasi</a>
					</li>
					<li class="{{ ($title == 'Profil Guru') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.profilSekolah.profilGuru.main')}}"><i class="bx bx-radio-circle"></i>Profil Guru</a>
					</li>
					<li class="{{ ($title == 'Fasilitas Sekolah') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.profilSekolah.fasilitasSekolah.main')}}"><i class="bx bx-radio-circle"></i>Fasilitas Sekolah</a>
					</li>
				</ul>
			</li>
			<li class="{{ (in_array($title, ['Program Unggulan','Ekstrakurikuler','Praktek Baik Guru','Karya Siswa','UKS'])) ? 'mm-active' : ''}}">
				<a href="javascript:;" class="has-arrow">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-folder'></i>
					</div>
					<div class="menu-title">Program Sekolah</div>
				</a>
				<ul>
					<li class="{{ ($title == 'Program Unggulan') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.programSekolah.programUnggulan.main')}}"><i class="bx bx-radio-circle"></i>Program Unggulan</a>
					</li>
					<li class="{{ ($title == 'Ekstrakurikuler') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.programSekolah.ekstrakurikuler.main')}}"><i class="bx bx-radio-circle"></i>Ekstrakurikuler</a>
					</li>
					<li class="{{ ($title == 'Praktek Baik Guru') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.programSekolah.praktekBaikGuru.main')}}"><i class="bx bx-radio-circle"></i>Praktek Baik Guru</a>
					</li>
					<li class="{{ ($title == 'Karya Siswa') ? 'mm-active' : ''}}">
						<a style="color: #fff" href="{{route('main.programSekolah.karyaSiswa.main')}}"><i class="bx bx-radio-circle"></i>Karya Siswa</a>
					</li>
				</ul>
			</li>
			<li class="{{ ($title == 'Galeri') ? 'mm-active' : ''}}">
				<a href="{{route('main.galeri.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-image-alt'></i>
					</div>
					<div class="menu-title">Galeri</div>
				</a>
			</li>
			<li class="{{ ($title == 'SIM') ? 'mm-active' : ''}}">
				<a href="{{route('main.sim.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-file'></i>
					</div>
					<div class="menu-title">SIM</div>
				</a>
			</li>
			<li class="menu-label">Content</li>
			<li class="{{ ($title == 'Slider Gambar') ? 'mm-active' : ''}}">
				<a href="{{route('main.sliderGambar.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-image-alt'></i>
					</div>
					<div class="menu-title">Slider Gambar</div>
				</a>
			</li>
			<li class="{{ ($title == 'Dokumen') ? 'mm-active' : ''}}">
				<a href="{{route('main.dokumen.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-file'></i>
					</div>
					<div class="menu-title">Dokumen</div>
				</a>
			</li>
			<li class="{{ ($title == 'Jurnal Guru') ? 'mm-active' : ''}}">
				<a href="{{route('main.jurnalGuru.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-file'></i>
					</div>
					<div class="menu-title">Jurnal Guru</div>
				</a>
			</li>
			<li class="menu-label">Lain lain</li>
			<li class="{{ ($title == 'Alumni') ? 'mm-active' : ''}}">
				<a href="{{route('main.alumni.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-file'></i>
					</div>
					<div class="menu-title">Alumni</div>
				</a>
			</li>
			<li class="{{ ($title == 'Pesan dan Saran') ? 'mm-active' : ''}}">
				<a href="{{route('main.pesanDanSaran.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-file'></i>
					</div>
					<div class="menu-title">Pesan dan Saran</div>
				</a>
			</li>
            <li class="menu-label">Pengaturan</li>
			<li class="{{ ($title == 'Alumni') ? 'mm-active' : ''}}">
				<a href="{{route('main.resetPassword.main')}}">

					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-cog'></i>
					</div>
					<div class="menu-title">Reset Password</div>
				</a>
			</li>
            <li class="{{ ($title == 'Alumni') ? 'mm-active' : ''}}">
				<a href="{{route('main.resetPasswordUser.main')}}">
					<div class="parent-icon">
						<i style="color: #fff" class='bx bx-cog'></i>
					</div>
					<div class="menu-title">Reset Password User</div>
				</a>
			</li>
		@endif
		@endauth
	</ul>
	<!--end navigation-->
</div>
