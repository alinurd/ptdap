@extends('frontend.layouts.app')
@section('content')

<div class="page-hero">
    @if($banner?->image)
    <img src="{{ asset($banner->image) }}" alt="Karir">
    @else
    <div class="w-100 h-100" style="background: linear-gradient(135deg,#003d79,#005bb5);"></div>
    @endif
    <div class="overlay"><h1>Karir</h1></div>
</div>

<div class="page-breadcrumb">
    <div class="container">
        <nav><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('guest.home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Karir</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">Lowongan Karir</h2>
            <p class="section-subtitle">Bergabunglah bersama PT. Delta Angkasa Pratama dan kembangkan karir Anda bersama kami.</p>
        </div>

        <div class="row g-4">
            @forelse($items as $item)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="karir-card">
                    <img src="{{ $item->image ? asset($item->image) : asset('assets/img/noimage.jpg') }}" alt="{{ $item->judul }}">
                    <div class="karir-card-body">
                        <h5>{{ $item->judul }}</h5>
                        @if($item->deskripsi)
                        <p>{!! Str::limit($item->deskripsi, 150) !!}</p>
                        @endif
                        <a href="{{ route('guest.karir.detail', $item->slug) }}" class="btn-karir-apply">Apply Sekarang</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-muted text-center">Belum ada lowongan karir yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-4">{{ $items->links() }}</div>
    </div>
</section>

@endsection

@section('styles')
<style>
.karir-card {
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
     transition: transform 0.2s;
     border: 1px solid #e0e0e0;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.karir-card:hover { transform: translateY(-4px); }
.karir-card img { width: 100%; height: 200px; object-fit: cover; }
.karir-card-body { padding: 18px; display: flex; flex-direction: column; flex: 1; }
.karir-card-body h5 { font-size: 17px; font-weight: 700; color: var(--navy, #003d79); margin-bottom: 6px; }
.karir-card-body .meta { font-size: 12px; color: #999; margin-bottom: 8px; }
.karir-card-body p { font-size: 13px; color: #666; line-height: 1.6; flex: 1; }
.btn-karir-apply {
    display: inline-block;
    text-align: center;
    background: #1c7c4f;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    padding: 10px 14px;
    border-radius: 6px;
    text-decoration: none;
    margin-top: 10px;
}
.btn-karir-apply:hover { background: #155f3d; color: #fff; }
</style>
@endsection
