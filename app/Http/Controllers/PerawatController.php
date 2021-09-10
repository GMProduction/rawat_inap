<?php

namespace App\Http\Controllers;

use App\Models\Perawat;
use Illuminate\Http\Request;

class PerawatController extends Controller
{
    //

    public function getData(){
        $data = Perawat::all();
        return $data;
    }

    public function index(){
        if (\request()->isMethod('POST')){
            return $this->store();
        }
        return view('admin.perawat')->with(['data' => $this->getData()]);
    }

    public function store(){
        if (\request('id')){
            $perawat = Perawat::find(\request('id'));
            $perawat->update(\request()->all());
        }else{
            Perawat::create(\request()->all());
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function delete($id){
        Perawat::destroy($id);
        return response()->json(['msg' => 'berhasil']);
    }
}
