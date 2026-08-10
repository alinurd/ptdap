<form class="form" id="formData">
    <input type="hidden" name="id" id="data_id" class="form-control" value="0">
    <div class="row g-2 mb-3">
        <div class="col-md-4 col-12">
            <label for="sort" class="form-label">Sort</label>
            <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="sort" name="sort" required />
        </div>
        <div class="col-md-4 col-12">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" id="status" required>
                <option value="">- Pilih -</option>
                <option value="1">Buka</option>
                <option value="0">Tutup</option>
            </select>
        </div>
        <div class="col-md-4 col-12">
            <label for="tanggal_tutup" class="form-label">Batas Lamaran</label>
            <input type="date" class="form-control" id="tanggal_tutup" name="tanggal_tutup" />
        </div>
    </div>
    <div class="mb-3">
        <label for="judul" class="form-label">Nama Karir / Posisi</label>
        <input type="text" class="form-control" id="judul" name="judul" required />
    </div>
    <div class="mb-3">
        <label for="persyaratan" class="form-label">Persyaratan</label>
        <textarea name="persyaratan" id="persyaratan" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi Pekerjaan</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <div class="border rounded p-2">
            <label class="form-label mb-1">Poster / Gambar</label>
            <div class="d-flex flex-column flex-md-row justify-content-evenly align-items-center">
                <div id="holder" class="mb-1 mb-md-0">
                    <img src="{{ asset('assets/img/noimage.jpg') }}" style="height:110px;" alt="Poster">
                </div>
                <div>
                    <small class="text-muted">Disarankan ukuran 800 x 1000 pixel</small>
                    <div class="input-group mt-1">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                            <i class="menu-icon tf-icons ti ti-photo"></i> Pilih Gambar
                        </a>
                        <input id="thumbnail" class="form-control bg-secondary-subtle" type="text" name="image" readonly>
                    </div>
                </div>
            </div>
        </div>
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
