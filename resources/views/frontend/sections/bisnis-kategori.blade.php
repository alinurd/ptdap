{{-- BISNIS KATEGORI / PERUSAHAAN BERGERAK DI BIDANG --}}
<section class="bisnis-section">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">Perusahaan Kami Bergerak di Bidang</h2>
        </div>

        @if($bisnis->isNotEmpty())
        <div id="bisnisCarousel" class="carousel slide" data-bs-ride="false">
            <div class="carousel-inner">
                @php $chunks = $bisnis->chunk(4); @endphp
                @foreach($chunks as $i => $chunk)
                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                    <div class="row justify-content-center g-2">
                        @foreach($chunk as $item)
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                            <div class="bisnis-card">
                                <div class="bisnis-icon">
                                    @if(str_starts_with($item->icon ?? '', 'ti'))
                                        <i class="ti {{ $item->icon }}"></i>
                                    @elseif($item->icon)
                                        <i class="{{ $item->icon }}"></i>
                                    @else
                                        <i class="ti ti-briefcase"></i>
                                    @endif
                                </div>
                                <h6>{{ $item->title }}</h6>
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
                <button type="button" data-bs-target="#bisnisCarousel" data-bs-slide-to="{{ $i }}"
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
