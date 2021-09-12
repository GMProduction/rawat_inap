<?php

namespace App\Http\Controllers;

use App\Models\Perawatan;
use App\Models\RawatInap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use function PHPUnit\Framework\isReadable;

class RawatInapController extends Controller
{
    //

    public function getData()
    {
        $data = RawatInap::get();

        return $data;
    }

    public function getDataDetail($id)
    {
        $data = Perawatan::where('id_rawat', '=', $id)->get();

        return $data;
    }

    public function index()
    {
        if (\request()->isMethod('POST')) {
            return $this->store();
        }
        $pasien = new PasienController();
        $kamar  = new KamarController();
        $data   = [
            'data'   => $this->getData(),
            'pasien' => $pasien->getData(),
            'kamar'  => $kamar->getData(),
        ];
        return view('admin.rawatinap')->with($data);
    }

    public function store()
    {
        $field = \request()->all();
        if (\request('id')) {
            $data = RawatInap::find(\request('id'));
            $data->update($field);
        } else {
            $noreg = date('dmyHis', strtotime(now()));
            Arr::set($field, 'no_reg', $noreg);
            RawatInap::create($field);
        }

        return response()->json(['msg' => 'berhasil']);
    }

    public function detail($id)
    {
        if (\request()->isMethod('POST')){
            return $this->storeDetail($id);
        }
//        Carbon::setLocale('id');
        $dokter = new DokterController();
        $perawat = new PerawatController();
        $obat = new ObatController();
        $tindakan = new TindakanController();
        $pasien = $this->getData()->where('id', '=', $id)->first();
        $masuk = date_create($pasien->tanggal_masuk);
        $sekarang = date_create(now());

        $data = [
            'pasien' => $pasien,
            'data'   => $this->getDataDetail($id),
            'total_biaya'   => $this->getDataDetail($id)->sum('biaya'),
            'dokter' => $dokter->getData(),
            'perawat' => $perawat->getData(),
            'obat' => $obat->getData(),
            'tindakan' => $tindakan->getData(),
            'hari' => (int) date_diff($masuk,$sekarang)->format("%a") == 0 ? 1 : (int) date_diff($masuk,$sekarang)->format("%a")
        ];
        return view('admin.rawatinapdetail')->with($data);
    }

    public function storeDetail($id){
        $rawat = RawatInap::find($id);
        $field = [
            'id_dokter' => \request('id_dokter'),
            'id_perawat' => \request('id_perawat'),
            'id_obat' => \request('id_obat'),
            'id_tindakan' => \request('id_tindakan'),
            'tanggal' => \request('tanggal'),
            'tensi_darah' => \request('tensi_darah'),
            'suhu_badan' => \request('suhu_badan'),
            'biaya' => \request('biaya'),
        ];
        if (\request('id')){
            $rawat->perawatan()->update($field);
        }else{
            $rawat->perawatan()->create($field);
        }
        return response()->json(['msg' => 'berhasil']);
    }

    public function deleteRawatInap($id){
        RawatInap::destroy($id);
        return response()->json(['msg' => 'berhasil']);
    }

    public function deletePerawatan($id){
        Perawatan::destroy($id);
        return response()->json(['msg' => 'berhasil']);
    }

    public function bayar($id){
        $rawat = RawatInap::find($id);
        $rawat->update(['tanggal_keluar' => now()]);
        $rawat->pembayaran()->create(\request()->all());
        return response()->json(['msg'=> 'berhasil']);
    }
}
