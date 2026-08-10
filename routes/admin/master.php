<?php

use App\Http\Controllers\Admin\Master\AdvantageController;
use App\Http\Controllers\Admin\Master\BannerController;
use App\Http\Controllers\Admin\Master\BeritaController;
use App\Http\Controllers\Admin\Master\BeritaKategoriController;
use App\Http\Controllers\Admin\Master\BisnisKategoriController;
use App\Http\Controllers\Admin\Master\CompanyController;
use App\Http\Controllers\Admin\Master\CustomerController;
use App\Http\Controllers\Admin\Master\DokumenController;
use App\Http\Controllers\Admin\Master\DokumenKategoriController;
use App\Http\Controllers\Admin\Master\FacilityController;
use App\Http\Controllers\Admin\Master\FacilityCoreController;
use App\Http\Controllers\Admin\Master\GalleryController;
use App\Http\Controllers\Admin\Master\IsoController;
use App\Http\Controllers\Admin\Master\KarirController;
use App\Http\Controllers\Admin\Master\KarirFormFieldController;
use App\Http\Controllers\Admin\Master\KarirLamaranController;
use App\Http\Controllers\Admin\Master\PengalamanController;
use App\Http\Controllers\Admin\Master\PersonilController;
use App\Http\Controllers\Admin\Master\LineController;
use App\Http\Controllers\Admin\Master\PageDetailController;
use App\Http\Controllers\Admin\Master\ProductController;
use App\Http\Controllers\Admin\Master\RuangUnduhController;
use App\Http\Controllers\Admin\Master\RuangUnduhKategoriController;
use Illuminate\Support\Facades\Route;

// prefix name route = admin.
Route::prefix('/master')->name('master.')->group(function () {

     // ==== page-detail Routes ====
    Route::prefix('/page-detail')->name('page-detail.')->group(function () {
        $localClass = PageDetailController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });
     
    // ==== facility Routes ====
    Route::prefix('/facility')->name('facility.')->group(function () {
        $localClass = FacilityController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });
    
    // ==== banner Routes ====
    Route::prefix('/banner')->name('banner.')->group(function () {
        $localClass = BannerController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

    // ==== banner halaman Routes ====
    Route::prefix('/banner-halaman')->name('banner-halaman.')->group(function () {
        $localClass = BannerController::class;
        Route::get('/', [$localClass, 'indexHalaman'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });
     
    
    // ==== customer Routes ====
    Route::prefix('/customer')->name('customer.')->group(function () {
        $localClass = CustomerController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });
    
    // ==== gallery Routes ====
    Route::prefix('/gallery')->name('gallery.')->group(function () {
        $localClass = GalleryController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
        Route::get('/delete-media/{id}', [$localClass, 'deleteMedia'])->name('delete_media');
        
        
    });
    
    // ==== customer Routes ====
    Route::prefix('/product')->name('product.')->group(function () {
        $localClass = ProductController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

    // ==== line Routes ====
    Route::prefix('/line')->name('line.')->group(function () {
        $localClass = LineController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });
    // ==== iso Routes ====
    Route::prefix('/iso')->name('iso.')->group(function () {
        $localClass = IsoController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });
    Route::prefix('/advantage')->name('advantage.')->group(function () {
        $localClass = AdvantageController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });
    
    // ==== iso Routes ====
    Route::prefix('/company')->name('company.')->group(function () {
        $localClass = CompanyController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

    Route::prefix('/facilitycore')->name('facilitycore.')->group(function () {
        $localClass = FacilityCoreController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

    // ==== bisnis-kategori Routes ====
    Route::prefix('/bisnis-kategori')->name('bisnis-kategori.')->group(function () {
        $localClass = BisnisKategoriController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

    // ==== pengalaman Routes ====
    Route::prefix('/pengalaman')->name('pengalaman.')->group(function () {
        $localClass = PengalamanController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

    // ==== personil Routes ====
    Route::prefix('/personil')->name('personil.')->group(function () {
        $localClass = PersonilController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

    // ==== dokumen-kategori Routes ====
    Route::prefix('/dokumen-kategori')->name('dokumen-kategori.')->group(function () {
        $localClass = DokumenKategoriController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

    // ==== dokumen Routes ====
    Route::prefix('/dokumen')->name('dokumen.')->group(function () {
        $localClass = DokumenController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

    // ==== ruang-unduh-kategori Routes ====
    Route::prefix('/ruang-unduh-kategori')->name('ruang-unduh-kategori.')->group(function () {
        $localClass = RuangUnduhKategoriController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

    // ==== ruang-unduh Routes ====
    Route::prefix('/ruang-unduh')->name('ruang-unduh.')->group(function () {
        $localClass = RuangUnduhController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

    // ==== karir Routes ====
    Route::prefix('/karir')->name('karir.')->group(function () {
        $localClass = KarirController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

    // ==== karir form-builder Routes ====
    Route::prefix('/karir/{karir}/fields')->name('karir.fields.')->group(function () {
        $localClass = KarirFormFieldController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
    });

    // ==== karir pelamar Routes ====
    Route::prefix('/karir/{karir}/lamaran')->name('karir.lamaran.')->group(function () {
        $localClass = KarirLamaranController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/show/{id}', [$localClass, 'show'])->name('show');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
    });

    // ==== berita-kategori Routes ====
    Route::prefix('/berita-kategori')->name('berita-kategori.')->group(function () {
        $localClass = BeritaKategoriController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

    // ==== berita Routes ====
    Route::prefix('/berita')->name('berita.')->group(function () {
        $localClass = BeritaController::class;
        Route::get('/', [$localClass, 'index'])->name('index');
        Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
        Route::post('/submit', [$localClass, 'create'])->name('create');
        Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
        Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
        Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
    });

});