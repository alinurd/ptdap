<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Line;
use App\Models\Master\PageDetail;
use Illuminate\Http\Request;

class LineController extends Controller
{
    protected $prefixRoute = 'admin.master.line.';
    public function index()
    {
        $data['data'] = Line::get();
         $data['prefixRoute'] = $this->prefixRoute;
        $data['cbo']['pageDetail'] = PageDetail::select('id', 'title')->get();
        $data['title'] = 'Line of Market';
        return view("admin.master.line.index", $data);
    }

    public function create(Request $request)
    { 

        $data = $request->only(['id', 'sort', 'status', 'image',
                                    'title', 
                                    // 'page_datail_id', 
                                    'description', 
                                ]);
        $data = (object) $data;

        if($data->id == 0){
            $sort = Line::where('sort',$data->sort)->count();
        } else {
            $sort = Line::where('sort',$data->sort)->where('id','!=',$data->id)->count();
        }

        if($sort != 0){
            return response()->json(['status'=> 'error', 'message' => 'Sort sudah dipakai']);
        } else {
            if(!empty($data->image)) {
                $data->image = str_replace(url('/').'/', '', $data->image);
            }

            $dataSave = collect($data)->except(['id'])->toArray();
            if($data->id == 0){
                Line::create($dataSave);
            } else {
                Line::where('id', $data->id)->update($dataSave);
            }
            return response()->json(['status'=>'success', 'message' => 'Data Berhasil disimpan']);
        }
    }

    public function delete($id)
    {
        Line::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (Line::whereIn('id', $req->id)->get() as $row) {
            Line::findOrFail($row['id'])->delete();
        }
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        Line::where('id', $id)->update(['status'=>$request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = Line::where('id',$id)->get();
        return response()->json(['status'=>'success','data'=>$data]);
    }
}