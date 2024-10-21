<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testingController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Develop\DevelopController;
use App\Http\Controllers\Error\ErrorController;

# START LANDING PAGE CONTROLLER
use App\Http\Controllers\Website\LandingPageController;
use App\Http\Controllers\Website\MenuUtamaController;
use App\Http\Controllers\Website\ProfilController;
use App\Http\Controllers\Website\ProgramController;
use App\Http\Controllers\Website\GaleriController as WebsiteGaleriController;
use App\Http\Controllers\Website\SimController as WebsiteSimController;
use App\Http\Controllers\Website\AlumniController as WebsiteAlumniController;
# END LANDING PAGE CONTROLLER

# START MAIN CONTROLLER
use App\Http\Controllers\Main\Identitas\IdentitasController;
use App\Http\Controllers\Main\Galeri\GaleriController;
use App\Http\Controllers\Main\Sim\SimController;
use App\Http\Controllers\Main\SliderGambar\SliderGambarController;
use App\Http\Controllers\Main\Dokumen\DokumenController;
use App\Http\Controllers\Main\JurnalGuru\JurnalGuruController;
use App\Http\Controllers\Main\Alumni\AlumniController;
use App\Http\Controllers\Main\PesanDanSaran\PesanDanSaranController;

# START MAIN > MENU UTAMA
use App\Http\Controllers\Main\MenuUtama\AgendaEvent\AgendaEventController;
use App\Http\Controllers\Main\MenuUtama\BeritaSekolah\BeritaSekolahController;
use App\Http\Controllers\Main\MenuUtama\PrestasiSiswa\PrestasiSiswaController;
use App\Http\Controllers\Main\MenuUtama\Pengumuman\PengumumanController;
use App\Http\Controllers\Main\MenuUtama\Amtv\AmtvController;
# END MAIN > MENU UTAMA

# START MAIN > PROFIL SEKOLAH
use App\Http\Controllers\Main\ProfilSekolah\SejarahSingkat\SejarahSingkatController;
use App\Http\Controllers\Main\ProfilSekolah\SambutanKepalaSekolah\SambutanKepalaSekolahController;
use App\Http\Controllers\Main\ProfilSekolah\VisiDanMisi\VisiDanMisiController;
use App\Http\Controllers\Main\ProfilSekolah\StrukturOrganisasi\StrukturOrganisasiController;
use App\Http\Controllers\Main\ProfilSekolah\ProfilGuru\ProfilGuruController;
use App\Http\Controllers\Main\ProfilSekolah\FasilitasSekolah\FasilitasSekolahController;
# END MAIN > PROFIL SEKOLAH

# START MAIN > PROGRAM SEKOLAH
use App\Http\Controllers\Main\ProgramSekolah\ProgramUnggulan\ProgramUnggulanController;
use App\Http\Controllers\Main\ProgramSekolah\Ekstrakulikuler\EkstrakulikulerController;
use App\Http\Controllers\Main\ProgramSekolah\PraktekBaikGuru\PraktekBaikGuruController;
use App\Http\Controllers\Main\ProgramSekolah\KaryaSiswa\KaryaSiswaController;
use App\Http\Controllers\Main\ProgramSekolah\Uks\UksController;
# END MAIN > PROGRAM SEKOLAH

# END MAIN CONTROLLER

# START ELEARNING CONTROLLER

# START GURU

# START GURU > ELEARNING
use App\Http\Controllers\Elearning\Guru\MateriController;
use App\Http\Controllers\Elearning\Guru\SoalTulisController;

# END GURU > ELEARNING

# START ADMIN ELEARNING

# START ADMIN ELEARNING > DATA MASTER
use App\Http\Controllers\Elearning\Admin\DataGuruController;
use App\Http\Controllers\Elearning\Admin\DataKelasController;
use App\Http\Controllers\Elearning\Admin\DataSiswaController;
use App\Http\Controllers\Elearning\Admin\MataPelajaranController;
use App\Http\Controllers\Elearning\Admin\MateriElearningController;
use App\Http\Controllers\Elearning\Admin\TahunAjaranController;
use App\Http\Controllers\Elearning\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Elearning\Siswa\DataNilaiController;
use App\Http\Controllers\Elearning\Siswa\MainController;
use App\Http\Controllers\Elearning\Siswa\MateriController as SiswaMateriController;
use App\Http\Controllers\Elearning\Siswa\UjiKompetensiController;
use App\Http\Controllers\Main\MenuUtama\Reels\ReelsController;
use App\Http\Controllers\Main\ResetPassword\ResetPasswordController;
use App\Http\Controllers\Main\ResetPassword\ResetPasswordUserController;
use Illuminate\Support\Facades\Hash;

# END ADMIN ELEARNING > DATA MASTER

# END ADMIN ELEARNING

# END GURU

# END ELEARNING CONTROLLER

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function () {
	// Artisan::call('cache:clear');
	// Artisan::call('config:clear');
	Artisan::call('clear-compiled');
	// Artisan::call('cache:clear');
	// Artisan::call('route:cache');
	// Artisan::call('route:list');
	// Artisan::call('config:cache');
	// Artisan::call('view:clear');
	// Artisan::call('optimize:clear');
	// \Log::debug(Artisan::call('route:list'));
	// \Log::debug("Artisan::call('optimize:clear')");
	return "Cache cleared successfully";
 });

 Route::get('/hash', function () {
    return Hash::make('heru');
 });

Route::get('/', function () {
	return redirect()->to('beranda');
})->name('landingPage');
Route::get('beranda', [LandingPageController::class, 'main'])->name('beranda');

# START WEBSITE LANDING PAGE
Route::controller(MenuUtamaController::class)
	->prefix('menu-utama')
	->as('menuUtama.')
	->group(function () {
		Route::get('berita-sekolah/{id?}', 'beritaSekolah')->name('beritaSekolah');
		Route::get('prestasi/{id?}', 'prestasi')->name('prestasi');
		Route::get('pengumuman/{id?}', 'pengumuman')->name('pengumuman');
		Route::get('event/{id?}', 'event')->name('event');
		Route::get('amtv', 'amtv')->name('amtv');
		Route::get('reels', 'reels')->name('reels');
	});

Route::controller(ProfilController::class)
	->prefix('profil')
	->as('profil.')
	->group(function () {
		Route::get('sejarah-singkat', 'sejarahSingkat')->name('sejarahSingkat');
		Route::get('visi-dan-misi', 'visiDanMisi')->name('visiDanMisi');
		Route::get('sambutan-kepala-sekolah', 'sambutanKepalaSekolah')->name('sambutanKepalaSekolah');
		Route::get('struktur-organisasi', 'strukturOrganisasi')->name('strukturOrganisasi');
		Route::get('profil-guru-dan-tenaga-pendidik', 'profilGuruDanTenagaPendidik')->name('profilGuruDanTenagaPendidik');
		Route::get('fasilitas-sekolah', 'fasilitasSekolah')->name('fasilitasSekolah');
	});

Route::controller(ProgramController::class)
	->prefix('program')
	->as('program.')
	->group(function () {
		Route::get('program-unggulan/{id?}', 'programUnggulan')->name('programUnggulan');
		Route::get('ekstrakurikuler/{id?}', 'ekstrakurikuler')->name('ekstrakurikuler');
		Route::get('praktek-baik-guru/{id?}', 'praktekBaikGuru')->name('praktekBaikGuru');
		Route::get('karya-siswa/{id?}', 'karyaSiswa')->name('karyaSiswa');
	});

# END WEBSITE LANDING PAGE
Route::get('/galeri', [WebsiteGaleriController::class, 'galeri'])->name('galeri');
Route::get('/sim', [WebsiteSimController::class, 'sim'])->name('sim');
Route::get('/alumni', [WebsiteAlumniController::class, 'alumni'])->name('alumni');
Route::post('/send-alumni', [WebsiteAlumniController::class, 'sendAlumni'])->name('sendAlumni');

Route::get('/tests', [testingController::class, 'tests']);

# START ERROR
Route::controller(ErrorController::class)
	->prefix('error')
	->as('error.')->group(function () {
		Route::get('401', 'error401')->name('401');
		Route::get('maintenance', 'maintenance')->name('maintenance');
	});
# END ERROR

# START AUTH
Route::controller(AuthController::class)
	->as('auth.')->group(function () {
		Route::get('login', 'login')->name('login');
		Route::post('do-login', 'doLogin')->name('doLogin');
		Route::get('logout', 'logout')->name('logout');
	});
# END AUTH

// Route::group(['prefix' => 'menu-utama'], function() {
// });
// Route::get('/menu-utama/{curMenu?}/{subMenu?}', [testingController::class, 'menuUtama'])->name('menuUtama');
// Route::get('/profil/{curMenu?}/{subMenu?}', [testingController::class, 'profil'])->name('profil');
// Route::get('/program/{curMenu?}/{subMenu?}', [testingController::class, 'program'])->name('program');
// Route::get('/galeri', [testingController::class, 'galeri'])->name('galeri');
// Route::get('/sim', [testingController::class, 'sim'])->name('sim');
// Route::get('/alumni', [testingController::class, 'alumni'])->name('alumni');

# START MIDDLEWARE AUTH
Route::middleware(['auth'])->group(function () {

	# START MIDDLEWARE ADMINISTRATOR
	Route::middleware(['administrator'])->prefix('main')->as('main.')->group(function () {

		Route::get('/', function () {
			return redirect()->route('main.dashboard.main');
		});

		# START DASHBOARD
		Route::controller(DashboardController::class)
			->prefix('dashboard')
			->as('dashboard.')
			->group(function () {
				Route::get('/', 'main')->name('main');
			});
		# END DASHBOARD

		# START IDENTITAS
		Route::controller(IdentitasController::class)
			->prefix('identitas')
			->as('identitas.')
			->group(function () {
				Route::get('/', 'main')->name('main');
				Route::post('/save-data-umum', 'saveDataUmum')->name('saveDataUmum');
				Route::post('/save-data-kontak', 'saveDataKontak')->name('saveDataKontak');
			});
		# END IDENTITAS

		# START MENU UTAMA
		Route::prefix('menu-utama')
			->as('menuUtama.')
			->group(function () {

				# START AGENDA EVENT
				Route::prefix('agenda-event')
					->as('agendaEvent.')
					->group(function () {
						Route::get('/', [AgendaEventController::class, 'main'])->name('main');
						Route::post('/add', [AgendaEventController::class, 'add'])->name('add');
						Route::post('/save', [AgendaEventController::class, 'save'])->name('save');
						Route::post('/delete', [AgendaEventController::class, 'delete'])->name('delete');
						Route::post('/aktif', [AgendaEventController::class, 'aktif'])->name('aktif');
					});
				# END AGENDA EVENT

				# START BERITA SEKOLAH
				Route::prefix('berita-sekolah')
					->as('beritaSekolah.')
					->group(function () {
						Route::get('/', [BeritaSekolahController::class, 'main'])->name('main');
						Route::post('/add', [BeritaSekolahController::class, 'add'])->name('add');
						Route::post('/save', [BeritaSekolahController::class, 'save'])->name('save');
						Route::post('/delete', [BeritaSekolahController::class, 'delete'])->name('delete');
						Route::post('/aktif', [BeritaSekolahController::class, 'aktif'])->name('aktif');
					});
				# END BERITA SEKOLAH

				# START PRESTASI SISWA
				Route::prefix('prestasi-siswa')
					->as('prestasiSiswa.')
					->group(function () {
						Route::get('/', [PrestasiSiswaController::class, 'main'])->name('main');
						Route::post('/add', [PrestasiSiswaController::class, 'add'])->name('add');
						Route::post('/save', [PrestasiSiswaController::class, 'save'])->name('save');
						Route::post('/delete', [PrestasiSiswaController::class, 'delete'])->name('delete');
						Route::post('/aktif', [PrestasiSiswaController::class, 'aktif'])->name('aktif');
					});
				# END PRESTASI SISWA

				# START PENGUMUMAN
				Route::prefix('pengumuman')
					->as('pengumuman.')
					->group(function () {
						Route::get('/', [PengumumanController::class, 'main'])->name('main');
						Route::post('/add', [PengumumanController::class, 'add'])->name('add');
						Route::post('/save', [PengumumanController::class, 'save'])->name('save');
						Route::post('/delete', [PengumumanController::class, 'delete'])->name('delete');
						Route::post('/aktif', [PengumumanController::class, 'aktif'])->name('aktif');
					});
				# END PENGUMUMAN

				# START AMTV
				Route::prefix('amtv')
					->as('amtv.')
					->group(function () {
						Route::get('/', [AmtvController::class, 'main'])->name('main');
						Route::post('/add', [AmtvController::class, 'add'])->name('add');
						Route::post('/save', [AmtvController::class, 'save'])->name('save');
						Route::post('/delete', [AmtvController::class, 'delete'])->name('delete');
						Route::post('/aktif', [AmtvController::class, 'aktif'])->name('aktif');
					});
				# END AMTV

                # START REELS
				Route::prefix('reels')
                ->as('reels.')
                ->group(function () {
                    Route::get('/', [ReelsController::class, 'main'])->name('main');
                    Route::post('/add', [ReelsController::class, 'add'])->name('add');
                    Route::post('/save', [ReelsController::class, 'save'])->name('save');
                    Route::post('/delete', [ReelsController::class, 'delete'])->name('delete');
                    Route::post('/aktif', [ReelsController::class, 'aktif'])->name('aktif');
                });
                # END REELS

			});

		# START PROFIL SEKOLAH
		Route::prefix('profil-sekolah')
			->as('profilSekolah.')
			->group(function () {

				# START SEJARAH SINGKAT
				Route::prefix('sejarah-singkat')
					->as('sejarahSingkat.')
					->group(function () {
						Route::get('/', [SejarahSingkatController::class, 'main'])->name('main');
						Route::post('/save', [SejarahSingkatController::class, 'save'])->name('save');
					});
				# END SEJARAH SINGKAT

				# START SAMBUTAN KEPALA SEKOLAH
				Route::prefix('sambutan-kepala-sekolah')
					->as('sambutanKepalaSekolah.')
					->group(function () {
						Route::get('/', [SambutanKepalaSekolahController::class, 'main'])->name('main');
						Route::post('/save', [SambutanKepalaSekolahController::class, 'save'])->name('save');
					});
				# END SAMBUTAN KEPALA SEKOLAH

				# START VISI DAN MISI
				Route::prefix('visi-dan-misi')
					->as('visiDanMisi.')
					->group(function () {
						Route::get('/', [VisiDanMisiController::class, 'main'])->name('main');
						Route::post('/save', [VisiDanMisiController::class, 'save'])->name('save');
					});
				# END VISI DAN MISI

				# START STRUKTUR ORGANISASI
				Route::prefix('struktur-organisasi')
					->as('strukturOrganisasi.')
					->group(function () {
						Route::get('/', [StrukturOrganisasiController::class, 'main'])->name('main');
						Route::post('/save', [StrukturOrganisasiController::class, 'save'])->name('save');
					});
				# END STRUKTUR ORGANISASI

				# START PROFIL GURU
				Route::prefix('profil-guru')
					->as('profilGuru.')
					->group(function () {
						Route::get('/', [ProfilGuruController::class, 'main'])->name('main');
						Route::get('/add', [ProfilGuruController::class, 'add'])->name('add');
					});
				# END PROFIL GURU

				# START FASILITAS SEKOLAH
				Route::prefix('fasilitas-sekolah')
					->as('fasilitasSekolah.')
					->group(function () {
						Route::get('/', [FasilitasSekolahController::class, 'main'])->name('main');
						Route::post('/add', [FasilitasSekolahController::class, 'add'])->name('add');
						Route::post('/save', [FasilitasSekolahController::class, 'save'])->name('save');
						Route::post('/delete', [FasilitasSekolahController::class, 'delete'])->name('delete');
						Route::post('/aktif', [FasilitasSekolahController::class, 'aktif'])->name('aktif');
					});
				# END FASILITAS SEKOLAH
			});

		# START PROFIL SEKOLAH
		Route::prefix('program-sekolah')
			->as('programSekolah.')
			->group(function () {

				# START PROGRAM UNGGULAN
				Route::prefix('program-unggulan')
					->as('programUnggulan.')
					->group(function () {
						Route::get('/', [ProgramUnggulanController::class, 'main'])->name('main');
						Route::post('/add', [ProgramUnggulanController::class, 'add'])->name('add');
						Route::post('/save', [ProgramUnggulanController::class, 'save'])->name('save');
						Route::post('/delete', [ProgramUnggulanController::class, 'delete'])->name('delete');
						Route::post('/aktif', [ProgramUnggulanController::class, 'aktif'])->name('aktif');
					});
				# END PROGRAM UNGGULAN

				# START EKSTRAKULIKULER
				Route::prefix('ekstrakurikuler')
					->as('ekstrakurikuler.')
					->group(function () {
						Route::get('/', [EkstrakulikulerController::class, 'main'])->name('main');
						Route::post('/add', [EkstrakulikulerController::class, 'add'])->name('add');
						Route::post('/save', [EkstrakulikulerController::class, 'save'])->name('save');
						Route::post('/delete', [EkstrakulikulerController::class, 'delete'])->name('delete');
						Route::post('/aktif', [EkstrakulikulerController::class, 'aktif'])->name('aktif');
					});
				# END EKSTRAKULIKULER

				# START PRAKTEK BAIK GURU
				Route::prefix('praktek-baik-guru')
					->as('praktekBaikGuru.')
					->group(function () {
						Route::get('/', [PraktekBaikGuruController::class, 'main'])->name('main');
						Route::get('/add', [PraktekBaikGuruController::class, 'add'])->name('add');
					});
				# END PRAKTEK BAIK GURU

				# START KARYA SISWA
				Route::prefix('karya-siswa')
					->as('karyaSiswa.')
					->group(function () {
						Route::get('/', [KaryaSiswaController::class, 'main'])->name('main');
						Route::post('/add', [KaryaSiswaController::class, 'add'])->name('add');
						Route::post('/store', [KaryaSiswaController::class, 'store'])->name('store');
					});
				# END KARYA SISWA

			});
		# END PROFIL SEKOLAH

		# START GALERI
		Route::prefix('galeri')
			->as('galeri.')
			->group(function () {
				Route::get('/', [GaleriController::class, 'main'])->name('main');
				Route::post('/add', [GaleriController::class, 'add'])->name('add');
				Route::post('/save', [GaleriController::class, 'save'])->name('save');
				Route::post('/delete', [GaleriController::class, 'delete'])->name('delete');
				Route::post('/aktif', [GaleriController::class, 'aktif'])->name('aktif');
			});
		# END GALERI

		# START SIM
		Route::prefix('sim')
			->as('sim.')
			->group(function () {
				Route::get('/', [SimController::class, 'main'])->name('main');
				Route::post('/add', [SimController::class, 'add'])->name('add');
				Route::post('/save', [SimController::class, 'save'])->name('save');
				Route::post('/delete', [SimController::class, 'delete'])->name('delete');
				Route::post('/aktif', [SimController::class, 'aktif'])->name('aktif');
			});
		# END SIM

		# START SLIDER GAMBAR
		Route::prefix('slider-gambar')
			->as('sliderGambar.')
			->group(function () {
				Route::get('/', [SliderGambarController::class, 'main'])->name('main');
				Route::post('/add', [SliderGambarController::class, 'add'])->name('add');
				Route::post('/save', [SliderGambarController::class, 'save'])->name('save');
				Route::post('/delete', [SliderGambarController::class, 'delete'])->name('delete');
				Route::post('/update-position', [SliderGambarController::class, 'updatePosition'])->name('updatePosition');
			});
		# END SLIDER GAMBAR

		# START DOKUMEN
		Route::prefix('dokumen')
			->as('dokumen.')
			->group(function () {
				Route::get('/', [DokumenController::class, 'main'])->name('main');
				Route::get('/add', [DokumenController::class, 'add'])->name('add');
			});
		# END DOKUMEN

		# START JURNAL GURU
		Route::prefix('jurnal-guru')
			->as('jurnalGuru.')
			->group(function () {
				Route::get('/', [JurnalGuruController::class, 'main'])->name('main');
				Route::get('/add', [JurnalGuruController::class, 'add'])->name('add');
			});
		# END JURNAL GURU

		# START ALUMNI
		Route::prefix('alumni')
			->as('alumni.')
			->group(function () {
				Route::get('/', [AlumniController::class, 'main'])->name('main');
				Route::post('/import', [AlumniController::class, 'import'])->name('import');
				Route::get('/add', [AlumniController::class, 'add'])->name('add');
			});
		# END ALUMNI

		# START PESAN DAN SARAN
		Route::prefix('pesan-dan-saran')
			->as('pesanDanSaran.')
			->group(function () {
				Route::get('/', [PesanDanSaranController::class, 'main'])->name('main');
			});
		# END PESAN DAN SARAN

        # START RESET PASSWORD
        Route::prefix('reset-password')
            ->as('resetPassword.')
            ->group(function () {
                Route::get('/', [ResetPasswordController::class, 'main'])->name('main');
                Route::get('/store', [ResetPasswordController::class, 'store'])->name('store');
            });
        # END RESET PASSWORD

        # START RESET PASSWORD USER
        Route::prefix('reset-password-user')
            ->as('resetPasswordUser.')
            ->group(function () {
                Route::get('/', [ResetPasswordUserController::class, 'main'])->name('main');
                Route::post('/reset', [ResetPasswordUserController::class, 'resetPassword'])->name('reset');
            });
        # END RESET PASSWORD USER
	});
	# END MIDDLEWARE ADMINISTRATOR

	# START ELEARNING
	Route::prefix('elearning')->as('elearning.')->group(function () {

		Route::get('/', function () {
			return redirect()->route('elearning.dashboard.main');
		});

		# START DASHBOARD
		Route::controller(DashboardController::class)
			->prefix('dashboard')
			->as('dashboard.')
			->group(function () {
				Route::get('/', 'main')->name('main');
			});
		# END DASHBOARD

		# START MIDDLEWARE GURU
		Route::middleware(['guru'])->group(function () {

			# START PROFIL GURU
			Route::controller(ProfilGuruController::class)
				->prefix('profil-guru')
				->as('profil-guru.')
				->group(function () {
					Route::get('/', 'mainGuru')->name('main');
				});
			# END PROFIL GURU

			# START MATERI
			Route::controller(MateriController::class)
				->prefix('materi')
				->as('materi.')
				->group(function () {
					Route::get('/', 'main')->name('main');
					Route::post('/add', 'add')->name('add');
				});
			# END MATERI

			# START SOAL TULIS
			Route::controller(SoalTulisController::class)
				->prefix('soal-tulis')
				->as('soalTulis.')
				->group(function () {
					Route::get('/', 'main')->name('main');
					Route::post('/add', 'add')->name('add');
				});
			# END SOAL TULIS

		});
		# END MIDDLEWARE GURU

		# START MIDDLEWARE ADMIN ELEARNING
		Route::middleware(['adminElearning'])->group(function () {

			# START MASTER > TAHUN AJARAN
			Route::controller(TahunAjaranController::class)
				->prefix('tahun-ajaran')
				->as('tahunAjaran.')
				->group(function () {
					Route::get('/', 'main')->name('main');
					Route::post('/', 'add')->name('add');
				});
			# END MASTER > TAHUN AJARAN

			# START MASTER > DATA GURU
			Route::controller(DataGuruController::class)
				->prefix('data-guru')
				->as('dataGuru.')
				->group(function () {
					Route::get('/', 'main')->name('main');
					Route::post('/', 'add')->name('add');
				});
			# END MASTER > DATA GURU

			# START MASTER > DATA KELAS
			Route::controller(DataKelasController::class)
				->prefix('data-kelas')
				->as('dataKelas.')
				->group(function () {
					Route::get('/', 'main')->name('main');
					Route::post('/', 'add')->name('add');
				});
			# END MASTER > DATA KELAS

			# START MASTER > DATA SISWA
			Route::controller(DataSiswaController::class)
				->prefix('data-siswa')
				->as('dataSiswa.')
				->group(function () {
					Route::get('/', 'main')->name('main');
					Route::post('/', 'add')->name('add');
				});
			# END MASTER > DATA SISWA

			# START MASTER > MATA PELAJARAN
			Route::controller(MataPelajaranController::class)
				->prefix('mata-pelajaran')
				->as('mataPelajaran.')
				->group(function () {
					Route::get('/', 'main')->name('main');
					Route::post('/', 'add')->name('add');
				});
			# END MASTER > MATA PELAJARAN

			# START MASTER > MATERI ELEARNING
			Route::controller(MateriElearningController::class)
				->prefix('materi-elearning')
				->as('materiElearning.')
				->group(function () {
					Route::get('/', 'main')->name('main');
					Route::post('/', 'add')->name('add');
				});
			# END MASTER > MATERI ELEARNING

		});
		# END MIDDLEWARE ADMIN ELEARNING

		# START MIDDLEWARE SISWA
		Route::middleware(['siswa'])->group(function () {

			# START DASHBOARD
			Route::controller(MainController::class)
				->prefix('main')
				->as('main.')
				->group(function () {
					Route::get('/', 'kerjakan')->name('kerjakan');
				});
			# END DASHBOARD

			# START DASHBOARD
			Route::controller(SiswaMateriController::class)
				->prefix('materi-elearning')
				->as('materiElearning.')
				->group(function () {
					Route::get('/', 'main')->name('main');
				});
			# END DASHBOARD

			# START UJI KOMPETENSI
			Route::controller(UjiKompetensiController::class)
				->prefix('uji-kompetensi')
				->as('ujiKompetensi.')
				->group(function () {
					Route::get('/', 'main')->name('main');
				});
			# END UJI KOMPETENSI

			# START DATA NILAI
			Route::controller(DataNilaiController::class)
				->prefix('data-nilai')
				->as('dataNilai.')
				->group(function () {
					Route::get('/', 'main')->name('main');
				});
			# END DATA NILAI
		});
		# END MIDDLEWARE SISWA
	});
	# END ELEARNING
});

// Route::get('/dashboard', [testingController::class, 'dashboard'])->name('dashboard');
// Route::get('/identitas', [testingController::class, 'identitas'])->name('identitas');
// Route::group(['prefix' => 'menu-utama'], function() {
// Route::group(['prefix' => 'agenda-event'], function() {
// 	Route::get('/', [testingController::class, 'agendaEvent'])->name('agendaEvent');
// 	Route::get('/add', [testingController::class, 'addAgendaEvent'])->name('addAgendaEvent');
// });
// Route::group(['prefix' => 'berita-sekolah'], function() {
// 	Route::get('/', [testingController::class, 'beritaSekolah'])->name('beritaSekolah');
// 	Route::get('/add', [testingController::class, 'addBeritaSekolah'])->name('addBeritaSekolah');
// });
// Route::group(['prefix' => 'prestasi-siswa'], function() {
// 	Route::get('/', [testingController::class, 'prestasiSiswa'])->name('prestasiSiswa');
// 	Route::get('/add', [testingController::class, 'addPrestasiSiswa'])->name('addPrestasiSiswa');
// });
// Route::group(['prefix' => 'pengumuman'], function() {
// 	Route::get('/', [testingController::class, 'pengumuman'])->name('pengumuman');
// 	Route::get('/add', [testingController::class, 'addPengumuman'])->name('addPengumuman');
// });
// Route::group(['prefix' => 'amtv'], function() {
// 	Route::get('/', [testingController::class, 'amtv'])->name('amtv');
// 	Route::get('/add', [testingController::class, 'addAmtv'])->name('addAmtv');
// });
// });
// Route::group(['prefix' => 'profil-sekolah'], function() {
// 	Route::group(['prefix' => 'sejarah-singkat'], function() {
// 		Route::get('/', [testingController::class, 'sejarahSingkat'])->name('sejarahSingkat');
// 	});
// 	Route::group(['prefix' => 'sambutan-kepala-sekolah'], function() {
// 		Route::get('/', [testingController::class, 'sambutanKepalaSekolah'])->name('sambutanKepalaSekolah');
// 	});
// 	Route::group(['prefix' => 'visi-dan-misi'], function() {
// 		Route::get('/', [testingController::class, 'visiDanMisi'])->name('visiDanMisi');
// 	});
// 	Route::group(['prefix' => 'struktur-organisasi'], function() {
// 		Route::get('/', [testingController::class, 'strukturOrganisasi'])->name('strukturOrganisasi');
// 	});
// 	Route::group(['prefix' => 'profil-guru'], function() {
// 		Route::get('/', [testingController::class, 'profilGuru'])->name('profilGuru');
// 		Route::get('/add', [testingController::class, 'addProfilGuru'])->name('addProfilGuru');
// 	});
// 	Route::group(['prefix' => 'fasilitas-sekolah'], function() {
// 		Route::get('/', [testingController::class, 'fasilitasSekolah'])->name('fasilitasSekolah');
// 		Route::get('/add', [testingController::class, 'addFasilitasSekolah'])->name('addFasilitasSekolah');
// 	});
// });
// Route::group(['prefix' => 'program-sekolah'], function() {
// 	Route::group(['prefix' => 'program-unggulan'], function() {
// 		Route::get('/', [testingController::class, 'programUnggulan'])->name('programUnggulan');
// 		Route::get('/add', [testingController::class, 'addProgramUnggulan'])->name('addProgramUnggulan');
// 	});
// 	Route::group(['prefix' => 'ekstrakulikuler'], function() {
// 		Route::get('/', [testingController::class, 'ekstrakulikuler'])->name('ekstrakulikuler');
// 		Route::get('/add', [testingController::class, 'addEkstrakulikuler'])->name('addEkstrakulikuler');
// 	});
// Route::group(['prefix' => 'praktek-baik-guru'], function() {
// 	Route::get('/', [testingController::class, 'praktekBaikGuru'])->name('praktekBaikGuru');
// 	Route::get('/add', [testingController::class, 'addPraktekBaikGuru'])->name('addPraktekBaikGuru');
// });
// 	Route::group(['prefix' => 'karya-siswa'], function() {
// 		Route::get('/', [testingController::class, 'karyaSiswa'])->name('karyaSiswa');
// 		Route::get('/add', [testingController::class, 'addKaryaSiswa'])->name('addKaryaSiswa');
// 	});
// 	Route::group(['prefix' => 'uks'], function() {
// 		Route::get('/', [testingController::class, 'uks'])->name('uks');
// 	});
// });
// Route::group(['prefix' => 'galeri'], function() {
// 	Route::get('/', [testingController::class, 'galeriMain'])->name('galeriMain');
// 	Route::get('/add', [testingController::class, 'addGaleri'])->name('addGaleri');
// });
// Route::group(['prefix' => 'simMain'], function() {
// 	Route::get('/', [testingController::class, 'simMain'])->name('simMain');
// 	Route::get('/add', [testingController::class, 'addSim'])->name('addSim');
// });
// Route::group(['prefix' => 'slider-gambar'], function() {
// 	Route::get('/', [testingController::class, 'sliderGambar'])->name('sliderGambar');
// 	Route::get('/add', [testingController::class, 'addSliderGambar'])->name('addSliderGambar');
// });
// Route::group(['prefix' => 'dokumen'], function() {
// 	Route::get('/', [testingController::class, 'dokumen'])->name('dokumen');
// 	Route::get('/add', [testingController::class, 'addDokumen'])->name('addDokumen');
// });
// Route::group(['prefix' => 'jurnal-guru'], function() {
// 	Route::get('/', [testingController::class, 'jurnalGuru'])->name('jurnalGuru');
// });
// Route::group(['prefix' => 'alumni'], function() {
// 	Route::get('/', [testingController::class, 'alumniMain'])->name('alumniMain');
// });
// Route::group(['prefix' => 'pesan-dan-saran'], function() {
// 	Route::get('/', [testingController::class, 'pesanDanSaran'])->name('pesanDanSaran');
// });

// Route::get('/menu-utama', function () {
//     // return view('welcome');
//     // return view('menu-utama');
// });

// Route::get('{any?}', function () {
// 	return view('error.maintenance');
// })->where('any','.*');

Route::get('testing', [DevelopController::class, 'testing']);
