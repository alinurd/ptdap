<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Master\Banner;
use App\Models\Master\BisnisKategori;
use App\Models\Master\Company;
use App\Models\Master\Customer;
use App\Models\Master\Dokumen;
use App\Models\Master\DokumenKategori;
use App\Models\Master\Iso;
use App\Models\Master\Pengalaman;
use App\Models\Master\Personil;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'banner' => [
                'title' => 'Banner',
                'items' => [
                    ['label' => 'Beranda',  'count' => Banner::where('type', 'home')->count()],
                    ['label' => 'Halaman',  'count' => Banner::where('type', 'halaman')->count()],
                ],
            ],
            'master' => [
                'title' => 'Master Data',
                'items' => [
                    ['label' => 'Bisnis Kategori',    'count' => BisnisKategori::count()],
                    ['label' => 'Mengenai Kami',      'count' => Company::count()],
                    ['label' => 'Mitra Strategis',    'count' => Customer::count()],
                    ['label' => 'Pengalaman Kami',    'count' => Pengalaman::count()],
                    ['label' => 'Personil Manajemen', 'count' => Personil::count()],
                    ['label' => 'Sertifikasi',        'count' => Iso::count()],
                ],
            ],
            'dokumen' => [
                'title' => 'Dokumen',
                'items' => [
                    ['label' => 'Kategori', 'count' => DokumenKategori::count()],
                    ['label' => 'Dokumen',  'count' => Dokumen::count()],
                ],
            ],
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
