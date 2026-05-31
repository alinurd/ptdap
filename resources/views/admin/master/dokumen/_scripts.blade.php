<script>
    CKEDITOR.replace('deskripsi', CKEDITORGlobalOptions);
    $('#file-input').on('change', function() {
        const val = $(this).val();
        $('#file-name-preview').text(val ? val.split('/').pop() : 'Belum ada file dipilih');
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
    function saveData() {
        let hasEmpty = false;
        $('#formData .form-control[required]:visible').each(function() { if (!$(this).val()) hasEmpty = true; });
        if (hasEmpty) return swAlertDialog('error', 'Silakan isi semua formulir yang wajib diisi');
        const jsonData = {};
        $('#formData .form-control').each(function() { jsonData[$(this).attr('name')] = $(this).val().trim(); });
        jsonData['deskripsi'] = CKEDITOR.instances['deskripsi'].getData();
        $.ajax({ type: "POST", url: "{{ route($prefixRoute.'create') }}", data: jsonData, dataType: 'json',
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
                    $(`#formData .form-control[name='${name}']`).val(val);
                    if (name === 'image' && val) $('#formData #holder img').attr('src', "{{ url('/') }}/" + val);
                    if (name === 'file' && val) $('#file-name-preview').text(val.split('/').pop());
                });
                $('#data_id').val(id);
                CKEDITOR.instances['deskripsi'].setData(res.data[0]['deskripsi'] ?? '');
                $('#modalForm').modal('toggle');
            } else { swAlertDialog('error', res.message); }
        }, 'json');
    }
    function openForm() {
        $('#formData .form-control').val('');
        $('#data_id').val(0);
        $('#formData #holder img').attr('src', "{{ asset('assets/img/noimage.jpg') }}");
        $('#file-name-preview').text('Belum ada file dipilih');
        CKEDITOR.instances['deskripsi'].setData('');
        $('#modalForm').modal('toggle');
    }
</script>
