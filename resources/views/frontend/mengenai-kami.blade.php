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
        <h3 class="text-center mb-4">Tentang Kami</h3>

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
    <div class="container mt-5 mb-5 p-3 ">
        <div class="row g-2 align-items-center mb-4">
            <div class="col-md-7 order-2 order-md-1">
                <div class="vm-block-visi">
                    <div class="text-visi">
                        <h3 class="text-center ">Visi</h3>
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

        <div class="row g-2 align-items-center mt-4">
            <div class="col-md-5 ">
                <div class="  vm-visual-red">
                    <img src="{{ asset('assets/img/material/misi.png') }}"
                 alt="Visi" class="" style="width:100%; height:auto;">
                 </div>
            </div>
            <div class="col-md-7 order-2 order-md-1">
                <div class="vm-block-misi" >
                    <div class="text-misi" >
                    <h3 class="text-center" >Misi</h3>
                    <div style="">
                    <p >{!!   $company?->mission ?? '' !!}</p>

                    </div>
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
        <h3 class="section-title text-center mb-5">Struktur Permodalan</h3>
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
                        <img src="{{ asset('assets/img/material/mengenai-ptdap-08.png') }}"
                             alt="Dokumen Legalitas" class="img-fluid">
                    </div>
                </div>

                {{-- Kanan: phone mockup, menyembul ke atas --}}
                <div class="legalitas-phone">
                    <img src="{{ asset('assets/img/material/mengenai-ptdap-09.png') }}"
                         alt="Legalitas Dokumen">
                </div>

            </div>
        </div>
    </div>
</section>

{{-- ===================== MITRA STRATEGIS ===================== --}}
<section class="mitra-strategis-section">
    <div class="container">
        <div class="row g-0 align-items-start">

            {{-- Kiri: foto orang --}}
            <div class="col-md-4 mitra-person-col">
                <img src="{{ asset('assets/img/material/MITRA-STRATEGIS/mengenai-ptdap-10.png') }}"
                     alt="Mitra Strategis" class="mitra-person-img">
            </div>

            {{-- Kanan: judul + navigasi + daftar mitra --}}
            <div class="col-md-8 mitra-content-col">
                <div class="mitra-header">
                    <h2 class="mitra-title">Mitra Strategis</h2>
                    <div class="mitra-nav" id="mitraNav">
                        <button class="mitra-nav-btn" id="mitraPrev" onclick="mitraNav(-1)">
                            <i class="ti ti-chevron-left"></i>
                        </button>
                        <button class="mitra-nav-btn" id="mitraNext" onclick="mitraNav(1)">
                            <i class="ti ti-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <div class="mitra-list" id="mitraList">
                    @forelse($customers as $c)
                    <div class="mitra-item">
                        @if($c->image)
                        <img src="{{ asset($c->image) }}" alt="{{ $c->title ?? $c->nama ?? '' }}" class="mitra-logo">
                        @endif
                        <h6>{{ $c->title ?? $c->nama ?? '' }}</h6>
                        @if($c->description ?? $c->deskripsi ?? null)
                        <p>{{ $c->description ?? $c->deskripsi }}</p>
                        @endif
                    </div>
                    @empty
                    <div class="mitra-item">
                        <h6>Injourney Airports</h6>
                        <p>Manajemen aset dan wisma (Wisma Cimacan).</p>
                    </div>
                    <div class="mitra-item">
                        <h6>IAS Support</h6>
                        <p>Pengadaan tenaga kerja dan sumber daya manusia di sektor penerbangan.</p>
                    </div>
                    <div class="mitra-item">
                        <h6>DAPENDA</h6>
                        <p>Kolaborasi Dana Pensiun Angkasa Pura Indonesia (DAPENDA).</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</section>

@section('scripts')
<script>
(function () {
    const PER_PAGE = 3;
    let page = 0;

    function render() {
        const items = document.querySelectorAll('#mitraList .mitra-item');
        const total = items.length;
        const nav   = document.getElementById('mitraNav');

        if (total <= PER_PAGE) { if (nav) nav.style.display = 'none'; return; }

        items.forEach((el, i) => {
            el.style.display = (i >= page * PER_PAGE && i < (page + 1) * PER_PAGE) ? '' : 'none';
        });

        document.getElementById('mitraPrev').disabled = page === 0;
        document.getElementById('mitraNext').disabled = (page + 1) * PER_PAGE >= total;
    }

    window.mitraNav = function (dir) { page += dir; render(); };

    document.addEventListener('DOMContentLoaded', render);
})();
</script>
@endsection

@endsection
