@extends('frontend.layouts.app')
@section('content')

<section class="error-404-section">
    <div class="container">
        <div class="error-404-wrap">

            {{-- Angka 404 besar --}}
            <div class="error-404-number">
                <span class="e-4 text-navy">4</span>
                <span class="e-0">
                    <i class="ti ti-circle-dashed"></i>
                </span>
                <span class="e-4 text-navy">4</span>
            </div>

            <h1 class="error-404-title">Halaman Tidak Ditemukan</h1>
            <p class="error-404-desc">
                Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.<br>
                Silakan kembali ke beranda atau coba halaman lain.
            </p>

            <div class="error-404-actions">
                <a href="{{ route('guest.home') }}" class="btn-404-home">
                    <i class="ti ti-home me-2"></i> Kembali ke Beranda
                </a>
                <a href="javascript:history.back()" class="btn-404-back">
                    <i class="ti ti-arrow-left me-2"></i> Halaman Sebelumnya
                </a>
            </div>

        </div>
    </div>
</section>

@endsection
