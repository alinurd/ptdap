<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected $prefixRoute = 'admin.master.banner.';

    public function index()
    {
        $data['data'] = Banner::where('type', 'home')->get();
        $data['prefixRoute'] = $this->prefixRoute;
        $data['title'] = 'Home Banner';
        $data['type'] = 'home';
        return view("admin.master.banner.index", $data);
    }

    public function indexHalaman()
    {
        $data['data'] = Banner::where('type', 'halaman')->get();
        $data['prefixRoute'] = 'admin.master.banner-halaman.';
        $data['title'] = 'Banner Halaman';
        $data['type'] = 'halaman';
        return view("admin.master.banner.index", $data);
    }

    public function create(Request $request)
    {
        $data = $request->only(['id', 'sort', 'status', 'title', 'image', 'dsc', 'type', 'page']);
        $data = (object) $data;

        if ($data->id == 0) {
            $sort = Banner::where('sort', $data->sort)->where('type', $data->type)->count();
        } else {
            $sort = Banner::where('sort', $data->sort)->where('type', $data->type)->where('id', '!=', $data->id)->count();
        }

        if ($sort != 0) {
            return response()->json(['status' => 'error', 'message' => 'Sort sudah dipakai']);
        }

        if (!empty($data->image)) {
            $data->image = str_replace(url('/') . '/', '', $data->image);
        }

        $dataSave = collect($data)->except(['id'])->toArray();
        if ($data->id == 0) {
            Banner::create($dataSave);
        } else {
            Banner::where('id', $data->id)->update($dataSave);
        }

        return response()->json(['status' => 'success', 'message' => 'Data Berhasil disimpan']);
    }

    public function delete($id)
    {
        $banner = Banner::findOrFail($id);
        $route = $banner->type === 'halaman' ? 'admin.master.banner-halaman.index' : 'admin.master.banner.index';
        $banner->delete();
        return redirect()->route($route)->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        $items = Banner::whereIn('id', $req->id)->get();
        $type = $items->first()->type ?? 'home';
        foreach ($items as $row) {
            Banner::findOrFail($row->id)->delete();
        }
        $route = $type === 'halaman' ? 'admin.master.banner-halaman.index' : 'admin.master.banner.index';
        return redirect()->route($route)->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        Banner::where('id', $id)->update(['status' => $request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = Banner::where('id', $id)->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
