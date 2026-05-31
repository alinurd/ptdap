<form class="form" id="formData">
    <input type="hidden" name="id" id="data_id" class="form-control" value="0">
    <div class="row g-2 mb-3">
        <div class="col-md-6 col-12">
            <label for="sort" class="form-label">Sort</label>
            <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="sort" name="sort" autocomplete="off" required />
        </div>
        <div class="col-md-6 col-12">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" id="status" required>
                <option value="">- Pilih Status -</option>
                <option value="1">Aktif</option>
                <option value="0">Nonaktif</option>
            </select>
        </div>
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Nama Kategori</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Contoh: Jasa" required />
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <div class="border rounded p-2">
            <label class="form-label mb-1">Icon / Gambar</label>
            <div class="d-flex flex-column flex-md-row justify-content-evenly align-items-center">
                <div id="holder" class="mb-1 mb-md-0">
                    <img src="{{ asset('assets/img/noimage.jpg') }}" style="height:80px;" alt="Icon">
                </div>
                <div>
                    <small class="text-muted">Disarankan ukuran 100 x 100 pixel</small>
                    <div class="input-group mt-1">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                            <i class="menu-icon tf-icons ti ti-photo"></i> Pilih Gambar
                        </a>
                        <input id="thumbnail" class="form-control bg-secondary-subtle" type="text" name="icon" readonly>
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
