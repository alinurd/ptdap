@extends('admin.layouts.app', ['title' => $title, 'ckeditor' => true])

@section('content')
<div class="card shadow">
    <div class="card-body pl-0 pr-0">
        <div class="row p-2">
            <div class="col-12">
                <h3><b>{{$title}}</b></h3>
            </div>
        </div>
        <x-table-btn>
            <x-slot name="thead">
                <tr>
                    <th>
                        <div class="form-check form-check-primary">
                            <input type="checkbox" class="form-check-input" id="customCheckAll" style="cursor: pointer" />
                            <label class="form-check-label" for="customCheckAll"></label>
                        </div>
                    </th>
                    <th>No</th>
                    <th>Gambar & Judul</th>
                    @if($type === 'halaman')
                    <th>Halaman</th>
                    @endif
                    <th>Sort</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($data as $x => $item)
                <tr>
                    <td>
                        <div class="form-check form-check-primary">
                            <input type="checkbox" class="form-check-input delete-checkbox"
                                id="customCheck{{ $item->id }}" value="{{ $item->id }}" style="cursor: pointer" />
                            <label class="form-check-label" for="customCheck{{ $item->id }}"></label>
                        </div>
                    </td>
                    <td>{{ $x + 1 }}</td>
                    <td>
                        @if ($item->image)
                            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" width="40" height="40" class="rounded me-2">
                        @else
                            <img src="{{ asset('assets/img/noimage.jpg') }}" style="height: 40px; width: 40px;" class="rounded me-2" alt="No Image">
                        @endif
                        {{ $item->title }}
                    </td>
                    @if($type === 'halaman')
                    <td>{{ $item->page ?? '-' }}</td>
                    @endif
                    <td>{{ $item->sort }}</td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" class="switch-input"
                                id="status{{ $item->id }}"
                                onchange="actionChangeStatusItem('{{ route($prefixRoute.'status', $item->id) }}', '{{ $item->id }}')"
                                @if ($item->status == 1) checked @endif />
                            <span class="switch-toggle-slider">
                                <span class="switch-on"></span>
                                <span class="switch-off"></span>
                            </span>
                        </label>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i data-feather="list"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="btnEditItem('{{ route($prefixRoute.'edit', $item->id) }}', '{{ $item->id }}')"><i data-feather="edit"></i> Edit</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="btnDeleteItem('{{ route($prefixRoute.'delete', $item->id) }}', '{{ $item->title }}')"><i data-feather="trash"></i> Hapus</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </x-slot>
        </x-table-btn>
    </div>
</div>

@include('admin.master.banner._modal', ['prefixRoute' => $prefixRoute, 'title' => $title, 'type' => $type])
@endsection

@push('js')
    @include('admin.master.banner._scripts', ['prefixRoute' => $prefixRoute, 'type' => $type])
@endpush
