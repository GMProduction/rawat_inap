<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RawatInapController;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //

    public function getData()
    {
        $start = \request('start');
        $end   = \request('end');
        $rawat = new RawatInapController();
        $data  = $rawat->getData()->where('tanggal_keluar', '!=', null);
        if ($start){
            $data = $data->whereBetween('tanggal_masuk',[date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))]);
        }
        return $data;
    }

    public function index()
    {
        $data = $this->getData();

        return view('admin.laporan')->with(['data' => $data]);
    }

    public function cetakPersetujuan($id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataPersetujuan($id))->setPaper('f4', 'potrait');

        return $pdf->stream();
    }

    public function dataPersetujuan($id)
    {
        $pasien = new RawatInapController();
        $data   = [
            'pasien' => $pasien->getData()->where('id', '=', $id)->first(),
        ];

        return view('admin/cetakpersetujuan')->with($data);
    }

    public function cetakPembayaran($id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataPembayaran($id))->setPaper('f4', 'landscape');

        return $pdf->stream();
    }

    public function dataPembayaran($id)
    {
        $pasien     = new RawatInapController();
        $pasienData = $pasien->getData()->where('id', '=', $id)->first();
        $masuk      = date_create($pasienData->tanggal_masuk);
        $sekarang   = date_create(now());
        $data       = [
            'pasien'      => $pasienData,
            'data'        => $pasien->getDataDetail($id),
            'total_biaya' => $pasien->getDataDetail($id)->sum('biaya'),
            'hari'        => (int)date_diff($masuk, $sekarang)->format("%a") == 0 ? 1 : (int)date_diff($masuk, $sekarang)->format("%a"),
        ];

        return view('admin/cetakpembayaran')->with($data);
    }

    public function cetakPembayarand()
    {
        return $this->dataPembayarand();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataPembayarand())->setPaper('f4', 'potrait');

        return $pdf->stream();
    }

    public function dataPembayarand()
    {
        $start = \request('start');
        $end   = \request('end');
        // $pesanan = $this->getPesanan($start, $end);
        // $total   = Pesanan::where('status_pesanan', '=', 4);
        // if ($start) {
        //     $total = $total->whereBetween('tanggal_pesanan', [date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))]);
        // }
        // $total = $total->sum('total_harga');
        $data = [
            'start' => \request('start'),
            'end'   => \request('end'),
            // 'data' => $pesanan,
            // 'total' => $total
        ];

        return view('admin/cetakpembayarand')->with(["data" => $data, "start" => $start, "end" => $end]);
    }

    public function cetakLaporan()
    {
      
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataLaporan())->setPaper('f4', 'potrait');

        return $pdf->stream();
    }

    public function dataLaporan()
    {
        $start = \request('start');
        $end   = \request('end');
        $data = $this->getData();

        return view('admin/cetaklaporan')->with(["data" => $data, "start" => $start, "end" => $end]);
    }
}
