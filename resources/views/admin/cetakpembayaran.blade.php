<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Print Card</title>
    <!-- Fonts -->

    <!-- Styles -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css" type="text/css">


</head>

<body>

<style>
    footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: 0;
    }

    table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
    }

    table caption {
        font-size: 1.5em;
        margin: .5em 0 .75em;
    }

    table tr {
        border: 1px solid #ddd;
        padding: .35em;
    }

    table th{
        text-align: center;
    }
    table th,
    table td {
        padding: .625em;
    }

    table th,
    table td {
        font-size: .8em;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    @media screen and (max-width: 600px) {
        table {
            border: 0;
        }

        table caption {
            font-size: 1.3em;
        }

        table thead {
            border: none;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        table tr {
            border-bottom: 3px solid #ddd;
            display: block;
            margin-bottom: .625em;
        }

        table td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: .6em;
            text-align: right;
        }

        table td::before {
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        table td:last-child {
            border-bottom: 0;
        }
    }

    .text-center {
        text-align: center !important;
    }

</style>

<br>

<div>
    <table style="border: none">
        <tr>
            <td class="text-center">
                <img src="{{ public_path('static-image/logo.png') }}" style="width: 80px;"/>

            </td>

            <td class="text-center">
                <div>
                    <h4 style=" text-align: center;margin-bottom:0;margin-top:0; font-size: 1.2rem">KLINIK .........</h4>
                    <h5 style=" text-align: center;margin-bottom:0;margin-top:0; font-size: 1.2rem">Kota Surakarta</h5>

                </div>
            </td>

            <td class="text-center">
                <img src="{{ public_path('static-image/logo.png') }}" style="width: 80px;"/>

            </td>

        </tr>
    </table>
    <hr>

    <h5 style=" text-align: center; font-size: 1rem; margin-top: 20px; margin-bottom: 10px">SURAT TAGIHAN RAWAT INAP</h5>

    <p>I. IDENTITAS PASIEN</p>
    <table style="border: none;  table-layout:fixed; ">
        <tr >
            <td style="text-align: left; width: 30% ">Nama</td>
            <td style="text-align: left; width: 1%">:</td>
            <td style="text-align: left">{{$pasien->pasien->nama}}</td>
        </tr>
        <tr>
            <td>No. Registrasi</td>
            <td>:</td>
            <td>{{$pasien->no_reg}}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{$pasien->pasien->alamat}}</td>
        </tr>
    </table>

    <p>II. TAGIHAN</p>
    <table style=" table-layout:fixed; ">
        <thead>
        <tr>
            <th style="width: 20px">#</th>
            <th style="">Dokter</th>
            <th >Perawat</th>
            <th>Tanggal</th>
            <th>Tensi</th>
            <th>Suhu</th>
            <th>Obat</th>
            <th>Tindakan</th>
            <th>Biaya</th>
        </tr>
        </thead>

        @forelse($data as $key => $d)
            <tr>
                <td class="text-center" style="width: 5%">{{$key+1}}</td>
                <td>{{$d->dokter ? $d->dokter->nama : '-'}}</td>
                <td>{{$d->perawat ? $d->perawat->nama : '-'}}</td>
                <td class="text-center">{{\Carbon\Carbon::parse($d->tanggal)->isoFormat('LL, HH:mm')}}</td>
                <td class="text-center">{{$d->tensi_darah}}</td>
                <td class="text-center">{{$d->suhu_badan}}</td>
                <td>{{$d->obat ? $d->obat->nama_obat : '-'}}</td>
                <td>{{$d->tindakan ? $d->tindakan->nama_tindakan : '-'}}</td>
                <td style="text-align: right">Rp. {{number_format($d->biaya,0)}}</td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="9">Tidak ada data</td>
            </tr>
        @endforelse


        <tr style="text-align: left; border-top: 1px solid grey">
            <td colspan="8" style="text-align: right;;font-weight: bold; border-top: 1px solid gray">Total Biaya Perawatan :</td>
            <td style="text-align: right; font-weight: bold; border-top: 1px solid gray">Rp {{number_format($total_biaya, 0)}}</td>
        </tr>
        <tr style="text-align: left; border-top: 1px solid grey">
            <td colspan="8" style="text-align: right;font-weight: bold">Biaya Kamar Rp. {{number_format($pasien->kamar->harga, 0)}} x {{$hari}} hari :</td>
            <td style="text-align: right; font-weight: bold">Rp {{number_format($pasien->kamar->harga * $hari, 0)}}</td>
        </tr>
        <tr style="text-align: left; border-top: 1px solid grey">
            <td colspan="8" style="text-align: right;font-weight: bold">Grand Total :</td>
            <td style="text-align: right; font-weight: bold">Rp {{number_format(($pasien->kamar->harga * $hari) + $total_biaya, 0)}}</td>
        </tr>
    </table>
    <table style="border: none">
        <tr>
            <td class="text-center" style="padding-bottom: 50px; text-transform: unset">Pimpinan</td>
            <td class="text-center" style="padding-bottom: 50px; text-transform: unset">Penanggung Jawab</td>
        </tr>
        <tr>
            <td class="text-center">( ........................... )</td>
            <td class="text-center">( ........................... )</td>
        </tr>
    </table>

    <footer class="footer">
        @php $date = new DateTime("now", new DateTimeZone('Asia/Bangkok') ); @endphp
        <p class="text-right small mb-0 mt-0 pt-0 pb-0"> di cetak oleh :
            {{-- {{ auth()->user()->username }} --}}
        </p>
        <p class="text-right small mb-0 mt-0 pt-0 pb-0"> tgl: {{ $date->format('d F Y, H:i:s') }} </p>
    </footer>

</div>


<!-- JS -->
<script src="js/app.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>
