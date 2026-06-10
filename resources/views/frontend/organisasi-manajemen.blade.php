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
            <img src="{{asset('assets/img/material/struktur.jpeg') }}" alt="struktur">
        </div>
    </div>
</section>

{{-- ===================== BIDANG USAHA ===================== --}}
<section class="bidang-usaha-sectionx" >
    <center>
         <div class=""style="    max-width: 50%; background-color: #e7e5e5af;" >
            <div class="row g-0 align-items-end"
">
                <div class="col-md-4 p-2 " >
                    <img src="{{ asset('assets/img/material/MITRA-STRATEGIS/mengenai-ptdap-10.png') }}" alt="Sepatah Kata" class="" style="width: 100%; height: auto;  display: block;">
                </div>
                <div class="col-md-8 " style="
                        padding: 30px 10px; display: flex;  width: 500px; flex-direction: column;
    justify-content: center;
    align-self: center;">
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
