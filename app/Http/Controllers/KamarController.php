<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class KamarController extends Controller
{
    //

    public function getData(){
        $data = Kamar::all();
        return $data;
    }

    public function index(){
        if (\request()->isMethod('POST')){
            return $this->store();
        }
        return view('admin.kamar')->with(['data' => $this->getData()]);
    }

    public function store(){
        $field = \request()->validate([
            'nama_kamar' => 'required',
        ]);
        Arr::set($field, 'harga', str_replace(',','',\request('harga')));
        if (\request('id')){
            $kamar = Kamar::find(\request('id'));
            $kamar->update($field);
        }else{
            Kamar::create($field);
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function delete($id){
        Kamar::destroy($id);
        return response()->json(['msg' => 'berhasil']);
    }
}
