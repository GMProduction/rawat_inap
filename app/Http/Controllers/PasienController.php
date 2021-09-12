<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    //

    public function getData(){
        $data = Pasien::get();
        return $data;
    }

    public function index(){
        if (\request()->isMethod('POST')){
            return $this->store();
        }
        $last =  $this->getData()->last();
        $invID = str_pad(1, 3, '0', STR_PAD_LEFT);
        if ($last){
            $invID = str_pad((int)$last->id+ (int) 1, 3, '0', STR_PAD_LEFT);
        }
        $data = [
            'data' => $this->getData(),
            'count' => $invID
        ];
        return view('admin.pasien')->with($data);
    }

    public function store(){
        if (\request('id')){
            $pasien = Pasien::find(\request('id'));
            $pasien->update(\request()->all());
        }else{
            Pasien::create(\request()->all());
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function delete($id){
        Pasien::destroy($id);
        return response()->json(['msg' => 'berhasil']);
    }
}
