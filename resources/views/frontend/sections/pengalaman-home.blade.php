{{-- PENGALAMAN KAMI (Home) --}}
<section class="pengalaman-section">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">Pengalaman Kami</h2>
        </div>

        @if($pengalamans->isNotEmpty())
        <div id="pengalamanCarousel" class="carousel slide" data-bs-ride="false">
            <div class="carousel-inner">
                @php $chunks = $pengalamans->chunk(3); @endphp
                @foreach($chunks as $i => $chunk)
                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                    <div class="row g-3">
                        @foreach($chunk as $item)
                        <div class="col-md-4">
                            <div class="pengalaman-card card h-100">
                                @if($item->image)
                                <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                                @else
                                <div style="height:180px; background:#f0f0f0;"></div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->title }}</h5>
                                    <p class="card-text">{{ Str::limit(strip_tags($item->description ?? ''), 120) }}</p>
                                </div>
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
                <button type="button" data-bs-target="#pengalamanCarousel" data-bs-slide-to="{{ $i }}"
                    class="{{ $i === 0 ? 'active' : '' }}"
                    style="background:#003d79; width:10px; height:10px; border-radius:50%; border:none; opacity:0.4;"
                    ></button>
                @endforeach
            </div>
            @endif
        </div>
        @endif
    </div>
</section>
