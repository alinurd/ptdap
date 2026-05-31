<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Dokumen;
use App\Models\Master\DokumenKategori;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    protected $prefixRoute = 'admin.master.dokumen.';

    public function index()
    {
        $data['data'] = Dokumen::with('kategori')->orderBy('sort')->get();
        $data['kategoris'] = DokumenKategori::where('status', 1)->orderBy('sort')->get();
        $data['prefixRoute'] = $this->prefixRoute;
        $data['title'] = 'Dokumen';
        return view("admin.master.dokumen.index", $data);
    }

    public function create(Request $request)
    {
        $data = $request->only(['id', 'kategori_id', 'sort', 'status', 'judul', 'deskripsi', 'file', 'image']);
        $data = (object) $data;

        if ($data->id == 0) {
            $sort = Dokumen::where('sort', $data->sort)->count();
        } else {
            $sort = Dokumen::where('sort', $data->sort)->where('id', '!=', $data->id)->count();
        }

        if ($sort != 0) {
            return response()->json(['status' => 'error', 'message' => 'Sort sudah dipakai']);
        }

        if (!empty($data->image)) {
            $data->image = str_replace(url('/') . '/', '', $data->image);
        }
        if (!empty($data->file)) {
            $data->file = str_replace(url('/') . '/', '', $data->file);
        }

        $dataSave = collect($data)->except(['id'])->toArray();
        if ($data->id == 0) {
            Dokumen::create($dataSave);
        } else {
            Dokumen::where('id', $data->id)->update($dataSave);
        }

        return response()->json(['status' => 'success', 'message' => 'Data Berhasil disimpan']);
    }

    public function delete($id)
    {
        Dokumen::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (Dokumen::whereIn('id', $req->id)->get() as $row) {
            Dokumen::findOrFail($row->id)->delete();
        }
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        Dokumen::where('id', $id)->update(['status' => $request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = Dokumen::where('id', $id)->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
