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
                    <img src="{{ public_path('static-image/logo.png') }}" style="width: 80px;" />

                </td>

                <td>
                    <div>
                        <h4 style=" text-align: center;margin-bottom:0;margin-top:0; font-size: 1.2rem">KLINIK MUTIARA ASRI</h4>
                        <h5 style=" text-align: center;margin-bottom:0;margin-top:0; font-size: 1.2rem">KECAMATAN CEPOGO</h5>

                    </div>
                </td>

                <td>
                    <img src="{{ public_path('static-image/solo.png') }}" style="width: 80px;" />

                </td>

            </tr>
        </table>
        <hr>

        <h5 style=" text-align: center; font-size: 1.4rem; margin-top: 20px; margin-bottom: 10px">SURAT PERSETUJUAN RAWAT INAP</h5>

        <p>I. IDENTITAS PASIEN</p>
        <table style="border: none;  table-layout:fixed; ">
            <tr style="width: 50px">
                <td style="text-align: left; width: 18%">Nama</td>
                <td style="text-align: left; width: 1%">:</td>
                <td style="text-align: left;" >{{$pasien->pasien->nama}}</td>
            </tr>
            <tr style="width: 5px">
                <td style="text-align: left; width: 1px" >No. RM</td>
                <td style="text-align: left; width: 1px">:</td>
                <td style="text-align: left; width: 1px">{{$pasien->pasien->no_rm}}</td>
            </tr>
            <tr style="text-align: left">
                <td style="text-align: left">Alamat</td>
                <td style="text-align: left">:</td>
                <td style="text-align: left">{{$pasien->pasien->alamat}}</td>
            </tr>
        </table>

        <p>II. KELUARGA / PENANGGUNG JAWAB</p>
        <table style="border: none; table-layout:fixed; ">
            <tr style="width: 30px">
                <td style="text-align: left; width: 35%">Nama</td>
                <td style="text-align: left; width: 1%">:</td>
                <td style="text-align: left; width: 30px">{{$pasien->penanggung_jawab}}</td>
            </tr>
            {{-- <tr style="width: 5px">
                <td style="text-align: left; width: 1px" >No. Hp</td>
                <td style="text-align: left; width: 1px">:</td>
                <td style="text-align: left; width: 1px">13215464</td>
            </tr> --}}
            <tr style="text-align: left">
                <td style="text-align: left">Hubungan dengan pasien</td>
                <td style="text-align: left">:</td>
                <td style="text-align: left">{{$pasien->hubungan_penanggung_jawab}}</td>
            </tr>
        </table>

        <p>Dengan surat ini saya bertindak sebagai penanggung jawab pasien tersebut diatas menyatakan bahwa setuju untuk merawat inap di klinik........</p>
        <div style="right:10px;width: 300px;display: inline-block;margin-top:70px">
            <p class="text-center ; " style="margin-bottom: 70px" >Pimpinan</p>
            <p class="text-center">( ........................... )</p>
        </div>

        <div style="left:10px;width: 300px; margin-left : 100px;display: inline-block">
            <p class="text-center " style="margin-bottom: 70px">Penanggung Jawab</p>
            <p class="text-center">( ........................... )</p>
            {{-- <p class="text-center">( {{ auth()->user()->username }} )</p> --}}
        </div>



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
