<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\RuangUnduh;
use App\Models\Master\RuangUnduhKategori;
use Illuminate\Http\Request;

class RuangUnduhController extends Controller
{
    protected $prefixRoute = 'admin.master.ruang-unduh.';
    protected $fileLocation = 'ruang-unduh/files/';

    public function index()
    {
        $data['data'] = RuangUnduh::with('kategori')->orderBy('sort')->get();
        $data['kategoris'] = RuangUnduhKategori::where('status', 1)->orderBy('sort')->get();
        $data['prefixRoute'] = $this->prefixRoute;
        $data['title'] = 'Ruang Unduh';
        return view("admin.master.ruang-unduh.index", $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:master_ruang_unduh_kategori,id',
            'sort'        => 'required|integer',
            'status'      => 'required',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'file'        => 'nullable|file|mimes:pdf,zip,rar|max:20480',
        ]);

        $data = $request->only(['id', 'kategori_id', 'sort', 'status', 'judul', 'deskripsi', 'image']);
        $data = (object) $data;

        $existing = $data->id != 0 ? RuangUnduh::find($data->id) : null;

        if ($data->id == 0) {
            $sort = RuangUnduh::where('sort', $data->sort)->count();
        } else {
            $sort = RuangUnduh::where('sort', $data->sort)->where('id', '!=', $data->id)->count();
        }

        if ($sort != 0) {
            return response()->json(['status' => 'error', 'message' => 'Sort sudah dipakai']);
        }

        if (!empty($data->image)) {
            $data->image = str_replace(url('/') . '/', '', $data->image);
        }

        $dataSave = collect($data)->except(['id'])->toArray();

        if ($request->hasFile('file')) {
            $oldFile = $existing?->file ? basename($existing->file) : null;
            $filename = fileUpload($request->file('file'), $this->fileLocation, $oldFile);
            $dataSave['file'] = 'storage/' . $this->fileLocation . $filename;
        } else {
            unset($dataSave['file']);
        }

        if ($data->id == 0) {
            RuangUnduh::create($dataSave);
        } else {
            RuangUnduh::where('id', $data->id)->update($dataSave);
        }

        return response()->json(['status' => 'success', 'message' => 'Data Berhasil disimpan']);
    }

    public function delete($id)
    {
        $item = RuangUnduh::findOrFail($id);
        if ($item->file) {
            fileDelete(basename($item->file), $this->fileLocation);
        }
        $item->delete();
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (RuangUnduh::whereIn('id', $req->id)->get() as $row) {
            if ($row->file) {
                fileDelete(basename($row->file), $this->fileLocation);
            }
            $row->delete();
        }
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        RuangUnduh::where('id', $id)->update(['status' => $request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = RuangUnduh::where('id', $id)->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
