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

<section class="py-5 ">
    <div class="container">
        <div class="text-center mb-2">
            <h2 class="section-title">Struktur Manajemen</h2>
            <p class="section-subtitle">Berikuit adalh stuktur Organisasi Pt., Delta Angkasa Pratama yang sudah disahkan oleh manajemen dari dewan direksi sampai dengan staf/karyawan yang membantui.</p>
        </div>
        <div class="row  justify-content-center">
            <img src="{{asset('assets/img/material/struktur.jpeg') }}" style="width: 95%" alt="struktur">
        </div>
    </div>
</section>

{{-- ===================== SEPATAH KATA ===================== --}}
<section class="mt-3">
    <div class="container">
        <div class="sepatah-kata-card">
            <div class="row g-0 align-items-stretch">
                <div class="col-md-4 sepatah-kata-img-col">
                    <img src="{{ asset('assets/img/material/MITRA-STRATEGIS/mengenai-ptdap-10.png') }}" alt="Sepatah Kata">
                </div>
                <div class="col-md-8 sepatah-kata-text-col">
                    <h3>Selamat datang di website resmi PT Delta Angkasa Pratama.</h3>
                    <div class="bidang-text-scroll" style="max-height: 200px">
                        <p>
Puji syukur kami panjatkan ke hadirat Tuhan Yang Maha Esa atas kepercayaan dan dukungan yang terus diberikan kepada PT Delta Angkasa Pratama.
Sebagai perusahaan yang bergerak di bidang General Trading & Services, kami berkomitmen untuk menjadi mitra bisnis yang profesional, terpercaya, dan berorientasi pada kepuasan pelanggan. Kami meyakini bahwa keberhasilan sebuah perusahaan tidak hanya diukur dari pertumbuhan bisnis, tetapi juga dari kemampuan membangun hubungan jangka panjang yang dilandasi integritas, kualitas layanan, dan nilai tambah bagi seluruh pemangku kepentingan.
Di tengah dinamika dunia usaha yang terus berkembang, PT Delta Angkasa Pratama senantiasa beradaptasi melalui inovasi, peningkatan kompetensi sumber daya manusia, serta penerapan tata kelola perusahaan yang baik (Good Corporate Governance). Dengan semangat tersebut, kami menghadirkan solusi yang efektif, efisien, dan sesuai dengan kebutuhan pelanggan di berbagai sektor industri.
Kami percaya bahwa kepercayaan adalah aset yang paling berharga. Oleh karena itu, setiap layanan yang kami berikan dilaksanakan dengan mengedepankan profesionalisme, ketepatan waktu, keselamatan kerja, serta komitmen terhadap kualitas terbaik.
Ke depan, PT Delta Angkasa Pratama akan terus memperluas jaringan bisnis, meningkatkan kapabilitas perusahaan, dan membangun kolaborasi yang saling menguntungkan dengan para mitra, pelanggan, serta seluruh pemangku kepentingan. Kami bertekad menjadi perusahaan nasional yang mampu memberikan kontribusi nyata bagi pertumbuhan ekonomi Indonesia.
Atas nama seluruh jajaran manajemen dan karyawan PT Delta Angkasa Pratama, saya mengucapkan terima kasih atas kepercayaan yang telah diberikan. Semoga website ini menjadi sarana informasi, komunikasi, dan awal dari kerja sama yang berkelanjutan.
Bersama , Bertumbuh, Berinovasi, dan menciptakan nilai untuk masa depan yang lebih baik.
<br>
<center>Hormat kami,<br>
MUHAMMAD URRASYIDIN<br><br>

DIREKTUR UTAMA<br>
PT DELTA ANGKASA PRATAMA</center>
</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br><br>
<section class="py-3 mt-4">
    <div class="container">

        <div class="text-center mb-2">
            <h2 class="section-title">Personil Management</h2>
        </div>

        @if($personils->isNotEmpty())

            <div id="personilCarousel" class="carousel slide" data-bs-ride="false">

                <div class="carousel-inner">

                    @php
                        $chunks = $personils->chunk(3);
                    @endphp

                    @foreach($chunks as $i => $chunk)
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                        <div class="row g-4 justify-content-center">

                            @foreach($chunk as $p)
                            <div class="col-md-4">
                                <div class="personil-card h-100">

                                    <img src="{{ $p->foto ? asset($p->foto) : asset('assets/img/noimage.jpg') }}"
                                         alt="{{ $p->nama }}">

                                    <h6>{{ $p->jabatan }}</h6>
                                    <small>{{ $p->nama }}</small>

                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    @endforeach

                </div>

                @if($chunks->count() > 1)
                <div class="carousel-indicators position-relative mt-3">
                    @foreach($chunks as $i => $chunk)
                    <button
                        type="button"
                        data-bs-target="#personilCarousel"
                        data-bs-slide-to="{{ $i }}"
                        class="{{ $i === 0 ? 'active' : '' }}"
                        style="background:#003d79;width:10px;height:10px;border-radius:50%;border:none;opacity:.4;">
                    </button>
                    @endforeach
                </div>
                @endif

            </div>

        @endif

    </div>
</section>

@endsection
