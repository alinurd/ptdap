@extends('frontend.layouts.app')
@section('content')

{{-- Page Hero --}}
<div class="page-hero">
    @if($banner?->image)
    <img src="{{ asset($banner->image) }}" alt="Mengenai Kami">
    @else
    <div class="w-100 h-100" style="background: linear-gradient(135deg,#003d79,#005bb5);  }
"></div>
    @endif
    <div class="overlay"><h1>Mengenai Kami</h1></div>
</div>

{{-- Breadcrumb --}}
<div class="page-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('guest.home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Tentang Kami</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ===================== TENTANG KAMI ===================== --}}
<section class="about-content-section">
    <div class="container mb-4" style="max-width:900px;">
        <h2 class="text-center mb-4">Tentang Kami</h2>

        <div class="text-center about-text">
            @if($company?->about)
                {!! $company->about !!}
            @endif
        </div>

        <div class="text-center my-4 img-tentang">
            <img src="{{ asset('assets/img/material/mengenai-ptdap-01.png') }}"
                 alt="Tentang Kami" class="" 
                      style="width:100%;height:auto;transition:transform .3s ease;">
        </div>

        <div class="text-center about-text mb-4">
            <p>PT DAP merupakan kolaborasi antara Dana Pensiun Angkasa Pura Indonesia (DAPENDA) dan Koperasi
            Satya Ardhia (KSA) yang berkantor pusat di Gedung Sentra Medika Lt.2 Bandara Soekarno-Hatta, Tangerang.Perusahaan ini bergerak di bidang jasa, perdagangan, konstruksi, transportasi, industri,
            percetakan, dan pertanian.</p>
        </div>
        <br>
    </div>

    {{-- Visi & Misi --}}
    <div class="container mt-5">
        <div class="row g-4 align-items-center mb-4">
            <div class="col-md-7 order-2 order-md-1">
                <div class="vm-block">
                    <div class="text-visi">
                        <h3 class="text-center">Visi</h3>
                    <p>{!!   $company?->vision ?? '' !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 order-1 order-md-2 text-center">
                <div class="vm-visual">
                    <img src="{{ asset('assets/img/material/visi.png') }}"
                 alt="Visi" class="" style="width:100%; height:auto;">
                 </div>
            </div>
        </div>

        <div class="row g-4 align-items-center mt-5">
            <div class="col-md-5 text-center">
                <div class="vm-visual vm-visual-red">
                    <img src="{{ asset('assets/img/material/misi.png') }}"
                 alt="Visi" class="" style="width:100%; height:auto;">
                 </div>
            </div>
            <div class="col-md-7">
                <div class="vm-block">
                    <div class="text-misi">
                    <h3>Misi</h3>
                    <p>{!!   $company?->mission ?? '' !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================== STRUKTUR PERMODALAN ===================== --}}
<section class="struktur-permodalan" style="
        background-image:url('{{ asset('assets/img/material/home-ptdap-02.jpg') }}');
        background-size:cover;
        background-position: center 100%;
             min-height:400px;">
    <div class="container">
        <h2 class="section-title text-center mb-5">Struktur Permodalan</h2>
        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center">
                <img src="{{ asset('assets/img/material/mengenai-ptdap-04.png') }}"
                 alt="Tentang Kami" class="" 
                      style="width:70%;height:auto;transition:transform .3s ease;">
            </div>
            <div class="col-md-6">
                <div class="permodalan-stats">
                    <div class="stat-row">
                        <div class="flex-grow-1">
                            <img src="{{ asset('assets/img/material/mengenai-ptdap-05.png') }}" alt="Tentang Kami" class="" style="width:70%;height:auto;transition:transform .3s ease;">
                        </div>
                    </div>
                    <div class="saham-row">
                        <div class="stat-row">
                        <img src="{{ asset('assets/img/material/mengenai-ptdap-06.png') }}" alt="Tentang Kami" class="" style="width:35px;height:auto;transition:transform .3s ease;">
                        <div class="flex-grow-1">
                            <span class="stat-pct text-navy">DAPEDA</span>
                            <div class="stat-label">Rp. 23.227.000.000,-</div>
                        </div>
                    </div>
                    <div class="stat-row" style="margin-left: 60px">
                        <img src="{{ asset('assets/img/material/mengenai-ptdap-06.png') }}" alt="Tentang Kami" class="" style="width:35px;height:auto;transition:transform .3s ease;">
                        <div class="flex-grow-1">
                            <span class="stat-pct text-navy">KSA</span>
                            <div class="stat-label">Rp. 637.000.000,-</div>
                        </div>
                    </div>
                    </div>
                    
                    <hr>
                    <div class="saham-list">
                        <div class="saham-item">
                            <div class="saham-info">
                                <small>Lembar Saham</small>
                                <div class="saham-num text-navy">23.227</div>
                            </div>
                            <span class="saham-tag text-red">DAPENDA</span>
                        </div>
                        <div class="saham-item">
                            <div class="saham-info">
                                <small>Lembar Saham</small>
                                <div class="saham-num text-navy">637</div>
                            </div>
                            <span class="saham-tag text-red">KSA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================== BIDANG USAHA ===================== --}}
<section class="bidang-usaha-section">
    <center>
        <div class="container">
        <div class="bidang-usaha-card">
            <div class="row g-0 align-items-end">
                <div class="col-md-4 bidang-img-col">
                    <img src="{{ asset('assets/img/material/mengenai-ptdap-07.png') }}" alt="Bidang Usaha" class="bidang-usaha-img">
                </div>
                <div class="col-md-8 bidang-text-col">
                    <h3>Bidang Usaha</h3>
                    <div class="bidang-text-scroll">
                        <p>Sesuai pasal 3 Akta Pendirian, ruang lingkup usaha PT DAP meliputi:</p>
                        <p><strong>Layanan:</strong> Perawatan kendaraan, rental, pencucian mobil, periklanan,
                        layanan kebersihan, travel manajemen, pengemudi, resepsionis, tata graha dan pengelolaan wisma.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </center>
</section>

{{-- ===================== LEGALITAS PERUSAHAAN ===================== --}}
<section class="legalitas-section">
    <div class="container">
        <div class="legalitas-card">
            <div class="legalitas-inner">

                {{-- Kiri: items + docs --}}
                <div class="legalitas-items">
                    <h3>Legalitas Perusahaan</h3>
                    <div class="row g-0 mt-3">
                        <div class="col-6">
                            <div class="legal-item">
                                <strong>Akta Pendirian</strong>
                                <span>No. 79 (29 Juli 2004)</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="legal-item">
                                <strong>Pengesahan SK Menkumham</strong>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="legal-item">
                                <strong>NIB</strong>
                                <span>9120408961822</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="legal-item">
                                <strong>Surat Domisili Usaha</strong>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="legal-item border-0">
                                <strong>NPWP</strong>
                                <span>75.973.645.6-437.000</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="legal-item border-0">
                                <strong>PKP</strong>
                                <span>Pengukuhan Kena Pajak</span>
                            </div>
                        </div>
                    </div>
                    <div class="legalitas-docs">
                        <img src="{{ asset('assets/img/material/legalitas-material/mengenai-ptdap-08.png') }}"
                             alt="Dokumen Legalitas" class="img-fluid">
                    </div>
                </div>

                {{-- Kanan: phone mockup, menyembul ke atas --}}
                <div class="legalitas-phone">
                    <img src="{{ asset('assets/img/material/legalitas-material/mengenai-ptdap-09.png') }}"
                         alt="Legalitas Dokumen">
                </div>

            </div>
        </div>
    </div>
</section>

{{-- ===================== MITRA STRATEGIS ===================== --}}
<section class="about-content-section">
    <div class="container">
        <h2 class="section-title mb-4">Mitra Strategis</h2>
        <div class="row g-3">
            @forelse($customers as $c)
            <div class="col-md-6">
                <div class="mitra-logo-item">
                    @if($c->image)
                    <img src="{{ asset($c->image) }}" alt="{{ $c->title ?? $c->nama ?? '' }}">
                    @endif
                    <div>
                        <h6>{{ $c->title ?? $c->nama ?? '' }}</h6>
                        @if($c->description ?? $c->deskripsi ?? null)
                        <p>{{ Str::limit($c->description ?? $c->deskripsi, 120) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-6">
                <div class="mitra-logo-item">
                    <div><h6>Injourney Airports</h6><p>Manajemen aset dan wisma (Wisma Cimacan).</p></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mitra-logo-item">
                    <div><h6>IAS Support</h6><p>Pengadaan tenaga kerja dan sumber daya manusia di sektor penerbangan.</p></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mitra-logo-item">
                    <div><h6>DAPENDA</h6><p>Kolaborasi Dana Pensiun Angkasa Pura Indonesia (DAPENDA).</p></div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
