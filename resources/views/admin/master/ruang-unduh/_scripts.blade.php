<script>
    $('#file').on('change', function() {
        const val = $(this).val();
        $('#file-name-preview').text(val ? val.split('\\').pop().split('/').pop() : 'Belum ada file dipilih');
    });
    function btnDeleteItem(target, title) {
        Swal.fire({ title: 'Hapus: ' + title + '?', icon: 'warning', showCancelButton: true, confirmButtonText: 'Ya, Hapus!', cancelButtonText: 'Batalkan', customClass: { confirmButton: 'btn btn-primary me-3', cancelButton: 'btn btn-label-secondary' }, buttonsStyling: false })
        .then((result) => { if (result.isConfirmed) { swAlertDialog('success', 'Berhasil menghapus data'); $.get(target, () => location.reload()); } });
    }
    function actionMultiDeleteItems() {
        var id = []; $('.delete-checkbox:checked').each(function() { id.push(parseInt($(this).val())); });
        Swal.fire({ title: 'Hapus semua data terpilih?', icon: 'warning', showCancelButton: true, confirmButtonText: 'Ya, Hapus!', cancelButtonText: 'Batalkan' })
        .then((result) => { if (result.isConfirmed) { $.get("{{ route($prefixRoute.'multi_delete') }}", { id: id }, () => location.reload()); } });
    }
    function actionChangeStatusItem(url, id) {
        let sts = document.getElementById('status' + id).checked ? 1 : 0;
        $.get(url, { sts: sts }, function(res) { swAlertDialog(res.status, res.message); if (res.status == 'success') location.reload(); }, 'json');
    }
    async function saveData() {
        let hasEmpty = false;
        $('#formData .form-control[required]:visible').each(function() { if (!$(this).val()) hasEmpty = true; });
        if (hasEmpty) return swAlertDialog('error', 'Silakan isi semua formulir yang wajib diisi');

        const formData = new FormData(document.getElementById('formData'));
        $('#submit').prop('disabled', true); $('#loading').removeClass('hidden'); $('#simpan').addClass('hidden');

        const response = await fetch("{{ route($prefixRoute.'create') }}", {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            body: formData
        });
        const res = await response.json();
        if (response.ok && res.status == 'success') {
            swAlertDialog('success', 'Data berhasil disimpan'); location.reload();
        } else {
            const message = res.message || (res.errors ? Object.values(res.errors)[0][0] : 'Terjadi kesalahan');
            swAlertDialog('error', message);
            $('#submit').prop('disabled', false); $('#loading').addClass('hidden'); $('#simpan').removeClass('hidden');
        }
    }
    function btnEditItem(url, id) {
        $.get(url, function(res) {
            if (res.status == 'success') {
                $.each(res.data[0], function(name, val) {
                    if (name === 'file') return;
                    $(`#formData .form-control[name='${name}']`).val(val);
                    if (name === 'image' && val) $('#formData #holder img').attr('src', "{{ url('/') }}/" + val);
                });
                $('#data_id').val(id);
                $('#file-name-preview').text(res.data[0]['file'] ? res.data[0]['file'].split('/').pop() : 'Belum ada file dipilih');
                $('#modalForm').modal('toggle');
            } else { swAlertDialog('error', res.message); }
        }, 'json');
    }
    function openForm() {
        $('#formData .form-control').val('');
        $('#data_id').val(0);
        $('#formData #holder img').attr('src', "{{ asset('assets/img/noimage.jpg') }}");
        $('#file-name-preview').text('Belum ada file dipilih');
        $('#modalForm').modal('toggle');
    }
</script>
