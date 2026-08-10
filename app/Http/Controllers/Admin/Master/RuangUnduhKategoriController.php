<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\RuangUnduhKategori;
use Illuminate\Http\Request;

class RuangUnduhKategoriController extends Controller
{
    protected $prefixRoute = 'admin.master.ruang-unduh-kategori.';

    public function index()
    {
        $data['data'] = RuangUnduhKategori::orderBy('sort')->get();
        $data['prefixRoute'] = $this->prefixRoute;
        $data['title'] = 'Kategori Ruang Unduh';
        return view("admin.master.ruang-unduh-kategori.index", $data);
    }

    public function create(Request $request)
    {
        $data = $request->only(['id', 'sort', 'status', 'nama']);
        $data = (object) $data;

        if ($data->id == 0) {
            $sort = RuangUnduhKategori::where('sort', $data->sort)->count();
        } else {
            $sort = RuangUnduhKategori::where('sort', $data->sort)->where('id', '!=', $data->id)->count();
        }

        if ($sort != 0) {
            return response()->json(['status' => 'error', 'message' => 'Sort sudah dipakai']);
        }

        $dataSave = collect($data)->except(['id'])->toArray();
        if ($data->id == 0) {
            RuangUnduhKategori::create($dataSave);
        } else {
            RuangUnduhKategori::where('id', $data->id)->update($dataSave);
        }

        return response()->json(['status' => 'success', 'message' => 'Data Berhasil disimpan']);
    }

    public function delete($id)
    {
        RuangUnduhKategori::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (RuangUnduhKategori::whereIn('id', $req->id)->get() as $row) {
            RuangUnduhKategori::findOrFail($row->id)->delete();
        }
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        RuangUnduhKategori::where('id', $id)->update(['status' => $request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = RuangUnduhKategori::where('id', $id)->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
