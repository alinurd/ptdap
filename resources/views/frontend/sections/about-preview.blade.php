{{-- MENGENAI KAMI (Home preview) --}}
<section class="about-home">
    <div class="row g-0">
        {{-- Gambar kiri --}}
        <div class="col-md-5 img-col">
            @if($company?->image)
            <img src="{{ asset($company->image) }}" alt="Mengenai Kami">
            @else
            <div class="w-100 h-100" style="background: linear-gradient(135deg,#e8ecef,#cfd8e3); min-height:340px;"></div>
            @endif
        </div>
        {{-- Teks kanan --}}
        <div class="col-md-7 text-col">
            <h2>Mengenai Kami</h2>
            <p>{{ Str::limit(strip_tags($company?->about ?? ''), 320) }}</p>
            <a href="{{ route('guest.mengenai-kami') }}" class="btn-outline-white">Lihat detil</a>
        </div>
    </div>
</section>
