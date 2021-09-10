<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DokterController extends Controller
{
    //

    public function getData(){
        $dokter = Dokter::all();
        return $dokter;
    }

    public function index(){
        if (\request()->isMethod('POST')){
            return $this->store();
        }
        return view('admin.dokter')->with(['data' => $this->getData()]);
    }

    public function store(){
        $field = [
            'nama' => \request('nama'),
            'jenis_kelamin' => \request('jenis'),
            'spesialis' => \request('spesialis'),
            'tarif' => str_replace(',','',\request('tarif'))
        ];
        if (\request('id')){
            $dokter = Dokter::find(\request('id'));
            $dokter->update($field);
        }else{
            Dokter::create($field);
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function delete($id){
        Dokter::destroy($id);
        return response()->json(['msg' => 'berhasil']);
    }
}
