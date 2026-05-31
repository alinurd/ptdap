<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\BeritaKategori;
use Illuminate\Http\Request;

class BeritaKategoriController extends Controller
{
    protected $prefixRoute = 'admin.master.berita-kategori.';

    public function index()
    {
        $data['data'] = BeritaKategori::orderBy('sort')->get();
        $data['prefixRoute'] = $this->prefixRoute;
        $data['title'] = 'Kategori Berita';
        return view("admin.master.berita-kategori.index", $data);
    }

    public function create(Request $request)
    {
        $data = $request->only(['id', 'sort', 'status', 'nama']);
        $data = (object) $data;

        if ($data->id == 0) {
            $sort = BeritaKategori::where('sort', $data->sort)->count();
        } else {
            $sort = BeritaKategori::where('sort', $data->sort)->where('id', '!=', $data->id)->count();
        }

        if ($sort != 0) {
            return response()->json(['status' => 'error', 'message' => 'Sort sudah dipakai']);
        }

        $dataSave = collect($data)->except(['id'])->toArray();
        if ($data->id == 0) {
            BeritaKategori::create($dataSave);
        } else {
            BeritaKategori::where('id', $data->id)->update($dataSave);
        }

        return response()->json(['status' => 'success', 'message' => 'Data Berhasil disimpan']);
    }

    public function delete($id)
    {
        BeritaKategori::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (BeritaKategori::whereIn('id', $req->id)->get() as $row) {
            BeritaKategori::findOrFail($row->id)->delete();
        }
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        BeritaKategori::where('id', $id)->update(['status' => $request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = BeritaKategori::where('id', $id)->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
