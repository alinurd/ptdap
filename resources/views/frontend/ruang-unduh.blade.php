@extends('frontend.layouts.app')
@section('content')

<div class="page-hero">
    @if($banner?->image)
    <img src="{{ asset($banner->image) }}" alt="Ruang Unduh">
    @else
    <div class="w-100 h-100" style="background: linear-gradient(135deg,#003d79,#005bb5);"></div>
    @endif
    <div class="overlay"><h1>Ruang Unduh</h1></div>
</div>

<div class="page-breadcrumb">
    <div class="container">
        <nav><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('guest.home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Ruang Unduh</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">Ruang Unduh</h2>
            <p class="section-subtitle">Unduh dokumen, brosur, dan berkas resmi PT. Delta Angkasa Pratama.</p>
        </div>

        {{-- FILTER --}}
        <form method="GET" action="{{ route('guest.ruang-unduh') }}" class="ru-filter-bar mb-4">
            <div class="row g-2 align-items-end">
                <div class="col-md-5 col-12">
                    <label class="form-label">Cari Nama</label>
                    <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Ketik nama dokumen...">
                </div>
                <div class="col-md-4 col-12">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select">
                        <option value="">— Semua Kategori —</option>
                        @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" @selected((string) $kategori === (string) $kat->id)>{{ $kat->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-ru-apply flex-fill"><i class="ti ti-search me-1"></i>Terapkan</button>
                    <a href="{{ route('guest.ruang-unduh') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </div>
        </form>

        <p class="text-muted mb-4">Menampilkan {{ $items->total() }} dokumen</p>

        <div class="row g-4">
            @forelse($items as $item)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="ru-card">
                    <img src="{{ $item->image ? asset($item->image) : asset('assets/img/noimage.jpg') }}" alt="{{ $item->judul }}">
                    <div class="ru-card-body">
                        @if($item->kategori)
                        <span class="ru-badge">{{ $item->kategori->nama }}</span>
                        @endif
                        <h5>{{ $item->judul }}</h5>
                        @if($item->deskripsi)
                        <p>{{ Str::limit(strip_tags($item->deskripsi), 120) }}</p>
                        @endif
                        @if($item->file)
                        <a href="{{ asset($item->file) }}" download class="btn-ru-unduh"><i class="ti ti-download me-1"></i>Unduh</a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-muted text-center">Belum ada dokumen yang tersedia.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-4">{{ $items->links() }}</div>
    </div>
</section>

@endsection

@section('styles')
<style>
.ru-filter-bar {
    background: #f8f9fb;
    border: 1px solid #e4e8ee;
    border-radius: 10px;
    padding: 20px;
}
.btn-ru-apply {
    background: var(--navy, #003d79);
    color: #fff;
    border: none;
}
.btn-ru-apply:hover { background: #002a56; color: #fff; }
.ru-card {
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
    border: 1px solid #e0e0e0;
    transition: transform 0.2s;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.ru-card:hover { transform: translateY(-4px); }
.ru-card img { width: 100%; height: 180px; object-fit: cover; }
.ru-card-body { padding: 18px; display: flex; flex-direction: column; flex: 1; }
.ru-card-body h5 { font-size: 16px; font-weight: 700; color: var(--navy, #003d79); margin: 8px 0; }
.ru-card-body p { font-size: 13px; color: #666; line-height: 1.6; flex: 1; }
.ru-badge {
    display: inline-block;
    background: #e7f0fb;
    color: var(--navy, #003d79);
    font-size: 11px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 20px;
    width: fit-content;
}
.btn-ru-unduh {
    display: inline-block;
    text-align: center;
    background: #1c7c4f;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    margin-top: 10px;
}
.btn-ru-unduh:hover { background: #155f3d; color: #fff; }
</style>
@endsection
