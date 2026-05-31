<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $prefixRoute = 'admin.master.company.';
    public function index()
    {
        $data['data'] = Company::get()->toarray();
        return view("admin.master.company.index", $data);
    }

    public function create(Request $request)
    { 

        $data = $request->only(['id',  'image',
                                    'review', 
                                    'vision', 
                                    'mission', 
                                    'service', 
                                    'lisensi',
                                    'about', 
                                    'sisko', 
                                ]);
                                 
        $data = (object) $data;

        // if($data->id == 0){
        //     $sort = Company::where('sort',$data->sort)->count();
        // } else {
        //     $sort = Company::where('sort',$data->sort)->where('id','!=',$data->id)->count();
        // }

        // if($sort != 0){
        //     return response()->json(['status'=> 'error', 'message' => 'Sort sudah dipakai']);
        // } else {
            if(!empty($data->image)) {
                $data->image = str_replace(url('/').'/', '', $data->image);
            }

            $dataSave = collect($data)->except(['id'])->toArray();
            if($data->id == 0){
                Company::create($dataSave);
            } else {
                Company::where('id', $data->id)->update($dataSave);
            }
            return response()->json(['status'=>'success', 'message' => 'Data Berhasil disimpan']);
        // }
    }

    public function delete($id)
    {
        Company::findOrFail($id)->delete();
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function multi_delete(Request $req)
    {
        foreach (Company::whereIn('id', $req->id)->get() as $row) {
            Company::findOrFail($row['id'])->delete();
        }
        return redirect()->route($this->prefixRoute.'index')->withSuccess('Data Berhasil dihapus!');
    }

    public function editstatus($id, Request $request)
    {
        Company::where('id', $id)->update(['status'=>$request->sts]);
        return response()->json(['status' => 'success', 'message' => 'Status Berhasil diubah']);
    }

    public function edit($id)
    {
        $data = Company::where('id',$id)->get();
        return response()->json(['status'=>'success','data'=>$data]);
    }
}