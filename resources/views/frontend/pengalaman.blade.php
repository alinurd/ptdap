@extends('frontend.layouts.app')
@section('content')

<div class="page-hero">
    @if($banner?->image)
    <img src="{{ asset($banner->image) }}" alt="Pengalaman">
    @else
    <div class="w-100 h-100" style="background: linear-gradient(135deg,#003d79,#005bb5);"></div>
    @endif
    <div class="overlay"><h1>Pengalaman dan Porto Folio</h1></div>
</div>

<div class="page-breadcrumb">
    <div class="container">
        <nav><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('guest.home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Pengalaman</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-2">
            <h2 class="section-title">Pengalaman dan Porto Folio</h2>
            <p class="section-subtitle">Dalam setiap inovasi yang sukses, ada individu dan tim yang menggerakkan prosesnya.</p>
        </div>

        @forelse($pengalamans as $item)
        <div class="pengalaman-list-item">
            <img src="{{ $item->image ? asset($item->image) : asset('assets/img/noimage.jpg') }}"
                 alt="{{ $item->title }}">
            <div>
                @if($item->tanggal)
                <p class="meta"><i class="ti ti-calendar me-1"></i>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</p>
                @endif
                <h5>{{ $item->title }}</h5>
                <p>{{ Str::limit(strip_tags($item->description ?? ''), 320) }}</p>
            </div>
        </div>
        @empty
        <p class="text-center text-muted py-4">Belum ada data pengalaman.</p>
        @endforelse

        {{-- Pagination --}}
        <div class="mt-3">{{ $pengalamans->links() }}</div>
    </div>
</section>

@endsection
