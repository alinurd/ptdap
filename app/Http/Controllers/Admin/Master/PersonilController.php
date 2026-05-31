<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Personil;
use Illuminate\Http\Request;

class PersonilController extends Controller
{
    protected $prefixRoute = 'admin.master.personil.';

    public function index()
    {
        $data['data'] = Personil::orderBy('sort')->get();
        $data['prefixRoute'] = $this->prefixRoute;
        $data['title'] = 'Personil Manajemen';
        return view("admin.master.personil.index", $data);
    }

    public function create(Request $request)
    {
        $data = $request->only(['id', 'sort', 'status', 'nama', 'jabatan', 'deskripsi', 'foto']);
        $data = (object) $data;

        if ($data->id == 0) {
            $sort = Personil::where('sort', $data->sort)->count();
        } else {
            $sort = Personil::where('sort', $data->sort)->where('id', '!=', $data->id)->count();
        }

        if ($sort != 0) {
            return response()->json(['status' => 'error', 'message' => 'Sort sudah dipakai']);
        }

        if (!empty($data->foto)) {
            $data->foto = str_replace(url('/') . '/', '', $data->foto);
        }

        $dataSave = collect($data)->except(['id'])->toArray();
        if ($data->id == 0) {
            Personil::create($dataSave);
        } else {
            Personil::where('id', $data->id)->update($dataSave);
        }

        return response()->json(['status' => 'success', 'message' => 'Data Berhasil disimpan']);
    }

    public function delete($id)
    {
        Personil::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (Personil::whereIn('id', $req->id)->get() as $row) {
            Personil::findOrFail($row->id)->delete();
        }
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        Personil::where('id', $id)->update(['status' => $request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = Personil::where('id', $id)->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
