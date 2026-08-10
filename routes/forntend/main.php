<?php

use App\Http\Controllers\Frontend\LanddingController;
use Illuminate\Support\Facades\Route;

Route::name('guest.')->group(function () {
    $c = LanddingController::class;
    Route::get('/', [$c, 'index'])->name('home');
    Route::get('/mengenai-kami', [$c, 'mengenaiKami'])->name('mengenai-kami');
    Route::get('/mengenai-kami/organisasi-manajemen', [$c, 'organisasiManajemen'])->name('organisasi-manajemen');
    Route::get('/mengenai-kami/sertifikasi', [$c, 'sertifikasi'])->name('sertifikasi');
    Route::get('/produk-layanan', [$c, 'produkLayanan'])->name('produk-layanan');
    Route::get('/pengalaman', [$c, 'pengalaman'])->name('pengalaman');
    Route::get('/berita', [$c, 'berita'])->name('berita');
    Route::get('/berita/{slug}', [$c, 'beritaDetail'])->name('berita.detail');
    Route::get('/ruang-unduh', [$c, 'ruangUnduh'])->name('ruang-unduh');
    Route::get('/karir', [$c, 'karir'])->name('karir');
    Route::get('/karir/{slug}', [$c, 'karirDetail'])->name('karir.detail');
    Route::post('/karir/{slug}/apply', [$c, 'karirApply'])->name('karir.apply');
    Route::get('/hubungi-kami', [$c, 'hubungiKami'])->name('hubungi-kami');
    Route::post('/hubungi-kami/kirim', [$c, 'sendContact'])->name('contact.send');
        Route::get('/404', [$c, 'errors'])->name('404');

});
