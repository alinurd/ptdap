{{-- MENGENAI KAMI (Home preview) --}}
<section class="about-home">
    <div class="row g-0">
        {{-- Gambar kiri --}}
        <div class="col-md-6 img-col">
           <img src="{{ asset('storage/photos/1/material/home-ptdap-01.jpg') }}" alt="Mengenai Kami">
        </div>
        {{-- Teks kanan --}}
        <div class="col-md-6 text-col text-center">
            <h2>Mengenai Kami</h2>
            <p>{{ Str::limit(strip_tags($company?->about ?? ''), 10000) }}</p>
   <center>
             <a href="{{ route('guest.mengenai-kami') }}"
   class="btn-outline-white d-inline-block p-2" style="width: 150px; font-size: 16px">
    Lihat Detail
</a>
   </center>

        </div>
    </div>
</section>
