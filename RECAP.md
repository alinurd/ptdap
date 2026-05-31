# RECAP — Admin Panel PT Delta Angkasa Pratama

> Dokumen ini merangkum analisis struktur proyek, fitur yang sudah ada, dan fitur yang perlu dibangun untuk admin panel website PT Delta Angkasa Pratama (PTDAP).

---

## Tech Stack

| Komponen | Detail |
|---|---|
| Framework | Laravel (PHP) |
| Admin Template | Sneat Bootstrap 5 |
| Rich Text | CKEditor |
| File Manager | Laravel File Manager (LFM) |
| DataTable | DataTables Bootstrap 5 |
| Notifikasi | SweetAlert2 |
| DB Table Prefix | `master_` |

---

## Pola Struktur Yang Wajib Diikuti

Setiap fitur admin mengikuti struktur berikut secara konsisten:

```
Controller  → app/Http/Controllers/Admin/Master/NamaController.php
Model       → app/Models/Master/Nama.php
Views       → resources/views/admin/master/nama/
              ├── index.blade.php      (halaman daftar data)
              ├── _form.blade.php      (form input di dalam modal)
              ├── _modal.blade.php     (wrapper modal Bootstrap)
              └── _scripts.blade.php  (JS: AJAX, SweetAlert, CKEditor)
Routes      → routes/admin/master.php
Menu        → resources/views/admin/layouts/menu.blade.php
```

### Pola Route Standar

```php
Route::prefix('/nama')->name('nama.')->group(function () {
    $localClass = NamaController::class;
    Route::get('/', [$localClass, 'index'])->name('index');
    Route::get('/edit/{id}', [$localClass, 'edit'])->name('edit');
    Route::post('/submit', [$localClass, 'create'])->name('create');
    Route::get('/delete/{id}', [$localClass, 'delete'])->name('delete');
    Route::get('/multidelete', [$localClass, 'multi_delete'])->name('multi_delete');
    Route::get('/status/{id}', [$localClass, 'editstatus'])->name('status');
});
```

---

## Fitur Yang Sudah Ada (Existing)

| Fitur | Tabel DB | Fields Utama | Keterangan |
|---|---|---|---|
| Banner | `master_banner` | sort, status, title, image, dsc | Perlu modifikasi (split type) |
| Company | `master_company` | sort, status, about, vision, mission, image | Untuk halaman Tentang Kami |
| Customer | `master_customer` | sort, status, title, description, image | → Dipakai sebagai **Mitra Strategis** |
| Facility | `master_facility` | sort, status, title, description, image | Komitmen perusahaan |
| Service Core | `master_facility_core` | sort, status, title, description, image | Layanan inti |
| Advantage | `master_advantage` | sort, status, title, description, image | Keunggulan perusahaan |
| ISO / Sertifikasi | `master_iso` | sort, status, title, caption, description, image | Sertifikasi ISO |
| Line of Market | `master_line` | sort, status, title, description, image | Segmen/bidang pasar |
| Product | `master_product` | sort, status, title, description, image | Produk layanan |
| Gallery | `master_gallery` | sort, status, title, description, image, type, link, media | Galeri foto |
| Page Detail | `master_page_detail` | sort, status, title, about, image | Detail halaman |
| User Management | `users`, `roles`, `permissions` | — | Sudah lengkap |
| App Settings | `appsettings` | title, logo, contact, social media, dll | Sudah lengkap |

---

## Fitur Yang Perlu Dibangun

### 1. Banner — Modifikasi (Split Type)

> Tabel `master_banner` sudah ada. Perlu tambah kolom `type` untuk membedakan Home Banner dan Banner Halaman.

**Modifikasi Tabel `master_banner`:**

| Kolom Baru | Type | Keterangan |
|---|---|---|
| `type` | enum(`home`, `halaman`) | Pembeda jenis banner |
| `page` | varchar(100), nullable | Nama halaman (jika type = `halaman`) |

**Migration:**
```php
Schema::table('master_banner', function (Blueprint $table) {
    $table->enum('type', ['home', 'halaman'])->default('home')->after('id');
    $table->string('page')->nullable()->after('type');
});
```

**Menu Admin:**
```
Banner
├── Home Banner      → filter type = 'home'
└── Banner Halaman   → filter type = 'halaman'
```

---

### 2. Bisnis Kategori *(Baru)*

> Dari desain home: section "Perusahaan Kami Bergerak di Bidang"
> Contoh: Jasa, Perdagangan, Konstruksi, Transportasi

**Tabel:** `master_bisnis_kategori`

| Kolom | Type | Keterangan |
|---|---|---|
| `id` | bigint, PK, AI | — |
| `sort` | int, default 0 | Urutan tampil |
| `status` | boolean, default 1 | Aktif/nonaktif |
| `title` | varchar(255) | Nama kategori bisnis |
| `icon` | varchar(255), nullable | Path icon/gambar |
| `description` | text, nullable | Deskripsi singkat |
| `created_at` | timestamp | — |
| `updated_at` | timestamp | — |

**File yang dibuat:**
- `app/Models/Master/BisnisKategori.php`
- `app/Http/Controllers/Admin/Master/BisnisKategoriController.php`
- `resources/views/admin/master/bisnis-kategori/` (index, _form, _modal, _scripts)
- Migration: `create_master_bisnis_kategori_table`

---

### 3. Pengalaman Kami *(Baru)*

> Dari desain halaman "Pengalaman dan Porto Folio"
> List kegiatan/proyek dengan foto, judul, deskripsi, tanggal

**Tabel:** `master_pengalaman`

| Kolom | Type | Keterangan |
|---|---|---|
| `id` | bigint, PK, AI | — |
| `sort` | int, default 0 | Urutan tampil |
| `status` | boolean, default 1 | Aktif/nonaktif |
| `title` | varchar(255) | Judul pengalaman |
| `description` | text, nullable | Deskripsi (CKEditor) |
| `image` | varchar(255), nullable | Foto/gambar |
| `tanggal` | date, nullable | Tanggal kegiatan |
| `created_at` | timestamp | — |
| `updated_at` | timestamp | — |

**File yang dibuat:**
- `app/Models/Master/Pengalaman.php`
- `app/Http/Controllers/Admin/Master/PengalamanController.php`
- `resources/views/admin/master/pengalaman/` (index, _form, _modal, _scripts)
- Migration: `create_master_pengalaman_table`

---

### 4. Mitra Strategis

> Sudah ada di `master_customer`. **Tidak perlu buat tabel baru.**
> Hanya perlu mengganti label menu dari "Customer" → "Mitra Strategis".

**Perubahan:**
- `resources/views/admin/layouts/menu.blade.php` → ganti title dari `Customer` ke `Mitra Strategis`

---

### 5. Personil Manajemen *(Baru)*

> Dari desain halaman "Organisasi & Manajemen" → section **Personil Manajemen**
> Tampil: foto bulat, jabatan, nama (carousel/grid)

**Tabel:** `master_personil`

| Kolom | Type | Keterangan |
|---|---|---|
| `id` | bigint, PK, AI | — |
| `sort` | int, default 0 | Urutan tampil |
| `status` | boolean, default 1 | Aktif/nonaktif |
| `nama` | varchar(255) | Nama lengkap |
| `jabatan` | varchar(255) | Jabatan/posisi |
| `deskripsi` | text, nullable | Bio singkat |
| `foto` | varchar(255), nullable | Foto personil |
| `created_at` | timestamp | — |
| `updated_at` | timestamp | — |

**File yang dibuat:**
- `app/Models/Master/Personil.php`
- `app/Http/Controllers/Admin/Master/PersonilController.php`
- `resources/views/admin/master/personil/` (index, _form, _modal, _scripts)
- Migration: `create_master_personil_table`

---

### 6. Dokumen *(Baru — 2 tabel)*

#### 6a. Kategori Dokumen

**Tabel:** `master_dokumen_kategori`

| Kolom | Type | Keterangan |
|---|---|---|
| `id` | bigint, PK, AI | — |
| `sort` | int, default 0 | Urutan tampil |
| `status` | boolean, default 1 | Aktif/nonaktif |
| `nama` | varchar(255) | Nama kategori |
| `created_at` | timestamp | — |
| `updated_at` | timestamp | — |

#### 6b. Dokumen

**Tabel:** `master_dokumen`

| Kolom | Type | Keterangan |
|---|---|---|
| `id` | bigint, PK, AI | — |
| `kategori_id` | bigint, FK → `master_dokumen_kategori.id` | Kategori dokumen |
| `sort` | int, default 0 | Urutan tampil |
| `status` | boolean, default 1 | Aktif/nonaktif |
| `judul` | varchar(255) | Judul dokumen |
| `deskripsi` | text, nullable | Deskripsi singkat |
| `file` | varchar(255), nullable | Path file (PDF/doc) |
| `image` | varchar(255), nullable | Thumbnail/cover |
| `created_at` | timestamp | — |
| `updated_at` | timestamp | — |

**File yang dibuat:**
- `app/Models/Master/DokumenKategori.php`
- `app/Models/Master/Dokumen.php`
- `app/Http/Controllers/Admin/Master/DokumenKategoriController.php`
- `app/Http/Controllers/Admin/Master/DokumenController.php`
- `resources/views/admin/master/dokumen-kategori/` (index, _form, _modal, _scripts)
- `resources/views/admin/master/dokumen/` (index, _form, _modal, _scripts)
- Migration: `create_master_dokumen_kategori_table`
- Migration: `create_master_dokumen_table`

---

### 7. Berita *(Baru — 2 tabel)*

#### 7a. Kategori Berita

**Tabel:** `master_berita_kategori`

| Kolom | Type | Keterangan |
|---|---|---|
| `id` | bigint, PK, AI | — |
| `sort` | int, default 0 | Urutan tampil |
| `status` | boolean, default 1 | Aktif/nonaktif |
| `nama` | varchar(255) | Nama kategori |
| `created_at` | timestamp | — |
| `updated_at` | timestamp | — |

#### 7b. Berita / Artikel

**Tabel:** `master_berita`

| Kolom | Type | Keterangan |
|---|---|---|
| `id` | bigint, PK, AI | — |
| `kategori_id` | bigint, FK → `master_berita_kategori.id` | Kategori berita |
| `sort` | int, default 0 | Urutan tampil |
| `status` | boolean, default 1 | Aktif/nonaktif |
| `judul` | varchar(255) | Judul artikel |
| `slug` | varchar(255), unique | URL-friendly judul |
| `konten` | longtext, nullable | Isi artikel (CKEditor) |
| `image` | varchar(255), nullable | Foto utama/thumbnail |
| `tanggal` | date, nullable | Tanggal tayang |
| `created_at` | timestamp | — |
| `updated_at` | timestamp | — |

**File yang dibuat:**
- `app/Models/Master/BeritaKategori.php`
- `app/Models/Master/Berita.php`
- `app/Http/Controllers/Admin/Master/BeritaKategoriController.php`
- `app/Http/Controllers/Admin/Master/BeritaController.php`
- `resources/views/admin/master/berita-kategori/` (index, _form, _modal, _scripts)
- `resources/views/admin/master/berita/` (index, _form, _modal, _scripts)
- Migration: `create_master_berita_kategori_table`
- Migration: `create_master_berita_table`

---

## Struktur Menu Admin (Hasil Akhir)

```
Dashboard
│
├── [DATABASES]
│   │
│   ├── Banner
│   │   ├── Home Banner          (filter type = 'home')
│   │   └── Banner Halaman       (filter type = 'halaman')
│   │
│   ├── Master Data
│   │   ├── Bisnis Kategori      ← BARU
│   │   ├── Mengenai Kami        (existing: master_company)
│   │   ├── Mitra Strategis      (existing: master_customer — rename label)
│   │   ├── Pengalaman Kami      ← BARU
│   │   ├── Personil Manajemen   ← BARU
│   │   ├── Produk Layanan       (existing: master_product)
│   │   └── Sertifikasi          (existing: master_iso)
│   │
│   ├── Dokumen                  ← BARU
│   │   ├── Kategori
│   │   └── Dokumen
│   │
│   └── Berita                   ← BARU
│       ├── Kategori
│       └── Berita
│
├── [USER MANAGEMENT]
│   ├── Users
│   └── Roles & Permissions
│
└── [SETTINGS]
    └── App Settings
```

---

## Urutan Pengerjaan

| # | Fitur | Tipe | Prioritas |
|---|---|---|---|
| 1 | Banner (modifikasi + split type) | Modifikasi | Tinggi |
| 2 | Bisnis Kategori | Baru | Tinggi |
| 3 | Pengalaman Kami | Baru | Tinggi |
| 4 | Personil Manajemen | Baru | Tinggi |
| 5 | Mitra Strategis | Rename label | Rendah (cepat) |
| 6 | Dokumen (Kategori + Dokumen) | Baru | Sedang |
| 7 | Berita (Kategori + Berita) | Baru | Sedang |

---

## Ringkasan Perubahan

| | Jumlah |
|---|---|
| Tabel baru | 6 tabel |
| Tabel dimodifikasi | 1 tabel (`master_banner`) |
| Controller baru | 6 controller |
| Model baru | 6 model |
| View folder baru | 6 folder (masing-masing 4 file) |
| Menu diubah label | 1 item (Customer → Mitra Strategis) |

---

*Dokumen ini dibuat berdasarkan analisis struktur kode, desain mockup (folder `doc/`), dan file `doc/ptdap.sql`.*
*Tanggal: 2026-05-28*
