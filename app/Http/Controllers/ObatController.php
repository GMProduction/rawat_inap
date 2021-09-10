<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ObatController extends Controller
{
    //

    public function getData(){
        $data = Obat::all();
        return $data;
    }

    public function index(){
        if (\request()->isMethod('POST')){
            return $this->store();
        }
        return view('admin.obat')->with(['data' => $this->getData()]);
    }

    public function store(){
        $field = \request()->validate([
           'nama_obat' => 'required',
           'jenis_obat' => 'required'
        ]);
        Arr::set($field, 'harga', str_replace(',','',\request('harga')));
        if (\request('id')){
            $obat = Obat::find(\request('id'));
            $obat->update($field);
        }else{
            Obat::create($field);
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function delete($id){
        Obat::destroy($id);
        return response()->json(['msg' => 'berhasil']);
    }
}
