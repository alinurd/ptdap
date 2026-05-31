@extends('frontend.layouts.app')
@section('content')

<div class="page-hero">
    @if($banner?->image)
    <img src="{{ asset($banner->image) }}" alt="Berita">
    @else
    <div class="w-100 h-100" style="background: linear-gradient(135deg,#003d79,#005bb5);"></div>
    @endif
    <div class="overlay"><h1>Berita</h1></div>
</div>

<div class="page-breadcrumb">
    <div class="container">
        <nav><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('guest.home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Berita</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">Berita</h2>
            <p class="section-subtitle">Dibawah ini adalah sekilas berita yang sudah dilaksanakan atau sedang berlangsung pelaksanaannya oleh PT. Delta Angkasa Pratama.</p>
        </div>

        <div class="row g-4">
            {{-- BERITA LIST --}}
            <div class="col-lg-8">
                @forelse($beritas as $item)
                <div class="berita-card">
                    <img src="{{ $item->image ? asset($item->image) : asset('assets/img/noimage.jpg') }}"
                         alt="{{ $item->judul }}">
                    <div class="body">
                        @if($item->tanggal)
                        <p class="meta"><i class="ti ti-calendar me-1"></i>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</p>
                        @endif
                        <h5>{{ $item->judul }}</h5>
                        <p>{{ Str::limit(strip_tags($item->konten ?? ''), 180) }}</p>
                        <a href="{{ route('guest.berita.detail', $item->slug) }}" class="btn-lihat">Lihat detil</a>
                    </div>
                </div>
                @empty
                <p class="text-muted">Belum ada berita.</p>
                @endforelse

                <div class="mt-3">{{ $beritas->links() }}</div>
            </div>

            {{-- SIDEBAR: Recent Post --}}
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
