<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Karir;
use App\Models\Master\KarirFormField;
use Illuminate\Http\Request;

class KarirFormFieldController extends Controller
{
    public function index($karir)
    {
        $data['karir'] = Karir::findOrFail($karir);
        $data['data'] = KarirFormField::where('karir_id', $karir)->orderBy('sort')->get();
        $data['title'] = 'Kelola Form: ' . $data['karir']->judul;
        return view('admin.master.karir.form-builder', $data);
    }

    public function create(Request $request, $karir)
    {
        Karir::findOrFail($karir);

        $data = $request->only(['id', 'label', 'type', 'options', 'is_required', 'sort']);
        $data = (object) $data;

        if ($data->id == 0) {
            $sort = KarirFormField::where('karir_id', $karir)->where('sort', $data->sort)->count();
        } else {
            $sort = KarirFormField::where('karir_id', $karir)->where('sort', $data->sort)->where('id', '!=', $data->id)->count();
        }

        if ($sort != 0) {
            return response()->json(['status' => 'error', 'message' => 'Sort sudah dipakai']);
        }

        $dataSave = collect($data)->except(['id'])->toArray();
        $dataSave['karir_id'] = $karir;
        $dataSave['is_required'] = !empty($dataSave['is_required']) && $dataSave['is_required'] != '0';
        if (!in_array($data->type, ['select', 'radio', 'checkbox'])) {
            $dataSave['options'] = null;
        }

        if ($data->id == 0) {
            KarirFormField::create($dataSave);
        } else {
            KarirFormField::where('id', $data->id)->where('karir_id', $karir)->update($dataSave);
        }

        return response()->json(['status' => 'success', 'message' => 'Data Berhasil disimpan']);
    }

    public function delete($karir, $id)
    {
        KarirFormField::where('karir_id', $karir)->findOrFail($id)->delete();
        return redirect()->route('admin.master.karir.fields.index', $karir)->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req, $karir)
    {
        foreach (KarirFormField::where('karir_id', $karir)->whereIn('id', $req->id)->get() as $row) {
            $row->delete();
        }
        return redirect()->route('admin.master.karir.fields.index', $karir)->withSuccess('Data Berhasil dihapus!');
    }

    public function edit($karir, $id)
    {
        $data = KarirFormField::where('karir_id', $karir)->where('id', $id)->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
