<form class="form" id="formData">
    <input type="hidden" name="id" id="data_id" class="form-control" value="0">
    <div class="row g-2 mb-3">
        <div class="col-md-6 col-12">
            <label for="sort" class="form-label">Sort</label>
            <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="sort" name="sort" required />
        </div>
        <div class="col-md-6 col-12">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" id="status" required>
                <option value="">- Pilih -</option>
                <option value="1">Aktif</option>
                <option value="0">Nonaktif</option>
            </select>
        </div>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Kategori</label>
        <input type="text" class="form-control" id="nama" name="nama" required />
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
