@extends('frontend.layouts.app')
@section('content')

<div class="page-breadcrumb">
    <div class="container">
        <nav><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('guest.home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('guest.berita') }}">Berita</a></li>
            <li class="breadcrumb-item active">{{ Str::limit($berita->judul, 50) }}</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            {{-- KONTEN --}}
            <div class="col-lg-8">
                @if($berita->image)
                <img src="{{ asset($berita->image) }}" alt="{{ $berita->judul }}" class="berita-detail-img">
                @endif

                <div class="d-flex align-items-center gap-3 mb-3 text-muted" style="font-size:13px;">
                    @if($berita->tanggal)
                    <span><i class="ti ti-calendar me-1"></i>{{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}</span>
                    @endif
                    @if($berita->kategori)
                    <span><i class="ti ti-tag me-1"></i>{{ $berita->kategori->nama }}</span>
                    @endif
                </div>

                <h1 style="font-size:1.6rem; font-weight:700; color:#003d79; margin-bottom:20px;">{{ $berita->judul }}</h1>

                <div class="berita-detail-content">
                    {!! $berita->konten !!}
                </div>

                <div class="mt-4">
                    <a href="{{ route('guest.berita') }}" class="btn btn-outline-primary btn-sm">
                        <i class="ti ti-arrow-left me-1"></i> Kembali ke Berita
                    </a>
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-3">
                    <h6 class="fw-bold mb-3" style="color:#003d79;">Recent Post</h6>
                    @foreach($recent as $r)
                    <a href="{{ route('guest.berita.detail', $r->slug) }}" class="recent-post-item" style="text-decoration:none; color:inherit;">
                        <img src="{{ $r->image ? asset($r->image) : asset('assets/img/noimage.jpg') }}"
                             alt="{{ $r->judul }}">
                        <div>
                            <h6>{{ $r->judul }}</h6>
                            @if($r->tanggal)
                            <small>{{ \Carbon\Carbon::parse($r->tanggal)->format('Y-m-d') }}</small>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
