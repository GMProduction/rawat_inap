@extends('admin.base')

@section('title')
    Data Barang
@endsection

@section('content')

    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            swal("Berhasil!", "Berhasil Menambah data!", "success");
        </script>
    @endif

    <section class="m-2">

        <div class="table-container">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="mb-3">Laporan</h5>
                <form id="formTanggal">
                    <div class="d-flex align-items-center">
                        <i class='bx bx-calendar me-2' style="font-size: 1.4rem"></i>
                        <div class="me-2">
                            <div class="input-group input-daterange">
                                <input type="text" class="form-control me-2" name="start" style="background-color: white" readonly value="{{ request('start') }}"
                                       required>
                                <div class="input-group-addon">to</div>
                                <input type="text" class="form-control ms-2" name="end" style="background-color: white" readonly value="{{ request('end') }}"
                                       required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mx-2">Cari</button>
                        <a class="btn btn-warning" id="cetak" target="_blank">Cetak</a>
                    </div>
                </form>

            </div>

            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nama Pasien</th>
                    <th class="text-center">No Registrasi</th>
                    <th class="text-center">Tanggal Masuk</th>
                    <th class="text-center">Tanggal Keluar</th>
                    <th class="text-center">Biaya</th>
                </tr>
                </thead>
                @forelse($data as $key => $d)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$d->rawat->pasien->nama}}</td>
                        <td>{{$d->rawat->no_reg}}</td>
                        <td>{{date('d F Y', strtotime($d->rawat->tanggal_masuk))}}</td>
                        <td>{{date('d F Y', strtotime($d->rawat->tanggal_keluar))}}</td>
                        <td>{{number_format($d->total_biaya, 0)}}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">Tidak ada data</td>
                    </tr>
                @endforelse
            </table>

        </div>

    </section>

@endsection

@section('script')
    <script>
        $('.input-daterange input').each(function () {
            $(this).datepicker({
                format: "dd-mm-yyyy"
            });
        });
        $(document).on('click', '#cetak', function () {
            $(this).attr('href', '/admin/cetaklaporanpendapatan?' + $('#formTanggal').serialize());
        })
    </script>

@endsection
