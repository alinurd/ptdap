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
        <label for="judul" class="form-label">Judul Dokumen</label>
        <input type="text" class="form-control" id="judul" name="judul" required />
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
    </div>
    <div class="row g-2 mb-3">
        <div class="col-md-6 col-12">
            <div class="border rounded p-2">
                <label class="form-label mb-1">Thumbnail / Cover</label>
                <div id="holder" class="mb-2 text-center">
                    <img src="{{ asset('assets/img/noimage.jpg') }}" style="height:80px;" alt="Cover">
                </div>
                <div class="input-group">
                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary btn-sm text-white">
                        <i class="tf-icons ti ti-photo"></i> Pilih Gambar
                    </a>
                    <input id="thumbnail" class="form-control bg-secondary-subtle" type="text" name="image" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="border rounded p-2">
                <label class="form-label mb-1">File Dokumen (PDF/Doc)</label>
                <div class="mb-2"><small class="text-muted" id="file-name-preview">Belum ada file dipilih</small></div>
                <div class="input-group">
                    <a id="lfmfiles" data-input="file-input" class="btn btn-secondary btn-sm text-white">
                        <i class="tf-icons ti ti-file-upload"></i> Pilih File
                    </a>
                    <input id="file-input" class="form-control bg-secondary-subtle" type="text" name="file" readonly>
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
