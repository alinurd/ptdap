@extends('frontend.layouts.app')

@section('content')

{{-- Page Hero --}}
<div class="page-hero">
    @if($banner?->image)
    <img src="{{ asset($banner->image) }}" alt="Sertifikasi">
    @else
    <div class="w-100 h-100" style="background: linear-gradient(135deg,#003d79,#005bb5);"></div>
    @endif
    <div class="overlay"><h1>Sertifikasi</h1></div>
</div>

{{-- Breadcrumb --}}
<div class="page-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('guest.home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('guest.mengenai-kami') }}">Mengenai Kami</a></li>
                <li class="breadcrumb-item active">Sertifikasi</li>
            </ol>
        </nav>
    </div>
</div>

{{-- Intro --}}
<section class="py-5 text-center">
    <div class="container" style="max-width:720px;">
        <h2 class="sert-main-title">Sertifikasi dan Penghargaan</h2>
        <p class="sert-main-sub mt-2">
            Berikut ini adalah sertifikasi dan penghargaan yang sudah
            diraih oleh PT. Delta Angkasa Pratama karena sangat dipercaya menjadi
            mitra usaha bagi perusahaan/organisasi.
        </p>
    </div>
</section>

@forelse($kategoris as $kategori)

@php
    $isLegalitas = str_contains(strtolower($kategori->nama), 'legalitas');
    $dokumens    = $kategori->dokumens;
    $chunks      = $dokumens->chunk(3);
    $carouselId  = 'carousel-' . $kategori->id;
@endphp

@if($isLegalitas)
{{-- ===== Legalitas Perusahaan ===== --}}
<section class="legalitas-sert-section py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <h2 class="sert-section-title mb-4">{{ $kategori->nama }}</h2>
                @if($dokumens->first()?->deskripsi)
                <blockquote class="sert-legalitas-quote">
                    "{{ $dokumens->first()->deskripsi }}"
                </blockquote>
                @endif
            </div>
            <div class="col-md-6 text-center">
                @if($dokumens->first()?->image)
                <img src="{{ asset($dokumens->first()->image) }}"
                     alt="{{ $dokumens->first()->judul }}"
                     class="sert-legalitas-img img-fluid">
                @endif
            </div>
        </div>
    </div>
</section>

@else
{{-- ===== Carousel Section (Sertifikasi / Penghargaan) ===== --}}
<section class="sert-carousel-section py-4">
    <div class="container">
        <h2 class="sert-section-title text-center mb-4">{{ $kategori->nama }}</h2>

        @if($dokumens->isNotEmpty())
        <div id="{{ $carouselId }}" class="carousel slide" data-bs-ride="false">
            <div class="carousel-inner">
                @foreach($chunks as $chunkItems)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row g-4 justify-content-center">
                        @foreach($chunkItems as $dok)
                        <div class="col-6 col-md-4">
                            <div class="sert-card">
                                <div class="sert-card-img-wrap">
                                    <img src="{{ $dok->image ? asset($dok->image) : asset('assets/img/noimage.jpg') }}"
                                         alt="{{ $dok->judul }}">
                                </div>
                                <div class="sert-card-body">
                                    <div class="sert-card-title">{{ $dok->judul }}</div>
                                    @if($dok->deskripsi)
                                    <div class="sert-card-sub">{{ $dok->deskripsi }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            @if($chunks->count() > 1)
            {{-- Dot Indicators --}}
            <div class="sert-dots mt-4 text-center">
                @foreach($chunks as $i => $chunkItems)
                <button class="sert-dot {{ $loop->first ? 'active' : '' }}"
                        data-bs-target="#{{ $carouselId }}"
                        data-bs-slide-to="{{ $i }}"
                        type="button"></button>
                @endforeach
            </div>
            @endif
        </div>
        @else
        <p class="text-center text-muted">Belum ada data.</p>
        @endif
    </div>
</section>
@endif

@empty
<section class="py-5 text-center text-muted">Belum ada data sertifikasi.</section>
@endforelse

@endsection

@section('styles')
<style>
/* ======= Sertifikasi Page ======= */
.sert-main-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--navy, #003d79);
}
.sert-main-sub {
    color: #555;
    font-size: 15px;
    line-height: 1.8;
}
.sert-section-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--navy, #003d79);
}

/* Carousel Card */
.sert-card {
    border: 1px solid #e4e8ee;
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    transition: box-shadow 0.2s, transform 0.2s;
}
.sert-card:hover {
    box-shadow: 0 6px 24px rgba(0,0,0,0.12);
    transform: translateY(-3px);
}
.sert-card-img-wrap {
    background: #f8f9fb;
    padding: 16px;
    min-height: 190px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.sert-card-img-wrap img {
    max-height: 160px;
    width: 100%;
    object-fit: contain;
}
.sert-card-body {
    padding: 12px 14px 16px;
}
.sert-card-title {
    font-size: 14px;
    font-weight: 600;
    color: #222;
    margin-bottom: 4px;
}
.sert-card-sub {
    font-size: 12px;
    color: #888;
}

/* Dots */
.sert-dots {
    display: flex;
    justify-content: center;
    gap: 8px;
}
.sert-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #ccc;
    border: none;
    padding: 0;
    cursor: pointer;
    transition: background 0.2s;
}
.sert-dot.active { background: var(--navy, #003d79); }

/* Legalitas */
.legalitas-sert-section {
    background: #f8f9fb;
}
.sert-legalitas-quote {
    font-size: 15px;
    color: #444;
    line-height: 1.8;
    border-left: 4px solid var(--navy, #003d79);
    padding-left: 20px;
    margin: 0;
    font-style: italic;
}
.sert-legalitas-img {
    border-radius: 10px;
    max-height: 320px;
    object-fit: cover;
}
</style>
@endsection
