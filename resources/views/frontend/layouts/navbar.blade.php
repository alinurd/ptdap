@php $set = AppSetting::first(); @endphp
 {{-- TOPBAR --}}
<div class="topbar py-1 d-none d-md-block">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-4">
            @if($set?->website)
            <span><i class="ti ti-world me-1"></i>{{ $set->website }}</span>
            @endif
            @if($set?->email)
            <span><i class="ti ti-mail me-1"></i>{{ $set->email }}</span>
            @endif
            @if($set?->whatsapp)
            <span><i class="ti ti-brand-whatsapp me-1"></i>{{ $set->whatsapp }}</span>
            @endif
            @if($set?->mobile_phone)
            <span><i class="ti ti-phone me-1"></i>{{ $set->mobile_phone }}</span>
            @endif
        </div>
        <div class="d-flex align-items-center gap-1">
            @if($set?->status_twitter == 1 && $set?->twitter)
            <a href="{{ $set->twitter }}" target="_blank" class="social-link" title="Twitter"><i class="fab fa-twitter"></i></a>
            @endif
            @if($set?->status_facebook == 1 && $set?->facebook)
            <a href="{{ $set->facebook }}" target="_blank" class="social-link" title="Facebook"><i class="fab fa-facebook-f"></i></a>
            @endif
            @if($set?->status_instagram == 1 && $set?->instagram)
            <a href="{{ $set->instagram }}" target="_blank" class="social-link" title="Instagram"><i class="fab fa-instagram"></i></a>
            @endif
            @if($set?->status_youtube == 1 && $set?->youtube)
            <a href="{{ $set->youtube }}" target="_blank" class="social-link" title="YouTube"><i class="fab fa-youtube"></i></a>
            @endif
            @if($set?->status_tiktok == 1 && $set?->tiktok)
            <a href="{{ $set->tiktok }}" target="_blank" class="social-link" title="TikTok"><i class="fab fa-tiktok"></i></a>
            @endif
        </div>
    </div>
</div>

{{-- LOGO (centered) --}}
<div class="navbar-logo-row">
    <div class="container d-flex justify-content-center">
        <a class="navbar-brand m-0" href="{{ route('guest.home') }}">
            <img src="{{ $set?->logo ? asset($set->logo) : asset('assets/img/logo-ptdap.png') }}"
                 alt="{{ $set?->title ?? 'PT Delta Angkasa Pratama' }}">
        </a>
    </div>
</div>

{{-- NAVBAR (menu bar) --}}
<nav class="navbar navbar-expand-lg main-navbar">
    <div class="container">

        <button class="navbar-toggler border-0 ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="mainNav">
            <ul class="navbar-nav align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guest.home') ? 'active' : '' }}"
                       href="{{ route('guest.home') }}">Beranda</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('guest.mengenai-kami') || request()->routeIs('guest.organisasi-manajemen') || request()->routeIs('guest.sertifikasi') ? 'active' : '' }}"
                       href="#" data-bs-toggle="dropdown">Mengenai Kami</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('guest.mengenai-kami') }}">Tentang Kami</a></li>
                        <li><a class="dropdown-item" href="{{ route('guest.organisasi-manajemen') }}">Organisasi & Manajemen</a></li>
                        <li><a class="dropdown-item" href="{{ route('guest.sertifikasi') }}">Sertifikasi</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guest.produk-layanan') ? 'active' : '' }}"
                       href="{{ route('guest.produk-layanan') }}">Produk Layanan</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guest.pengalaman') ? 'active' : '' }}"
                       href="{{ route('guest.pengalaman') }}">Pengalaman</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guest.berita') || request()->routeIs('guest.berita.detail') ? 'active' : '' }}"
                       href="{{ route('guest.berita') }}">Berita</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guest.hubungi-kami') ? 'active' : '' }}"
                       href="{{ route('guest.hubungi-kami') }}">Hubungi Kami</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
