<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Karir;
use App\Models\Master\KarirLamaran;

class KarirLamaranController extends Controller
{
    protected $fileLocation = 'karir/lamaran/';

    public function index($karir)
    {
        $data['karir'] = Karir::findOrFail($karir);
        $data['data'] = KarirLamaran::where('karir_id', $karir)->orderBy('created_at', 'desc')->get();
        $data['title'] = 'Pelamar: ' . $data['karir']->judul;
        return view('admin.master.karir.pelamar', $data);
    }

    public function show($karir, $id)
    {
        $lamaran = KarirLamaran::where('karir_id', $karir)->with('jawaban')->findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $lamaran]);
    }

    public function delete($karir, $id)
    {
        $lamaran = KarirLamaran::where('karir_id', $karir)->with('jawaban')->findOrFail($id);
        foreach ($lamaran->jawaban as $jawaban) {
            if ($jawaban->file_path) {
                fileDelete(basename($jawaban->file_path), $this->fileLocation);
            }
        }
        $lamaran->delete();
        return redirect()->route('admin.master.karir.lamaran.index', $karir)->withSuccess('Data Berhasil dihapus!');
    }
}
