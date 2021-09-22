<?php

use App\Http\Controllers\Admin\BanerController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PerawatController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\RawatInapController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\User\DikemasController;
use App\Http\Controllers\User\KeranjangController;
use App\Http\Controllers\User\MenungguController;
use App\Http\Controllers\User\PembayaranController;
use App\Http\Controllers\User\PengirimanController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SelesaiController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

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

Route::get(
    '/',
    function () {
        return view('login');
    }
)->name('login');
Route::post('/', [AuthController::class, 'login']);

Route::get(
    '/tentang-kami',
    function () {
        return view('tentang');
    }
);

Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/register-member', [AuthController::class, 'registerMember']);

Route::post('/login', [AuthController::class, 'login']);

Route::prefix('/admin')->middleware('auth')->group(
    function () {

        Route::get(
            '/',
            function () {
                return view('admin/dashboard');
            }
        );

        Route::match(['post', 'get'], '/dokter', [DokterController::class, 'index']);
        Route::get('/dokter/{id}/delete', [DokterController::class, 'delete']);

        Route::match(['post', 'get'], '/pasien', [PasienController::class, 'index']);
        Route::get('/pasien/{id}/delete', [PasienController::class, 'delete']);

        Route::match(['post', 'get'], '/obat', [ObatController::class, 'index']);
        Route::get('/obat/{id}/delete', [ObatController::class, 'delete']);

        Route::match(['post', 'get'], '/perawat', [PerawatController::class, 'index']);
        Route::get('/perawat/{id}/delete', [PerawatController::class, 'delete']);

        Route::match(['post', 'get'], '/tindakan', [TindakanController::class, 'index']);
        Route::get('/tindakan/{id}/delete', [TindakanController::class, 'delete']);

        Route::match(['post', 'get'], '/kamar', [KamarController::class, 'index']);
        Route::get('/kamar/{id}/delete', [KamarController::class, 'delete']);

        Route::match(['post', 'get'], '/rawatinap', [RawatInapController::class, 'index']);
        Route::get('/rawatinap/{id}/delete', [RawatInapController::class, 'deleteRawatInap']);
        Route::match(['post', 'get'], '/rawatinap/{id}', [RawatInapController::class, 'detail']);
        Route::get('/rawatinap/{id}/deleteperawatan', [RawatInapController::class, 'deletePerawatan']);
        Route::post('/rawatinap/{id}/bayar', [RawatInapController::class, 'bayar']);

        Route::get('/laporan', [LaporanController::class, 'index']);
        Route::get('/cetakpersetujuan/{id}', [LaporanController::class, 'cetakpersetujuan']);
        Route::get('/cetakpembayaran/{id}', [LaporanController::class, 'cetakpembayaran']);
        Route::get('/cetakpembayarandetail', [LaporanController::class, 'cetakpembayarand']);
        Route::get('/cetaklaporan', [LaporanController::class, 'cetaklaporan']);
        Route::get('/cetaklaporanterdaftar', [LaporanController::class, 'cetakLaporanPasienTerdaftar']);
        Route::get('/cetaklaporanpendapatan', [LaporanController::class, 'cetakLaporanPendapatan']);

        Route::get('/laporan', [LaporanController::class, 'index']);
        Route::get('/laporan-pasien', [LaporanController::class, 'laporanpasien']);

        Route::get('/laporan-riwayat',[LaporanController::class, 'laporanRiwayatPasien']);
        Route::get('/laporan-riwayat/{id}',[LaporanController::class, 'laporanRiwayatPasienDetail']);

        Route::get('/laporan-pendapatan',[LaporanController::class,'laporanPendapatan']);
    }
);

// Route::prefix('/admin')->middleware(AdminMiddleware::class)->group(function (){
//     Route::get('/', [DashboardController::class, 'index']);

//     Route::match(['get','post'],'/bank', [BankController::class,'index']);
//     Route::get('/kategori', [KategoriController::class,'index']);
//     Route::post('/kategori', [KategoriController::class,'addKategori']);

//     Route::prefix('/produk')->group(function (){
//         Route::get('/', [ProdukController::class,'index']);
//         Route::match(['get','post'],'/data', [ProdukController::class,'data']);
//         Route::get('/kategori', [KategoriController::class,'dataKategori'])->name('produk_kategori');
//         Route::post('/kategori', [KategoriController::class,'addKategori']);
//         Route::match(['get','post'],'/image', [ProdukController::class,'addImage']);
//     });

//     Route::get('/pelanggan', [MemberController::class,'index']);
//     Route::get('/laporan', [LaporanController::class,'index']);

//     Route::match(['post','get'],'/baner', [BanerController::class,'index']);
//     Route::get('/baner/{id}/delete', [BanerController::class,'delete']);

//     Route::get('/pesanan', [PesananController::class,'index']);
//     Route::match(['post','get'],'/pesanan/{id}', [PesananController::class,'getDetailPesanan']);

//     Route::get('/cetaklaporan',[LaporanController::class, 'cetakLaporan']);
// });



