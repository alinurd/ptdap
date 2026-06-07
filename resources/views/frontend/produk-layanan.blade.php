@extends('frontend.layouts.app')
@section('content')

<div class="page-hero">
    @if($banner?->image)
    <img src="{{ asset($banner->image) }}" alt="Produk Layanan">
    @else
    <div class="w-100 h-100" style="background: linear-gradient(135deg,#003d79,#005bb5);"></div>
    @endif
    <div class="overlay"><h1>Produk Layanan</h1></div>
</div>

<div class="page-breadcrumb">
    <div class="container">
        <nav><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('guest.home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Produk Layanan</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Bidang Usaha Kami</h2>
            <p class="section-subtitle">PT Delta Angkasa Pratama bergerak di berbagai bidang usaha yang terintegrasi.</p>
        </div>
        <div class="row g-4">
            @forelse($bisnis as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-3 p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bisnis-icon" style="flex-shrink:0;">
                            @if(str_starts_with($item->icon ?? '', 'ti'))
                            <img src="{{ $item?->icon ? asset($item->icon) : asset('') }}" width="90px">
                                {{-- <i class="ti {{ $item->icon }}"></i> --}}
                            @elseif($item->icon)
                            <img src="{{ $item?->icon ? asset($item->icon) : asset('') }}" width="90px">
                                {{-- <i class="{{ $item->icon }}"></i> --}}
                            @else
                                <i class="ti ti-briefcase"></i>
                            @endif
                        </div>
                        <h5 class="mb-0" style="font-size:15px; font-weight:700; color:#003d79;">{{ $item->title }}</h5>
                    </div>
                    @if($item->description)
                    <p class="text-muted" style="font-size:13px; line-height:1.8;">{{ $item->description }}</p>
                    @endif
                </div>
            </div>
            @empty
            <p class="text-center text-muted">Belum ada data produk layanan.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection
