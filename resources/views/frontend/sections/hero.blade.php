{{-- HERO SLIDER --}}
<section class="hero-banner">
    @if($banners->isNotEmpty())
    <div id="heroCarousel" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner h-100">
            @foreach($banners as $i => $b)
            <div class="carousel-item h-100 {{ $i === 0 ? 'active' : '' }}">
                <img src="{{ asset($b->image) }}" alt="{{ $b->title }}" class="d-block w-100 h-100" style="object-fit:cover;">
            </div>
            @endforeach
        </div>
        @if($banners->count() > 1)
        <div class="carousel-indicators">
            @foreach($banners as $i => $b)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}"
                class="{{ $i === 0 ? 'active' : '' }}"></button>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
        @endif
    </div>
    @else
    <div class="d-flex align-items-center justify-content-center h-100 bg-light">
        <p class="text-muted">Banner belum tersedia.</p>
    </div>
    @endif
</section>
