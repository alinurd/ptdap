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
    Route::get('/hubungi-kami', [$c, 'hubungiKami'])->name('hubungi-kami');
    Route::post('/hubungi-kami/kirim', [$c, 'sendContact'])->name('contact.send');
});
