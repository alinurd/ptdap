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
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Melamar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $x => $item)
                    <tr>
                        <td>{{ $x + 1 }}</td>
                        <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="btnShowDetail({{ $item->id }})"><i data-feather="eye"></i> Lihat Detail</button>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger" onclick="btnDeleteItem('{{ route('admin.master.karir.lamaran.delete', [$karir->id, $item->id]) }}', 'pelamar ini')"><i data-feather="trash"></i> Hapus</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-muted">Belum ada pelamar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Detail Lamaran</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body" id="detail-body">
                <p class="text-muted">Memuat...</p>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    const routeShowBase = "{{ route('admin.master.karir.lamaran.show', [$karir->id, '__ID__']) }}";

    function btnDeleteItem(target, title) {
        Swal.fire({ title: 'Hapus data ' + title + '?', icon: 'warning', showCancelButton: true, confirmButtonText: 'Ya, Hapus!', cancelButtonText: 'Batalkan', customClass: { confirmButton: 'btn btn-primary me-3', cancelButton: 'btn btn-label-secondary' }, buttonsStyling: false })
        .then((result) => { if (result.isConfirmed) { swAlertDialog('success', 'Berhasil menghapus data'); $.get(target, () => location.reload()); } });
    }

    function btnShowDetail(id) {
        $('#detail-body').html('<p class="text-muted">Memuat...</p>');
        $('#modalDetail').modal('show');
        $.get(routeShowBase.replace('__ID__', id), function(res) {
            if (res.status !== 'success') { $('#detail-body').html('<p class="text-danger">Gagal memuat data</p>'); return; }
            let html = '<dl class="row mb-0">';
            res.data.jawaban.forEach(function(j) {
                html += `<dt class="col-sm-4">${j.label_snapshot}</dt><dd class="col-sm-8">`;
                if (j.file_path) {
                    html += `<a href="{{ url('/') }}/${j.file_path}" target="_blank"><i data-feather="download"></i> Unduh File</a>`;
                } else {
                    html += j.value ? j.value : '-';
                }
                html += '</dd>';
            });
            html += '</dl>';
            $('#detail-body').html(html);
            if (window.feather) feather.replace();
        }, 'json');
    }
</script>
@endpush
