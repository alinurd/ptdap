<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Pengalaman;
use Illuminate\Http\Request;

class PengalamanController extends Controller
{
    protected $prefixRoute = 'admin.master.pengalaman.';

    public function index()
    {
        $data['data'] = Pengalaman::orderBy('sort')->get();
        $data['prefixRoute'] = $this->prefixRoute;
        $data['title'] = 'Pengalaman Kami';
        return view("admin.master.pengalaman.index", $data);
    }

    public function create(Request $request)
    {
        $data = $request->only(['id', 'sort', 'status', 'title', 'description', 'image', 'tanggal']);
        $data = (object) $data;

        if ($data->id == 0) {
            $sort = Pengalaman::where('sort', $data->sort)->count();
        } else {
            $sort = Pengalaman::where('sort', $data->sort)->where('id', '!=', $data->id)->count();
        }

        if ($sort != 0) {
            return response()->json(['status' => 'error', 'message' => 'Sort sudah dipakai']);
        }

        if (!empty($data->image)) {
            $data->image = str_replace(url('/') . '/', '', $data->image);
        }

        $dataSave = collect($data)->except(['id'])->toArray();
        if ($data->id == 0) {
            Pengalaman::create($dataSave);
        } else {
            Pengalaman::where('id', $data->id)->update($dataSave);
        }

        return response()->json(['status' => 'success', 'message' => 'Data Berhasil disimpan']);
    }

    public function delete($id)
    {
        Pengalaman::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (Pengalaman::whereIn('id', $req->id)->get() as $row) {
            Pengalaman::findOrFail($row->id)->delete();
        }
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        Pengalaman::where('id', $id)->update(['status' => $request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = Pengalaman::where('id', $id)->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
