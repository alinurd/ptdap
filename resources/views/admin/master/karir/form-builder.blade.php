@extends('admin.layouts.app', ['title' => $title])

@section('content')
<div class="card shadow">
    <div class="card-body">
        <div class="row p-2 align-items-center">
            <div class="col-12 col-md-8"><h3><b>{{ $title }}</b></h3></div>
            <div class="col-12 col-md-4 text-md-end">
                <a href="{{ route('admin.master.karir.index') }}" class="btn btn-outline-secondary btn-sm"><i data-feather="arrow-left"></i> Kembali ke Daftar Karir</a>
            </div>
        </div>
        <x-table-btn>
            <x-slot name="thead">
                <tr>
                    <th><div class="form-check form-check-primary"><input type="checkbox" class="form-check-input" id="customCheckAll" style="cursor:pointer"/><label class="form-check-label" for="customCheckAll"></label></div></th>
                    <th>No</th>
                    <th>Label</th>
                    <th>Tipe</th>
                    <th>Wajib</th>
                    <th>Sort</th>
                    <th>Aksi</th>
                </tr>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($data as $x => $item)
                <tr>
                    <td><div class="form-check form-check-primary"><input type="checkbox" class="form-check-input delete-checkbox" id="customCheck{{ $item->id }}" value="{{ $item->id }}" style="cursor:pointer"/><label class="form-check-label" for="customCheck{{ $item->id }}"></label></div></td>
                    <td>{{ $x + 1 }}</td>
                    <td>{{ $item->label }}</td>
                    <td><span class="badge bg-label-info">{{ ucfirst($item->type) }}</span></td>
                    <td>{{ $item->is_required ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $item->sort }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"><i data-feather="list"></i></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="btnEditItem('{{ route('admin.master.karir.fields.edit', [$karir->id, $item->id]) }}', '{{ $item->id }}')"><i data-feather="edit"></i> Edit</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="btnDeleteItem('{{ route('admin.master.karir.fields.delete', [$karir->id, $item->id]) }}', '{{ addslashes($item->label) }}')"><i data-feather="trash"></i> Hapus</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </x-slot>
        </x-table-btn>
    </div>
</div>

<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">{{ $title }}</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <form class="form" id="formData">
                    <input type="hidden" name="id" id="data_id" class="form-control" value="0">
                    <div class="mb-3">
                        <label for="label" class="form-label">Label Pertanyaan</label>
                        <input type="text" class="form-control" id="label" name="label" required />
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6 col-12">
                            <label for="type" class="form-label">Tipe Input</label>
                            <select name="type" class="form-control" id="type" required onchange="toggleOptionsField()">
                                <option value="">- Pilih -</option>
                                <option value="text">Text</option>
                                <option value="textarea">Textarea</option>
                                <option value="select">Select / Dropdown</option>
                                <option value="radio">Radio</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="file">Upload File</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="is_required" class="form-label">Wajib Diisi</label>
                            <select name="is_required" class="form-control" id="is_required" required>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3" id="options-wrapper" style="display:none;">
                        <label for="options" class="form-label">Pilihan Jawaban</label>
                        <textarea name="options" id="options" class="form-control" rows="4" placeholder="Satu pilihan per baris"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="sort" class="form-label">Sort</label>
                        <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="sort" name="sort" required />
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="btn-group float-end" role="group">
                                <button type="button" id="submit" onclick="saveData()" class="btn btn-outline-primary">
                                    <div id="simpan"><i data-feather="save" class="me-1"></i> Simpan</div>
                                    <div id="loading" class="hidden"><span class="spinner-border spinner-border-sm"></span> Menyimpan...</div>
                                </button>
                                <button type="reset" class="btn btn-outline-danger"><i data-feather="refresh-cw" class="me-1"></i> Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    const karirId = {{ $karir->id }};
    const routeIndex = "{{ route('admin.master.karir.fields.index', $karir->id) }}";
    const routeCreate = "{{ route('admin.master.karir.fields.create', $karir->id) }}";
    const routeMultiDelete = "{{ route('admin.master.karir.fields.multi_delete', $karir->id) }}";

    function toggleOptionsField() {
        const type = $('#type').val();
        $('#options-wrapper').toggle(['select', 'radio', 'checkbox'].includes(type));
    }

    // admin.layouts.app blocks Enter on any form-control to stop accidental submits;
    // #options needs real newlines (one pilihan per baris), so stop it reaching that handler here.
    $('#options').on('keydown', function(e) { e.stopPropagation(); });

    function btnDeleteItem(target, title) {
        Swal.fire({ title: 'Hapus: ' + title + '?', icon: 'warning', showCancelButton: true, confirmButtonText: 'Ya, Hapus!', cancelButtonText: 'Batalkan', customClass: { confirmButton: 'btn btn-primary me-3', cancelButton: 'btn btn-label-secondary' }, buttonsStyling: false })
        .then((result) => { if (result.isConfirmed) { swAlertDialog('success', 'Berhasil menghapus data'); $.get(target, () => location.reload()); } });
    }
    function actionMultiDeleteItems() {
        var id = []; $('.delete-checkbox:checked').each(function() { id.push(parseInt($(this).val())); });
        Swal.fire({ title: 'Hapus semua data terpilih?', icon: 'warning', showCancelButton: true, confirmButtonText: 'Ya, Hapus!', cancelButtonText: 'Batalkan' })
        .then((result) => { if (result.isConfirmed) { $.get(routeMultiDelete, { id: id }, () => location.reload()); } });
    }
    function saveData() {
        let hasEmpty = false;
        $('#formData .form-control[required]:visible').each(function() { if (!$(this).val()) hasEmpty = true; });
        if (hasEmpty) return swAlertDialog('error', 'Silakan isi semua formulir yang wajib diisi');
        const jsonData = {};
        $('#formData .form-control').each(function() { jsonData[$(this).attr('name')] = $(this).val() ? $(this).val().trim() : ''; });
        $.ajax({ type: "POST", url: routeCreate, data: jsonData, dataType: 'json',
            beforeSend: function() { $('#submit').prop('disabled', true); $('#loading').removeClass('hidden'); $('#simpan').addClass('hidden'); },
            success: function(res) {
                if (res.status == 'success') { swAlertDialog('success', 'Data berhasil disimpan'); location.reload(); }
                else { swAlertDialog('error', res.message); $('#submit').prop('disabled', false); $('#loading').addClass('hidden'); $('#simpan').removeClass('hidden'); }
            }
        });
    }
    function btnEditItem(url, id) {
        $.get(url, function(res) {
            if (res.status == 'success') {
                $.each(res.data[0], function(name, val) {
                    if (name === 'is_required') val = val ? '1' : '0';
                    $(`#formData .form-control[name='${name}']`).val(val);
                });
                $('#data_id').val(id);
                toggleOptionsField();
                $('#modalForm').modal('toggle');
            } else { swAlertDialog('error', res.message); }
        }, 'json');
    }
    function openForm() {
        $('#formData .form-control').val('');
        $('#data_id').val(0);
        $('#is_required').val('1');
        toggleOptionsField();
        $('#modalForm').modal('toggle');
    }
</script>
@endpush
