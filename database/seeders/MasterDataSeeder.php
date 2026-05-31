<?php

namespace Database\Seeders;

use App\Models\Master\Banner;
use App\Models\Master\BeritaKategori;
use App\Models\Master\Berita;
use App\Models\Master\BisnisKategori;
use App\Models\Master\DokumenKategori;
use App\Models\Master\Dokumen;
use App\Models\Master\Pengalaman;
use App\Models\Master\Personil;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedBanner();
        $this->seedBisnisKategori();
        $this->seedPengalaman();
        $this->seedPersonil();
        $this->seedDokumen();
        $this->seedBerita();
    }

    private function seedBanner(): void
    {
        // Home Banner
        $homeBanners = [
            [
                'type'   => 'home',
                'sort'   => 1,
                'status' => 1,
                'title'  => 'Kolaborasi Profesional untuk Indonesia',
                'dsc'    => '<p>PT Delta Angkasa Pratama hadir sebagai mitra strategis dalam layanan jasa, pengelolaan aset, dan pengadaan tenaga kerja yang memberikan nilai tambah bagi bangsa.</p>',
                'image'  => null,
            ],
            [
                'type'   => 'home',
                'sort'   => 2,
                'status' => 1,
                'title'  => 'Layanan Jasa Berkualitas Tinggi',
                'dsc'    => '<p>Menjadi perusahaan nasional yang unggul, profesional, dan terpercaya dalam layanan jasa untuk mendukung kemajuan Indonesia.</p>',
                'image'  => null,
            ],
            [
                'type'   => 'home',
                'sort'   => 3,
                'status' => 1,
                'title'  => 'Solusi Bisnis Terintegrasi',
                'dsc'    => '<p>Kami bergerak di bidang jasa, perdagangan, konstruksi, transportasi, industri, pertanian, dan perkebunan dengan standar profesional tertinggi.</p>',
                'image'  => null,
            ],
        ];

        // Banner Halaman
        $halamanBanners = [
            [
                'type'   => 'halaman',
                'page'   => 'Mengenai Kami',
                'sort'   => 1,
                'status' => 1,
                'title'  => 'Mengenai Kami',
                'dsc'    => '<p>Tentang PT Delta Angkasa Pratama</p>',
                'image'  => null,
            ],
            [
                'type'   => 'halaman',
                'page'   => 'Organisasi & Manajemen',
                'sort'   => 2,
                'status' => 1,
                'title'  => 'Organisasi & Manajemen',
                'dsc'    => '<p>Struktur Organisasi PT Delta Angkasa Pratama</p>',
                'image'  => null,
            ],
            [
                'type'   => 'halaman',
                'page'   => 'Pengalaman',
                'sort'   => 3,
                'status' => 1,
                'title'  => 'Pengalaman & Porto Folio',
                'dsc'    => '<p>Rekam jejak kegiatan PT Delta Angkasa Pratama</p>',
                'image'  => null,
            ],
            [
                'type'   => 'halaman',
                'page'   => 'Berita',
                'sort'   => 4,
                'status' => 1,
                'title'  => 'Berita',
                'dsc'    => '<p>Informasi terkini dari PT Delta Angkasa Pratama</p>',
                'image'  => null,
            ],
            [
                'type'   => 'halaman',
                'page'   => 'Hubungi Kami',
                'sort'   => 5,
                'status' => 1,
                'title'  => 'Hubungi Kami',
                'dsc'    => '<p>Kami siap melayani Anda</p>',
                'image'  => null,
            ],
        ];

        foreach (array_merge($homeBanners, $halamanBanners) as $banner) {
            Banner::create($banner);
        }
    }

    private function seedBisnisKategori(): void
    {
        $items = [
            [
                'sort'        => 1,
                'status'      => 1,
                'title'       => 'Jasa',
                'icon'        => null,
                'description' => 'Layanan jasa profesional yang mencakup berbagai kebutuhan bisnis dan operasional perusahaan.',
            ],
            [
                'sort'        => 2,
                'status'      => 1,
                'title'       => 'Perdagangan',
                'icon'        => null,
                'description' => 'Kegiatan perdagangan barang dan komoditas untuk mendukung rantai pasokan nasional.',
            ],
            [
                'sort'        => 3,
                'status'      => 1,
                'title'       => 'Konstruksi',
                'icon'        => null,
                'description' => 'Pelaksanaan proyek konstruksi dengan standar kualitas tinggi dan tepat waktu.',
            ],
            [
                'sort'        => 4,
                'status'      => 1,
                'title'       => 'Transportasi',
                'icon'        => null,
                'description' => 'Solusi logistik dan transportasi yang efisien untuk kebutuhan distribusi.',
            ],
            [
                'sort'        => 5,
                'status'      => 1,
                'title'       => 'Industri',
                'icon'        => null,
                'description' => 'Dukungan layanan untuk sektor industri manufaktur dan pengolahan.',
            ],
            [
                'sort'        => 6,
                'status'      => 1,
                'title'       => 'Pertanian',
                'icon'        => null,
                'description' => 'Layanan di bidang pertanian modern untuk meningkatkan produktivitas lahan.',
            ],
            [
                'sort'        => 7,
                'status'      => 0,
                'title'       => 'Perkebunan',
                'icon'        => null,
                'description' => 'Pengelolaan perkebunan secara profesional dengan teknologi terkini.',
            ],
        ];

        foreach ($items as $item) {
            BisnisKategori::create($item);
        }
    }

    private function seedPengalaman(): void
    {
        $items = [
            [
                'sort'        => 1,
                'status'      => 1,
                'title'       => 'Pemotонgan Rumput Bandara Soekarno Hatta',
                'description' => '<p>Berbagai kegiatan yang bertujuan untuk menjaga kesehatan dan estetika ruang luar Bandara Soekarno Hatta dan Properti Angkasa Pura lainnya. Kegiatan kami meliputi beberapa tugas seperti memotong rumput, pemupukan, pemangkasan, pengendalian hama, mengelola irigasi, dan perawatan lansekap yang komprehensif.</p>',
                'image'       => null,
                'tanggal'     => '2023-11-07',
            ],
            [
                'sort'        => 2,
                'status'      => 1,
                'title'       => 'Menyediakan SDM Pelayanan Publik',
                'description' => '<p>Penyediaan sumber daya manusia yang terlatih dan profesional untuk mendukung pelayanan publik di berbagai instansi pemerintah dan swasta. Tim kami siap memberikan solusi ketenagakerjaan yang tepat sasaran.</p>',
                'image'       => null,
                'tanggal'     => '2023-08-15',
            ],
            [
                'sort'        => 3,
                'status'      => 1,
                'title'       => 'Pengelolaan Aset Properti Angkasa Pura',
                'description' => '<p>Pengelolaan dan pemeliharaan aset properti milik Angkasa Pura Indonesia di berbagai lokasi bandara di seluruh Indonesia, memastikan setiap fasilitas berfungsi optimal dan terawat dengan baik.</p>',
                'image'       => null,
                'tanggal'     => '2022-05-20',
            ],
            [
                'sort'        => 4,
                'status'      => 1,
                'title'       => 'Pengadaan Peralatan dan Material Konstruksi',
                'description' => '<p>Pengadaan berbagai peralatan dan material konstruksi berkualitas untuk mendukung proyek-proyek infrastruktur nasional dengan harga kompetitif dan pengiriman tepat waktu.</p>',
                'image'       => null,
                'tanggal'     => '2022-01-10',
            ],
            [
                'sort'        => 5,
                'status'      => 1,
                'title'       => 'Layanan Transportasi Korporasi',
                'description' => '<p>Penyediaan armada transportasi korporasi yang aman, nyaman, dan andal untuk mendukung mobilitas karyawan dan operasional bisnis berbagai perusahaan di Indonesia.</p>',
                'image'       => null,
                'tanggal'     => '2021-09-03',
            ],
        ];

        foreach ($items as $item) {
            Pengalaman::create($item);
        }
    }

    private function seedPersonil(): void
    {
        $items = [
            [
                'sort'      => 1,
                'status'    => 1,
                'nama'      => 'Muhammad Husni',
                'jabatan'   => 'Direktur',
                'deskripsi' => 'Memimpin PT Delta Angkasa Pratama dengan visi menjadikan perusahaan sebagai mitra bisnis terpercaya di Indonesia.',
                'foto'      => null,
            ],
            [
                'sort'      => 2,
                'status'    => 1,
                'nama'      => 'Hendra Prastowo',
                'jabatan'   => 'Senior Manager Finance & HR',
                'deskripsi' => 'Bertanggung jawab atas pengelolaan keuangan perusahaan dan pengembangan sumber daya manusia secara menyeluruh.',
                'foto'      => null,
            ],
            [
                'sort'      => 3,
                'status'    => 1,
                'nama'      => 'Yakup Pratama',
                'jabatan'   => 'Senior Manager Comm & Opr',
                'deskripsi' => 'Mengelola operasional bisnis dan komunikasi strategis perusahaan untuk memastikan kelancaran seluruh kegiatan.',
                'foto'      => null,
            ],
            [
                'sort'      => 4,
                'status'    => 1,
                'nama'      => 'Rina Susanti',
                'jabatan'   => 'Manager Finance & HR',
                'deskripsi' => 'Mengelola administrasi keuangan, payroll, dan rekrutmen karyawan untuk mendukung pertumbuhan perusahaan.',
                'foto'      => null,
            ],
            [
                'sort'      => 5,
                'status'    => 1,
                'nama'      => 'Budi Santoso',
                'jabatan'   => 'Manager Operation & GA',
                'deskripsi' => 'Mengkoordinasikan seluruh kegiatan operasional lapangan dan urusan umum perusahaan.',
                'foto'      => null,
            ],
        ];

        foreach ($items as $item) {
            Personil::create($item);
        }
    }

    private function seedDokumen(): void
    {
        // Kategori
        $kategoris = [
            ['sort' => 1, 'status' => 1, 'nama' => 'Legalitas Perusahaan'],
            ['sort' => 2, 'status' => 1, 'nama' => 'Sertifikasi'],
            ['sort' => 3, 'status' => 1, 'nama' => 'Laporan Keuangan'],
            ['sort' => 4, 'status' => 1, 'nama' => 'Perizinan'],
        ];

        $createdKategoris = [];
        foreach ($kategoris as $kat) {
            $createdKategoris[] = DokumenKategori::create($kat);
        }

        // Dokumen
        $dokumens = [
            [
                'kategori_id' => $createdKategoris[0]->id,
                'sort'        => 1,
                'status'      => 1,
                'judul'       => 'Akta Pendirian Perusahaan No. 79',
                'deskripsi'   => 'Akta Pendirian PT Delta Angkasa Pratama yang disahkan oleh notaris dan Kementerian Hukum dan HAM.',
                'file'        => null,
                'image'       => null,
            ],
            [
                'kategori_id' => $createdKategoris[0]->id,
                'sort'        => 2,
                'status'      => 1,
                'judul'       => 'NIB (Nomor Induk Berusaha)',
                'deskripsi'   => 'Nomor Induk Berusaha yang diterbitkan oleh OSS sebagai identitas pelaku usaha.',
                'file'        => null,
                'image'       => null,
            ],
            [
                'kategori_id' => $createdKategoris[0]->id,
                'sort'        => 3,
                'status'      => 1,
                'judul'       => 'NPWP Perusahaan',
                'deskripsi'   => 'Nomor Pokok Wajib Pajak PT Delta Angkasa Pratama yang diterbitkan oleh Dirjen Pajak.',
                'file'        => null,
                'image'       => null,
            ],
            [
                'kategori_id' => $createdKategoris[1]->id,
                'sort'        => 1,
                'status'      => 1,
                'judul'       => 'Sertifikat ISO 9001:2015',
                'deskripsi'   => 'Sertifikasi Sistem Manajemen Mutu yang menjamin standar kualitas layanan perusahaan.',
                'file'        => null,
                'image'       => null,
            ],
            [
                'kategori_id' => $createdKategoris[3]->id,
                'sort'        => 1,
                'status'      => 1,
                'judul'       => 'Surat Izin Usaha Perdagangan (SIUP)',
                'deskripsi'   => 'Izin resmi untuk menjalankan kegiatan usaha perdagangan dari instansi berwenang.',
                'file'        => null,
                'image'       => null,
            ],
        ];

        foreach ($dokumens as $dok) {
            Dokumen::create($dok);
        }
    }

    private function seedBerita(): void
    {
        // Kategori
        $kategoris = [
            ['sort' => 1, 'status' => 1, 'nama' => 'Kegiatan'],
            ['sort' => 2, 'status' => 1, 'nama' => 'Pengumuman'],
            ['sort' => 3, 'status' => 1, 'nama' => 'Informasi'],
        ];

        $createdKategoris = [];
        foreach ($kategoris as $kat) {
            $createdKategoris[] = BeritaKategori::create($kat);
        }

        // Berita
        $beritas = [
            [
                'kategori_id' => $createdKategoris[0]->id,
                'sort'        => 1,
                'status'      => 1,
                'judul'       => 'Pemotонgan Rumput Bandara Soekarno Hatta',
                'slug'        => 'pemotongan-rumput-bandara-soekarno-hatta',
                'konten'      => '<p>Berbagai kegiatan yang bertujuan untuk menjaga kesehatan dan estetika ruang luar Bandara Soekarno Hatta dan Properti Angkasa Pura lainnya. Kegiatan kami meliputi beberapa tugas seperti memotong rumput, pemupukan, pemangkasan, pengendalian hama, mengelola irigasi, dan perawatan lansekap yang komprehensif.</p><p>Tim kami yang berpengalaman bekerja dengan standar tinggi untuk memastikan setiap sudut area hijau bandara terjaga keindahannya demi kenyamanan seluruh penumpang dan pengunjung.</p>',
                'image'       => null,
                'tanggal'     => '2023-11-07',
            ],
            [
                'kategori_id' => $createdKategoris[0]->id,
                'sort'        => 2,
                'status'      => 1,
                'judul'       => 'Menyediakan SDM Pelayanan Publik Berkualitas',
                'slug'        => 'menyediakan-sdm-pelayanan-publik-berkualitas',
                'konten'      => '<p>PT Delta Angkasa Pratama terus berkomitmen dalam menyediakan sumber daya manusia yang terlatih dan profesional untuk mendukung pelayanan publik di berbagai instansi.</p><p>Program pelatihan intensif yang kami lakukan memastikan setiap tenaga kerja yang kami tempatkan memiliki kompetensi sesuai dengan kebutuhan pengguna jasa.</p>',
                'image'       => null,
                'tanggal'     => '2023-08-15',
            ],
            [
                'kategori_id' => $createdKategoris[1]->id,
                'sort'        => 3,
                'status'      => 1,
                'judul'       => 'PT DAP Resmi Mendapatkan Sertifikasi ISO 9001:2015',
                'slug'        => 'pt-dap-resmi-mendapatkan-sertifikasi-iso-9001-2015',
                'konten'      => '<p>Dengan bangga kami umumkan bahwa PT Delta Angkasa Pratama telah resmi mendapatkan Sertifikasi Sistem Manajemen Mutu ISO 9001:2015.</p><p>Pencapaian ini merupakan bukti nyata komitmen kami terhadap kualitas layanan dan kepuasan pelanggan. Sertifikasi ini menegaskan bahwa setiap proses bisnis kami berjalan sesuai dengan standar internasional yang diakui secara global.</p>',
                'image'       => null,
                'tanggal'     => '2023-05-20',
            ],
            [
                'kategori_id' => $createdKategoris[2]->id,
                'sort'        => 4,
                'status'      => 1,
                'judul'       => 'Bidang Usaha PT Delta Angkasa Pratama',
                'slug'        => 'bidang-usaha-pt-delta-angkasa-pratama',
                'konten'      => '<p>Sesuai pasal 3 Akta Pendirian, ruang lingkup usaha PT DAP meliputi: Layanan Penyediaan tendon, rental, pengantar/penjemputan, layanan kebersihan, travel manajemen, pengemudi, resepsionis, tata graha, dan pengelolaan wisma.</p><p>Perusahaan kami bergerak di bidang jasa, perdagangan, konstruksi, transportasi, industri, pertanian, dan perkebunan dengan standar profesional tertinggi untuk memberikan nilai tambah strategis bagi mitra dan bangsa.</p>',
                'image'       => null,
                'tanggal'     => '2022-01-10',
            ],
            [
                'kategori_id' => $createdKategoris[0]->id,
                'sort'        => 5,
                'status'      => 1,
                'judul'       => 'Pengelolaan Fasilitas Properti Angkasa Pura Indonesia',
                'slug'        => 'pengelolaan-fasilitas-properti-angkasa-pura-indonesia',
                'konten'      => '<p>PT Delta Angkasa Pratama mendapatkan kepercayaan untuk mengelola fasilitas dan properti milik Angkasa Pura Indonesia di beberapa lokasi strategis.</p><p>Layanan kami mencakup pemeliharaan gedung, pengelolaan area hijau, kebersihan, dan berbagai layanan pendukung operasional bandara lainnya yang dilaksanakan secara profesional dan konsisten.</p>',
                'image'       => null,
                'tanggal'     => '2021-09-03',
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::create($berita);
        }
    }
}
