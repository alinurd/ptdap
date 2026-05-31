@php
    $set  = AppSetting::first();
    $bisnisFooter = App\Models\Master\BisnisKategori::where('status', 1)->orderBy('sort')->get();
@endphp

<footer class="site-footer">
    <div class="container">
        <div class="row g-4">

            {{-- Kolom 1: Logo + Deskripsi --}}
            <div class="col-lg-4 col-md-6">
                <img src="{{ $set?->logo_footer ? asset($set->logo_footer) : ($set?->logo ? asset($set->logo) : asset('assets/img/logo-ptdap.png')) }}"
                     alt="{{ $set?->title ?? 'PT Delta Angkasa Pratama' }}" class="footer-logo">
                <p class="footer-desc">
                    {{ $set?->meta_description ?? 'PT DAP merupakan kolaborasi antara Dana Pensiun Angkasa Pura Indonesia (DAPENDA) dan Koperasi Satya Ardhia (KSA) yang berkantor pusat di Gedung Sentra Medika Lt.2 Bandara Soekarno-Hatta, Tangerang.' }}
                </p>
            </div>

            {{-- Kolom 2: Tautan --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="footer-heading">Tautan</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('guest.home') }}">Beranda</a></li>
                    <li><a href="{{ route('guest.mengenai-kami') }}">Mengenai Kami</a></li>
                    <li><a href="{{ route('guest.produk-layanan') }}">Produk Layanan</a></li>
                    <li><a href="{{ route('guest.pengalaman') }}">Pengalaman</a></li>
                    <li><a href="{{ route('guest.berita') }}">Berita</a></li>
                    <li><a href="{{ route('guest.hubungi-kami') }}">Hubungi Kami</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Our Product --}}
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-heading">Our Product</h6>
                <ul class="footer-links">
                    @forelse($bisnisFooter as $b)
                    <li><a href="{{ route('guest.produk-layanan') }}">{{ $b->title }}</a></li>
                    @empty
                    <li><a href="#">Jasa</a></li>
                    <li><a href="#">Perdagangan</a></li>
                    <li><a href="#">Konstruksi</a></li>
                    <li><a href="#">Transportasi</a></li>
                    @endforelse
                </ul>
            </div>

            {{-- Kolom 4: Social Network --}}
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-heading">Our Social Network</h6>
                <div>
                    @if($set?->status_twitter == 1 && $set?->twitter)
                    <a href="{{ $set->twitter }}" target="_blank" class="footer-social-btn" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    @endif
                    @if($set?->status_facebook == 1 && $set?->facebook)
                    <a href="{{ $set->facebook }}" target="_blank" class="footer-social-btn" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    @endif
                    @if($set?->status_instagram == 1 && $set?->instagram)
                    <a href="{{ $set->instagram }}" target="_blank" class="footer-social-btn" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if($set?->status_youtube == 1 && $set?->youtube)
                    <a href="{{ $set->youtube }}" target="_blank" class="footer-social-btn" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    @endif
                    @if($set?->status_tiktok == 1 && $set?->tiktok)
                    <a href="{{ $set->tiktok }}" target="_blank" class="footer-social-btn" title="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    @endif
                    {{-- Fallback icons jika setting belum diisi --}}
                    @if(!$set?->twitter && !$set?->facebook && !$set?->instagram)
                    <a href="#" class="footer-social-btn"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="footer-social-btn"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="footer-social-btn"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="footer-social-btn"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            {{ $set?->footer_text ?? '© ' . date('Y') . ' PT. Delta Angkasa Pratama. All Rights Reserved' }}
        </div>
    </div>
</footer>
