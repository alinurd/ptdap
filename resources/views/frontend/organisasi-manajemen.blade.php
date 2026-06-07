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

<section class="py-3">
    <div class="container">
        <div class="text-center mb-2">
            <h2 class="section-title">Struktur Manajemen</h2>
            <p class="section-subtitle">Berikuit adalh stuktur Organisasi Pt., Delta Angkasa Pratama yang sudah disahkan oleh manajemen dari dewan direksi sampai dengan staf/karyawan yang membantui.</p>
        </div>
        <div class="row  justify-content-center">
            <img src="{{asset('assets/img/material/struktur.jpeg') }}" alt="struktur">
        </div>
    </div>
</section>

{{-- ===================== BIDANG USAHA ===================== --}}
<section class="bidang-usaha-section">
    <center>
        <div class="container">
        <div class="" style="background-color: #e7e5e5af">
            <div class="row g-0 align-items-end">
                <div class="col-md-4 bidang-img-col">
                    <img src="{{ asset('assets/img/material/MITRA-STRATEGIS/mengenai-ptdap-10.png') }}" alt="Sepatah Kata" class="bidang-usaha-img">
                </div>
                <div class="col-md-8 bidang-text-col">
                    <h3>Sepatah Kata</h3>
                    <div class="bidang-text-scroll">
                        <p>A common form of Lorem ipsum reads: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </center>
</section>

@endsection
