<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\BisnisKategori;
use Illuminate\Http\Request;

class BisnisKategoriController extends Controller
{
    protected $prefixRoute = 'admin.master.bisnis-kategori.';

    public function index()
    {
        $data['data'] = BisnisKategori::orderBy('sort')->get();
        $data['prefixRoute'] = $this->prefixRoute;
        $data['title'] = 'Bisnis Kategori';
        return view("admin.master.bisnis-kategori.index", $data);
    }

    public function create(Request $request)
    {
        $data = $request->only(['id', 'sort', 'status', 'title', 'icon', 'description']);
        $data = (object) $data;

        if ($data->id == 0) {
            $sort = BisnisKategori::where('sort', $data->sort)->count();
        } else {
            $sort = BisnisKategori::where('sort', $data->sort)->where('id', '!=', $data->id)->count();
        }

        if ($sort != 0) {
            return response()->json(['status' => 'error', 'message' => 'Sort sudah dipakai']);
        }

        if (!empty($data->icon)) {
            $data->icon = str_replace(url('/') . '/', '', $data->icon);
        }

        $dataSave = collect($data)->except(['id'])->toArray();
        if ($data->id == 0) {
            BisnisKategori::create($dataSave);
        } else {
            BisnisKategori::where('id', $data->id)->update($dataSave);
        }

        return response()->json(['status' => 'success', 'message' => 'Data Berhasil disimpan']);
    }

    public function delete($id)
    {
        BisnisKategori::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (BisnisKategori::whereIn('id', $req->id)->get() as $row) {
            BisnisKategori::findOrFail($row->id)->delete();
        }
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        BisnisKategori::where('id', $id)->update(['status' => $request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = BisnisKategori::where('id', $id)->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
