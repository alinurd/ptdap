<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Berita;
use App\Models\Master\BeritaKategori;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    protected $prefixRoute = 'admin.master.berita.';

    public function index()
    {
        $data['data'] = Berita::with('kategori')->orderBy('sort')->get();
        $data['kategoris'] = BeritaKategori::where('status', 1)->orderBy('sort')->get();
        $data['prefixRoute'] = $this->prefixRoute;
        $data['title'] = 'Berita';
        return view("admin.master.berita.index", $data);
    }

    public function create(Request $request)
    {
        $data = $request->only(['id', 'kategori_id', 'sort', 'status', 'judul', 'konten', 'image', 'tanggal']);
        $data = (object) $data;

        if ($data->id == 0) {
            $sort = Berita::where('sort', $data->sort)->count();
        } else {
            $sort = Berita::where('sort', $data->sort)->where('id', '!=', $data->id)->count();
        }

        if ($sort != 0) {
            return response()->json(['status' => 'error', 'message' => 'Sort sudah dipakai']);
        }

        if (!empty($data->image)) {
            $data->image = str_replace(url('/') . '/', '', $data->image);
        }

        $exceptId = $data->id != 0 ? (int) $data->id : null;
        $slug = Berita::generateSlug($data->judul, $exceptId);

        $dataSave = collect($data)->except(['id'])->toArray();
        $dataSave['slug'] = $slug;

        if ($data->id == 0) {
            Berita::create($dataSave);
        } else {
            Berita::where('id', $data->id)->update($dataSave);
        }

        return response()->json(['status' => 'success', 'message' => 'Data Berhasil disimpan']);
    }

    public function delete($id)
    {
        Berita::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (Berita::whereIn('id', $req->id)->get() as $row) {
            Berita::findOrFail($row->id)->delete();
        }
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        Berita::where('id', $id)->update(['status' => $request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = Berita::where('id', $id)->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
