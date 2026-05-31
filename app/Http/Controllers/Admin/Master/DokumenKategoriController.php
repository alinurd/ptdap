<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\DokumenKategori;
use Illuminate\Http\Request;

class DokumenKategoriController extends Controller
{
    protected $prefixRoute = 'admin.master.dokumen-kategori.';

    public function index()
    {
        $data['data'] = DokumenKategori::orderBy('sort')->get();
        $data['prefixRoute'] = $this->prefixRoute;
        $data['title'] = 'Kategori Dokumen';
        return view("admin.master.dokumen-kategori.index", $data);
    }

    public function create(Request $request)
    {
        $data = $request->only(['id', 'sort', 'status', 'nama']);
        $data = (object) $data;

        if ($data->id == 0) {
            $sort = DokumenKategori::where('sort', $data->sort)->count();
        } else {
            $sort = DokumenKategori::where('sort', $data->sort)->where('id', '!=', $data->id)->count();
        }

        if ($sort != 0) {
            return response()->json(['status' => 'error', 'message' => 'Sort sudah dipakai']);
        }

        $dataSave = collect($data)->except(['id'])->toArray();
        if ($data->id == 0) {
            DokumenKategori::create($dataSave);
        } else {
            DokumenKategori::where('id', $data->id)->update($dataSave);
        }

        return response()->json(['status' => 'success', 'message' => 'Data Berhasil disimpan']);
    }

    public function delete($id)
    {
        DokumenKategori::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (DokumenKategori::whereIn('id', $req->id)->get() as $row) {
            DokumenKategori::findOrFail($row->id)->delete();
        }
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        DokumenKategori::where('id', $id)->update(['status' => $request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = DokumenKategori::where('id', $id)->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
