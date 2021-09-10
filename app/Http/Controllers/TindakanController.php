<?php

namespace App\Http\Controllers;

use App\Models\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TindakanController extends Controller
{
    //
    public function getData(){
        $data = Tindakan::all();
        return $data;
    }

    public function index(){
        if (\request()->isMethod('POST')){
            return $this->store();
        }
        return view('admin.tindakan')->with(['data' => $this->getData()]);
    }

    public function store(){
        $field = \request()->validate([
            'nama_tindakan' => 'required',
        ]);
        Arr::set($field, 'harga', str_replace(',','',\request('harga')));
        if (\request('id')){
            $tindakan = Tindakan::find(\request('id'));
            $tindakan->update($field);
        }else{
            Tindakan::create($field);
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function delete($id){
        Tindakan::destroy($id);
        return response()->json(['msg' => 'berhasil']);
    }
}
