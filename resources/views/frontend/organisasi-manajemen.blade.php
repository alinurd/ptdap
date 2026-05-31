@extends('frontend.layouts.app')
@section('content')

<div class="page-hero">
    @if($banner?->image)
    <img src="{{ asset($banner->image) }}" alt="Organisasi & Manajemen">
    @else
    <div class="w-100 h-100" style="background: linear-gradient(135deg,#003d79,#005bb5);"></div>
    @endif
    <div class="overlay"><h1>Organisasi & Manajemen</h1></div>
</div>

<div class="page-breadcrumb">
    <div class="container">
        <nav><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('guest.home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('guest.mengenai-kami') }}">Mengenai Kami</a></li>
            <li class="breadcrumb-item active">Organisasi & Manajemen</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Struktur Manajemen</h2>
            <p class="section-subtitle">Tim profesional yang berdedikasi dalam memimpin PT Delta Angkasa Pratama.</p>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse($personils as $p)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="personil-card">
                    <img src="{{ $p->foto ? asset($p->foto) : asset('assets/img/noimage.jpg') }}"
                         alt="{{ $p->nama }}">
                    <h6>{{ $p->nama }}</h6>
                    <small>{{ $p->jabatan }}</small>
                    @if($p->deskripsi)
                    <p class="mt-2 text-muted" style="font-size:12px;">{{ Str::limit($p->deskripsi, 80) }}</p>
                    @endif
                </div>
            </div>
            @empty
            <p class="text-center text-muted">Belum ada data personil.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection
