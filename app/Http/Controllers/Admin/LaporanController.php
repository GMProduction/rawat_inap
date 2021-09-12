<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //


    public function index()
    {

        $data    = [
            'data'  => "",
            'total' => "",
        ];

        return view('admin.laporan')->with($data);
    }

    public function cetakPersetujuan()
    {
        return $this->dataPersetujuan();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataPersetujuan())->setPaper('f4', 'potrait');

        return $pdf->stream();
    }

    public function dataPersetujuan()
    {
        $start   = \request('start');
        $end     = \request('end');
        // $pesanan = $this->getPesanan($start, $end);
        // $total   = Pesanan::where('status_pesanan', '=', 4);
        // if ($start) {
        //     $total = $total->whereBetween('tanggal_pesanan', [date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))]);
        // }
        // $total = $total->sum('total_harga');
        $data = [
            'start' => \request('start'),
            'end' => \request('end'),
            // 'data' => $pesanan,
            // 'total' => $total
        ];

        return view('admin/cetakpersetujuan')->with(["data"=>$data, "start"=>$start, "end" => $end]);
    }

    public function cetakPembayaran()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataPembayaran())->setPaper('f4', 'potrait');

        return $pdf->stream();
    }

    public function dataPembayaran()
    {
        $start   = \request('start');
        $end     = \request('end');
        // $pesanan = $this->getPesanan($start, $end);
        // $total   = Pesanan::where('status_pesanan', '=', 4);
        // if ($start) {
        //     $total = $total->whereBetween('tanggal_pesanan', [date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))]);
        // }
        // $total = $total->sum('total_harga');
        $data = [
            'start' => \request('start'),
            'end' => \request('end'),
            // 'data' => $pesanan,
            // 'total' => $total
        ];

        return view('admin/cetakpembayaran')->with(["data"=>$data, "start"=>$start, "end" => $end]);
    }

    public function cetakPembayarand()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataPembayarand())->setPaper('f4', 'potrait');

        return $pdf->stream();
    }

    public function dataPembayarand()
    {
        $start   = \request('start');
        $end     = \request('end');
        // $pesanan = $this->getPesanan($start, $end);
        // $total   = Pesanan::where('status_pesanan', '=', 4);
        // if ($start) {
        //     $total = $total->whereBetween('tanggal_pesanan', [date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))]);
        // }
        // $total = $total->sum('total_harga');
        $data = [
            'start' => \request('start'),
            'end' => \request('end'),
            // 'data' => $pesanan,
            // 'total' => $total
        ];

        return view('admin/cetakpembayarand')->with(["data"=>$data, "start"=>$start, "end" => $end]);
    }

    public function cetakLaporan()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataLaporan())->setPaper('f4', 'potrait');

        return $pdf->stream();
    }

    public function dataLaporan()
    {
        $start   = \request('start');
        $end     = \request('end');
        // $pesanan = $this->getPesanan($start, $end);
        // $total   = Pesanan::where('status_pesanan', '=', 4);
        // if ($start) {
        //     $total = $total->whereBetween('tanggal_pesanan', [date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))]);
        // }
        // $total = $total->sum('total_harga');
        $data = [
            'start' => \request('start'),
            'end' => \request('end'),
            // 'data' => $pesanan,
            // 'total' => $total
        ];

        return view('admin/cetaklaporan')->with(["data"=>$data, "start"=>$start, "end" => $end]);
    }
}
