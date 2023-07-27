<?php

use App\Http\Controllers\Kasir;
use App\Http\Livewire\HomePage;
use App\Http\Controllers\Beranda;
use App\Http\Livewire\LandingPage;
use App\Http\Livewire\ProductPage;
use App\Http\Livewire\KategoriPage;
use App\Http\Livewire\SupplierPage;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TransactionPage;
use App\Http\Livewire\ProductBrandPage;
use App\Http\Livewire\SellingReportPage;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Livewire\BuyingTransactionPage;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\LandingpageController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::get('login',[LoginController::class,'index'])->name('login');

// Route::get('/landingpage', function () {
//         return view('layout.landingpage');
//      });

Route::controller(LandingpageController::class)->group(function(){
    // Route::get('/','index');  
    Route::get('logout','logout');
});

Route::get('/', LandingPage::class)->name('landingpage');


// Route::get('/home',[LayoutController::class,'index'])->middleware('auth');

Route::controller(LoginController::class)->group(function() {
    Route::get('login', 'index')->name('login');
    Route::post('login/proses','proses');
});

Route::get('/transaksi', TransactionPage::class)->name('transaction');

Route::group(['middleware' => ['auth']],function(){
    Route::get('/home', HomePage::class)->name('home-page');
    Route::get('/transaksi-pembelian', BuyingTransactionPage::class)->name('product-page');
        
    Route::middleware(['AdminAuth'])->group(function () {
        Route::get('/kategori', KategoriPage::class)->name('category-page');
        Route::get('/supplier', SupplierPage::class)->name('supplier-page');
        Route::get('/produk', ProductPage::class)->name('product-page');
        Route::get('/merk', ProductBrandPage::class)->name('brand-page');
        Route::get('/laporan-penjualan', SellingReportPage::class)->name('selling-report-page');        
    });

   
    // Route::group(['middleware' => ['cekUserLogin:1']],function(){
    //         Route::resource('kategori',KategoriController::class);
    //         Route::resource('produk',ProdukController::class);
    //         Route::resource('supplier',SupplierController::class);
    //         Route::resource('pembelian',PembelianController::class);
    //         Route::resource('penjualan',PenjualanController::class);
    //         Route::resource('laporan',LaporanController::class);
    // });
    // Route::group(['middleware' => ['cekUserLogin:2']],function(){
    //     Route::resource('penjualan',PenjualanController::class);
    // });
    // Route::group(['middleware' => ['cekUserLogin:3']],function(){
    //         Route::resource('petugas',petugas::class);
    // });
});