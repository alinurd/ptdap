@extends('frontend.layouts.app')
@section('content')

<div class="page-hero">
    @if($banner?->image)
    <img src="{{ asset($banner->image) }}" alt="Sertifikasi">
    @else
    <div class="w-100 h-100" style="background: linear-gradient(135deg,#003d79,#005bb5);"></div>
    @endif
    <div class="overlay"><h1>Sertifikasi</h1></div>
</div>

<div class="page-breadcrumb">
    <div class="container">
        <nav><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('guest.home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('guest.mengenai-kami') }}">Mengenai Kami</a></li>
            <li class="breadcrumb-item active">Sertifikasi</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Sertifikasi Kami</h2>
            <p class="section-subtitle">Bukti komitmen kami terhadap standar kualitas dan profesionalisme tertinggi.</p>
        </div>
        <div class="row g-4">
            @forelse($isos as $iso)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="iso-card">
                    <img src="{{ $iso->image ? asset($iso->image) : asset('assets/img/noimage.jpg') }}"
                         alt="{{ $iso->nama }}">
                    <div class="card-body">
                        <h6 class="card-title">{{ $iso->nama }}</h6>
                        @if($iso->deskripsi)
                        <p class="text-muted" style="font-size:13px;">{{ Str::limit($iso->deskripsi, 100) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-muted">Belum ada data sertifikasi.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection
