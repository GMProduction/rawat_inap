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

        table th,
        table td {
            padding: .625em;
            text-align: center;
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
                <td>
                    <img src="{{ public_path('static-image/logo.png') }}" style="width: 120px;" />

                </td>

                <td>
                    <div>
                        <h4 style=" text-align: center;margin-bottom:0;margin-top:0; font-size: 1.2rem">KLINIK MUTIARA ASRI
                        </h4>
                        <h5 style=" text-align: center;margin-bottom:0;margin-top:0; font-size: .8rem">Laporan Rawat Inap
                        </h5>
                        <h5 style=" text-align: center;margin-bottom:0;margin-top:0; font-size: .8rem">Periode
                            @if($start)
                                <span >{{date('d F Y', strtotime($start))}} - {{date('d F Y', strtotime($end))}}</span>
                            @else
                                <span>Semua</span>
                            @endif
                        </h5>

                    </div>
                </td>

                <td>
                    <img src="{{ public_path('static-image/solo.png') }}" style="width: 120px;" />

                </td>

            </tr>
        </table>
        <hr>



        <p>Tabel Rawat Inap</p>
        <table style=" table-layout:fixed; ">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nama Pasien</th>
                <th class="text-center">No Registrasi</th>
                <th class="text-center">Tanggal Masuk</th>
                <th class="text-center">Tanggal Keluar</th>
                <th class="text-center">Penanggung Jawab</th>
                <th class="text-center">Diagnosa</th>
                <th class="text-center">Penerimaan</th>
            </tr>
            </thead>
            @forelse($data as $key => $d)
                <tr>
                    <td>{{$key +1}}</td>
                    <td>{{$d->pasien->nama}}</td>
                    <td>{{$d->no_reg}}</td>
                    <td>{{ \Carbon\Carbon::parse($d->tanggal_masuk)->isoFormat('LL, HH:mm')}}</td>
                    <td>{{ \Carbon\Carbon::parse($d->tanggal_keluar)->isoFormat('LL, HH:mm')}}</td>
                    <td>{{$d->penanggung_jawab}}</td>
                    <td>{{$d->diagnosa_awal}}</td>
                    <td>{{$d->penerimaan}}</td>
                </tr>
            @empty
                <td colspan="8" class="text-center">Tidak ada data</td>
            @endforelse
        </table>

        <table style="border: none; margin-top: 40px">
            <tr>
                <td class="text-center" style="padding-bottom: 50px; text-transform: unset">Pimpinan</td>
                <td class="text-center" style="padding-bottom: 50px; text-transform: unset">Admin</td>
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
