<form class="form" id="formData">
    <input type="hidden" name="id" id="data_id" class="form-control" value="0">
    <input type="hidden" name="type" id="data_type" class="form-control" value="{{ $type }}">

    <div class="row g-2 mb-3">
        <div class="col-md-4 col-12">
            <label for="sort" class="form-label">Sort</label>
            <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="sort"
                name="sort" autocomplete="off" required />
        </div>
        <div class="col-md-4 col-12">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" id="status" required>
                <option value="">- Pilih Status -</option>
                <option value="1">Aktif</option>
                <option value="0">Nonaktif</option>
            </select>
        </div>
        @if($type === 'halaman')
        <div class="col-md-4 col-12">
            <label for="page" class="form-label">Nama Halaman</label>
            <input type="text" class="form-control" id="page" name="page" placeholder="Contoh: Tentang Kami" />
        </div>
        @endif
    </div>

    <div class="row g-1 mb-3">
        <div class="col-md-8 col-12">
            <label for="title" class="form-label">Judul Banner</label>
            <input type="text" class="form-control" id="title" name="title" required />
        </div>
    </div>

    <div class="mb-3">
        <label for="dsc" class="form-label">Deskripsi</label>
        <textarea name="dsc" id="dsc" class="form-control"></textarea>
    </div>

    <div class="row">
        <div class="col mb-3">
            <div class="border rounded p-2">
                <label class="form-label mb-1">Gambar Banner</label>
                <div class="d-flex flex-column flex-md-row justify-content-evenly align-items-center">
                    <div id="holder" class="mb-1 mb-md-0">
                        <img src="{{ asset('assets/img/noimage.jpg') }}" style="height: 110px;" alt="Featured Image">
                    </div>
                    <div>
                        <small class="text-muted">Disarankan ukuran 1920 x 600 pixel</small>
                        <div class="input-group mt-1">
                            <a id="lfm" data-input="thumbnail" data-preview="holder"
                                class="btn btn-primary text-white">
                                <i class="menu-icon tf-icons ti ti-photo"></i> Pilih Gambar
                            </a>
                            <input id="thumbnail" class="form-control bg-secondary-subtle" type="text"
                                name="image" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 text-right">
            <div class="btn-group float-end ps-2" role="group">
                <button type="button" id="submit" onclick="saveData()" class="btn btn-outline-primary">
                    <div id="simpan">
                        <i data-feather="save" class="me-1"></i> Simpan
                    </div>
                    <div id="loading" class="hidden">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Menyimpan...
                    </div>
                </button>
                <button type="reset" class="btn btn-outline-danger">
                    <i data-feather="refresh-cw" class="me-1"></i> Reset
                </button>
            </div>
        </div>
    </div>
</form>
