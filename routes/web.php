<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminRegister;
use App\Http\Controllers\PengaduanController;
use App\Models\Pengaduan;
use App\Models\User;

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

Route::get('/', function () {
    return view('index', [
        'laporan' => Pengaduan::all(),
        'user' => User::all()
    ]);

});

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/


/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/Admin/Semua/Laporan', [HomeController::class, 'laporanAdmin'])->name('laporan.admin');
});
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/Admin/Validasi/Laporan', [HomeController::class, 'laporanAdminValidasi']);
});
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/Admin/Selesai/Laporan', [HomeController::class, 'laporanAdminSelesai']);
});
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/adminRegister', [HomeController::class, 'adminRegister'])->name('admin.tambah');
});
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::post('/registerAdmin', [AdminRegister::class, 'register'])->name('admin.register');
});
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/laporanDetail/{id_pengaduan}', [HomeController::class, 'detail'])->whereNumber('id_pengaduan')->name('detail.laporan');
});
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::post('/ajukan/{id_pengaduan}', [PengaduanController::class, 'ajukan'])->name('ajukan');
});
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::post('/hapus/validasi/{id_pengaduan}/{foto}', [PengaduanController::class, 'hapusValidasi'])->name('validasi.hapus');
});
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/ban/{id}', [AdminRegister::class, 'ban'])->name('ban');
});
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/pulihkan/{id}', [AdminRegister::class, 'pulihkan'])->name('pulihkan');
});
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/hapus/petugas/{id}', [AdminRegister::class, 'hapusPetugas'])->name('hapus.petugas');
});
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::post('/export/laporan/pdf', [PengaduanController::class, 'exportPDF'])->name('export.pdf');
});
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::post('/export/tanggapan/pdf', [PengaduanController::class, 'exportPDF2'])->name('export.pdf2');
});

Route::middleware(['auth', 'user-access:banned'])->group(function () {

    Route::get('/ban', [AdminRegister::class, 'banned'])->name('banned');
});


Route::middleware(['auth', 'user-access:petugas'])->group(function () {

    Route::get('/laporanPetugas', [HomeController::class, 'laporanPetugas'])->name('laporan.petugas');
});
Route::middleware(['auth', 'user-access:petugas'])->group(function () {

    Route::get('/petugas/home', [HomeController::class, 'petugasHome'])->name('petugas.home');
});
Route::middleware(['auth', 'user-access:petugas'])->group(function () {

    Route::get('/{id_pengaduan}', [HomeController::class, 'laporanDetailPetugas'])->whereNumber('id_pengaduan')->name('laporan.detail.petugas');
});
Route::middleware(['auth', 'user-access:petugas'])->group(function () {

    Route::post('/tanggapan{id_pengaduan}', [PengaduanController::class, 'tanggapan'])->name('tanggapan');
});
Route::middleware(['auth', 'user-access:petugas'])->group(function () {

    Route::get('/petugas/tanggapan', [HomeController::class, 'laporanPetugasSelesai'])->name('laporan.petugas.selesai');
});


Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [PengaduanController::class, 'index'])->name('laporan.user');
});
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/laporanUser', [PengaduanController::class, 'index'])->name('laporan.user');
});
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/laporan/gagal', [PengaduanController::class, 'laporanGagal'])->name('laporan.gagal');
});
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::post('/laporanUser', [PengaduanController::class, 'tambahLaporan'])->name('tambah.laporan');
});
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/lihat/tanggapan/{id_tanggapan}', [PengaduanController::class, 'selesaiUser']);
});
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/hapus/{id_pengaduan}/{foto}', [PengaduanController::class, 'hapusLaporan'])->name('hapus.laporan');
});
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::patch('update/laporan/{id_pengaduan}', [PengaduanController::class, 'update'])->name('update.laporan');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:petugas'])->group(function () {

    Route::get('/petugas/home', [HomeController::class, 'petugasHome'])->name('petugas.home');
});


