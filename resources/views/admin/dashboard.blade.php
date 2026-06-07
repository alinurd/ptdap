@extends('admin.layouts.app', ['title' => 'Dashboard'])

@php use App\Data\AdminMenus; @endphp

@section('content')

@foreach (AdminMenus::sections() as $section)
  @foreach ($section['groups'] as $group)
  <div class="mb-4">
    <h6 class="fw-semibold text-body mb-3">{{ $group['title'] }}</h6>
    <div class="row g-3">
      @foreach ($group['items'] as $item)
      <div class="col-6 col-sm-4 col-md-3 col-xl-2">
        <a href="{{ route($item['route']) }}" class="text-decoration-none">
          <div class="card card-hover h-100 text-center py-3 px-2">
            <div class="d-flex justify-content-center mb-2">
              <img src="{{ asset('assets/img/icons/be/' . $item['icon']) }}"
                   alt="{{ $item['label'] }}"
                   style="width:72px; height:72px; object-fit:contain;">
            </div>
            <small class="text-muted">{{ $item['label'] }}</small>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
  @endforeach
@endforeach

@endsection

@push('css')
<style>
  .card-hover {
    transition: box-shadow 0.2s, transform 0.2s;
    cursor: pointer;
  }
  .card-hover:hover {
    box-shadow: 0 4px 18px rgba(0,0,0,0.12);
    transform: translateY(-2px);
  }
</style>
@endpush
