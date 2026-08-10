<form class="form" id="formData">
    <input type="hidden" name="id" id="data_id" class="form-control" value="0">
    <div class="row g-2 mb-3">
        <div class="col-md-4 col-12">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select name="kategori_id" class="form-control" id="kategori_id" required>
                <option value="">- Pilih Kategori -</option>
                @foreach($kategoris as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-12">
            <label for="sort" class="form-label">Sort</label>
            <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="sort" name="sort" required />
        </div>
        <div class="col-md-4 col-12">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" id="status" required>
                <option value="">- Pilih -</option>
                <option value="1">Aktif</option>
                <option value="0">Nonaktif</option>
            </select>
        </div>
    </div>
    <div class="mb-3">
        <label for="judul" class="form-label">Nama / Judul</label>
        <input type="text" class="form-control" id="judul" name="judul" required />
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi Singkat</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <div class="border rounded p-2">
            <label class="form-label mb-1">Gambar Cover</label>
            <div class="d-flex flex-column flex-md-row justify-content-evenly align-items-center">
                <div id="holder" class="mb-1 mb-md-0">
                    <img src="{{ asset('assets/img/noimage.jpg') }}" style="height:80px;" alt="Gambar">
                </div>
                <div>
                    <small class="text-muted">Disarankan ukuran 100 x 100 pixel</small>
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
    <div class="mb-3">
        <label for="file" class="form-label">File (PDF/ZIP/RAR, maks 20MB)</label>
        <input type="file" class="form-control file-input" id="file" name="file" accept=".pdf,.zip,.rar">
        <small class="text-muted d-block mt-1">File saat ini: <span id="file-name-preview">Belum ada file dipilih</span></small>
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
