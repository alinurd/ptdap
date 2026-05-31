<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Iso;
use App\Models\Master\PageDetail;
use Illuminate\Http\Request;

class IsoController extends Controller
{
    protected $prefixRoute = 'admin.master.iso.';
    public function index()
    {
        $data['data'] = Iso::get();
         $data['prefixRoute'] = $this->prefixRoute;
        $data['cbo']['pageDetail'] = PageDetail::select('id', 'title')->get();
        $data['title'] = 'Iso Certificate';
        return view("admin.master.iso.index", $data);
    }

    public function create(Request $request)
    { 

        $data = $request->only(['id', 'sort', 'status', 'image',
                                    'title', 
                                    'caption', 
                                    'description', 
                                ]);
        $data = (object) $data;

        if($data->id == 0){
            $sort = Iso::where('sort',$data->sort)->count();
        } else {
            $sort = Iso::where('sort',$data->sort)->where('id','!=',$data->id)->count();
        }

        if($sort != 0){
            return response()->json(['status'=> 'error', 'message' => 'Sort sudah dipakai']);
        } else {
            if(!empty($data->image)) {
                $data->image = str_replace(url('/').'/', '', $data->image);
            }

            $dataSave = collect($data)->except(['id'])->toArray();
            if($data->id == 0){
                Iso::create($dataSave);
            } else {
                Iso::where('id', $data->id)->update($dataSave);
            }
            return response()->json(['status'=>'success', 'message' => 'Data Berhasil disimpan']);
        }
    }

    public function delete($id)
    {
        Iso::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (Iso::whereIn('id', $req->id)->get() as $row) {
            Iso::findOrFail($row['id'])->delete();
        }
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        Iso::where('id', $id)->update(['status'=>$request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = Iso::where('id',$id)->get();
        return response()->json(['status'=>'success','data'=>$data]);
    }
}