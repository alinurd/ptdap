<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Master\Banner;
use App\Models\Master\BeritaKategori;
use App\Models\Master\Berita;
use App\Models\Master\BisnisKategori;
use App\Models\Master\Company;
use App\Models\Master\Customer;
use App\Models\Master\Dokumen;
use App\Models\Master\DokumenKategori;
use App\Models\Master\Karir;
use App\Models\Master\KarirLamaran;
use App\Models\Master\KarirLamaranJawaban;
use App\Models\Master\Pengalaman;
use App\Models\Master\Personil;
use App\Models\Master\RuangUnduh;
use App\Models\Master\RuangUnduhKategori;
use Illuminate\Http\Request;

class LanddingController extends Controller
{
    private function setting()
    {
        return AppSetting::first();
    }

    private function halamanBanner(string $page = '')
    {
        $q = Banner::where('type', 'halaman')->where('status', 1);
        if ($page) {
            $banner = (clone $q)->where('page', $page)->orderBy('sort')->first();
            if ($banner) return $banner;
        }
        return $q->orderBy('sort')->first();
    }

    public function index()
    {
        return view('frontend.index', [
            'setting'      => $this->setting(),
            'banners'      => Banner::where('type', 'home')->where('status', 1)->orderBy('sort')->get(),
            'company'      => Company::where('status', 1)->first(),
            'bisnis'       => BisnisKategori::where('status', 1)->orderBy('sort')->get(),
            'pengalamans'  => Pengalaman::where('status', 1)->orderBy('sort')->take(6)->get(),
        ]);
    }

    public function mengenaiKami()
    {
        return view('frontend.mengenai-kami', [
            'setting'   => $this->setting(),
            'banner'    => $this->halamanBanner('mengenai_kami'),
            'company'   => Company::where('status', 1)->first(),
            'customers' => Customer::where('status', 1)->orderBy('sort')->get(),
        ]);
    }

    public function organisasiManajemen()
    {
        //  return $this->errors();
        return view('frontend.organisasi-manajemen', [
            'setting'  => $this->setting(),
            'banner'   => $this->halamanBanner('organisasi_manajemen'),
            'personils' => Personil::where('status', 1)->orderBy('sort')->get(),
        ]);
    }

    public function sertifikasi()
    {
        return view('frontend.sertifikasi', [
            'setting'   => $this->setting(),
            'banner'    => $this->halamanBanner('sertifikasi'),
            'kategoris' => DokumenKategori::where('status', 1)
                            ->with(['dokumens' => fn($q) => $q->where('status', 1)->orderBy('sort')])
                            ->orderBy('sort')
                            ->get(),
        ]);
    }

    public function produkLayanan()
    {
        // return $this->errors();
        return view('frontend.produk-layanan', [
            'setting' => $this->setting(),
            'banner'  => $this->halamanBanner('produk-layanan'),
            'bisnis'  => BisnisKategori::where('status', 1)->orderBy('sort')->get(),
        ]);
    }

    public function pengalaman()
    {
        // return $this->errors();
        return view('frontend.pengalaman', [
            'setting'      => $this->setting(),
            'banner'       => $this->halamanBanner('pengalaman'),
            'pengalamans'  => Pengalaman::where('status', 1)->orderBy('sort')->paginate(5),
        ]);
    }

    public function berita()
    {
        // return $this->errors();
        return view('frontend.berita', [
            'setting'   => $this->setting(),
            'banner'    => $this->halamanBanner('berita'),
            'beritas'   => Berita::where('status', 1)->orderBy('tanggal', 'desc')->paginate(5),
            'recent'    => Berita::where('status', 1)->orderBy('tanggal', 'desc')->take(3)->get(),
            'kategoris' => BeritaKategori::where('status', 1)->orderBy('sort')->get(),
        ]);
    }

    public function beritaDetail($slug)
    {
        // return $this->errors();
        return view('frontend.berita-detail', [
            'setting' => $this->setting(),
            'berita'  => Berita::where('slug', $slug)->where('status', 1)->firstOrFail(),
            'recent'  => Berita::where('status', 1)->orderBy('tanggal', 'desc')->take(3)->get(),
        ]);
    }

    public function ruangUnduh(Request $request)
    {
        return view('frontend.ruang-unduh', [
            'setting'   => $this->setting(),
            'banner'    => $this->halamanBanner('ruang_unduh'),
            'kategoris' => RuangUnduhKategori::where('status', 1)->orderBy('sort')->get(),
            'search'    => $request->input('search'),
            'kategori'  => $request->input('kategori'),
            'items'     => RuangUnduh::with('kategori')->where('status', 1)
                            ->when($request->filled('search'), fn($q) => $q->where('judul', 'like', '%' . $request->search . '%'))
                            ->when($request->filled('kategori'), fn($q) => $q->where('kategori_id', $request->kategori))
                            ->orderBy('sort')
                            ->paginate(9)
                            ->withQueryString(),
        ]);
    }

    public function karir()
    {
        return view('frontend.karir', [
            'setting' => $this->setting(),
            'banner'  => $this->halamanBanner('karir'),
            'items'   => Karir::where('status', 1)->orderBy('sort')->paginate(9),
        ]);
    }

    public function karirDetail($slug)
    {
        return view('frontend.karir-detail', [
            'setting' => $this->setting(),
            'karir'   => Karir::with('formFields')->where('slug', $slug)->where('status', 1)->firstOrFail(),
        ]);
    }

    public function karirApply(Request $request, $slug)
    {
        $karir = Karir::with('formFields')->where('slug', $slug)->where('status', 1)->firstOrFail();

        $rules = [];
        foreach ($karir->formFields as $field) {
            $ruleParts = [$field->is_required ? 'required' : 'nullable'];
            if ($field->type === 'file') {
                $ruleParts[] = 'file';
                $ruleParts[] = 'mimes:pdf,doc,docx';
                $ruleParts[] = 'max:5120';
            } elseif (in_array($field->type, ['select', 'radio'])) {
                $ruleParts[] = 'in:' . implode(',', $field->optionList());
            } elseif ($field->type === 'checkbox') {
                $ruleParts[] = 'array';
            } else {
                $ruleParts[] = 'string';
            }
            $rules['answers.' . $field->id] = implode('|', $ruleParts);
        }

        $validated = $request->validate($rules);
        $answers = $validated['answers'] ?? [];

        $lamaran = KarirLamaran::create(['karir_id' => $karir->id]);

        foreach ($karir->formFields as $field) {
            $value = $answers[$field->id] ?? null;
            $jawaban = ['lamaran_id' => $lamaran->id, 'karir_form_field_id' => $field->id, 'label_snapshot' => $field->label];

            if ($field->type === 'file' && $request->hasFile("answers.$field->id")) {
                $file = $request->file('answers')[$field->id];
                $jawaban['file_path'] = 'storage/karir/lamaran/' . fileUpload($file, 'karir/lamaran/');
            } elseif (is_array($value)) {
                $jawaban['value'] = implode(', ', $value);
            } else {
                $jawaban['value'] = $value;
            }

            KarirLamaranJawaban::create($jawaban);
        }

        return response()->json(['status' => 'success', 'message' => 'Lamaran Anda berhasil dikirim. Tim kami akan segera menghubungi Anda.']);
    }

    public function hubungiKami()
    {
        // return $this->errors();
        return view('frontend.hubungi-kami', [
            'setting' => $this->setting(),
            'banner'  => $this->halamanBanner('hubungi_kami'),
        ]);
    }
    public function errors()
    {
        return view('frontend.errors.404', [
            'setting' => $this->setting(),
            'banner'  => $this->halamanBanner('hubungi-kami'),
        ]);
    }


    public function sendContact(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'subjek'  => 'required|string|max:150',
            'pesan'   => 'required|string|min:10',
        ]);

        return response()->json(['status' => 'error', 'message' => 'Pesan berhasil dikirim. Tim kami akan segera menghubungi Anda.']);
    }
}
