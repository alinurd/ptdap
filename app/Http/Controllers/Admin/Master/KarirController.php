<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Karir;
use App\Models\Master\KarirFormField;
use Illuminate\Http\Request;

class KarirController extends Controller
{
    protected $prefixRoute = 'admin.master.karir.';

    public function index()
    {
        $data['data'] = Karir::orderBy('sort')->get();
        $data['prefixRoute'] = $this->prefixRoute;
        $data['title'] = 'Karir';
        return view("admin.master.karir.index", $data);
    }

    public function create(Request $request)
    {
        $data = $request->only(['id', 'sort', 'status', 'judul', 'persyaratan', 'deskripsi', 'tanggal_tutup', 'image']);
        $data = (object) $data;

        if ($data->id == 0) {
            $sort = Karir::where('sort', $data->sort)->count();
        } else {
            $sort = Karir::where('sort', $data->sort)->where('id', '!=', $data->id)->count();
        }

        if ($sort != 0) {
            return response()->json(['status' => 'error', 'message' => 'Sort sudah dipakai']);
        }

        if (!empty($data->image)) {
            $data->image = str_replace(url('/') . '/', '', $data->image);
        }
        if (empty($data->tanggal_tutup)) {
            $data->tanggal_tutup = null;
        }

        $exceptId = $data->id != 0 ? (int) $data->id : null;
        $slug = Karir::generateSlug($data->judul, $exceptId);

        $dataSave = collect($data)->except(['id'])->toArray();
        $dataSave['slug'] = $slug;

        if ($data->id == 0) {
            $karir = Karir::create($dataSave);
            $this->seedDefaultFields($karir);
        } else {
            Karir::where('id', $data->id)->update($dataSave);
        }

        return response()->json(['status' => 'success', 'message' => 'Data Berhasil disimpan']);
    }

    protected function seedDefaultFields(Karir $karir)
    {
        $defaults = [
            ['label' => 'Nama Lengkap',      'type' => 'text', 'is_required' => true, 'sort' => 1],
            ['label' => 'Email',             'type' => 'text', 'is_required' => true, 'sort' => 2],
            ['label' => 'No. HP',            'type' => 'text', 'is_required' => true, 'sort' => 3],
            ['label' => 'Upload CV/Resume',  'type' => 'file', 'is_required' => true, 'sort' => 4],
        ];
        foreach ($defaults as $field) {
            KarirFormField::create($field + ['karir_id' => $karir->id]);
        }
    }

    public function delete($id)
    {
        Karir::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (Karir::whereIn('id', $req->id)->get() as $row) {
            Karir::findOrFail($row->id)->delete();
        }
        return redirect()->route($this->prefixRoute . 'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        Karir::where('id', $id)->update(['status' => $request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = Karir::where('id', $id)->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
