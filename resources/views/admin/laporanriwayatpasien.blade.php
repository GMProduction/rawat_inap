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
                        {{-- <i class='bx bx-calendar me-2' style="font-size: 1.4rem"></i> --}}
                        <div class="me-2">
                            <div class="input-group input-daterange">
                                <label>Nama Pasien</label>
                                <input type="text" class="form-control ms-2" name="end" style="background-color: white">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mx-2">Cari</button>
                        {{-- <a class="btn btn-warning" id="cetak" target="_blank">Cetak</a> --}}
                    </div>
                </form>

            </div>

            <table class="table table-striped table-bordered ">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nama Pasien</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Tanggal Lahir</th>
                        <th class="text-center">Detail</th>
                    </tr>
                </thead>

                <tr>
                    <td>1</td>
                    <td>Joko</td>
                    <td>Jl. Bhayangkara 150 Tipes Serengan Surakarta</td>
                    <td>13 September 2021</td>
                    <td><a class="btn btn-warning btn-sm" id="detail">Detail</a></td>
                </tr>
            </table>

        </div>

        <div class="modal fade" id="detailpasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Detail Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered ">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Dokter</th>
                                <th>Perawat</th>
                                <th>Tanggal</th>
                                <th>Anamnesa</th>
                                <th>Tensi</th>
                                <th>Suhu</th>
                                <th>Obat</th>
                                <th>Tindakan</th>
                                <th>Biaya</th>
                              
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Budi</td>
                                    <td>-</td>
                                    <td>12 Septermber 2021</td>
                                    <td>80</td>
                                    <td>80</td>
                                    <td>Paracetamol</td>
                                    <td>80</td>
                                    <td>Pemberian Obat</td>
                                    <td>150.000</td>
                                </tr>
                            </tbody>
                           
    
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('script')
    <script>
        $(document).on('click', ' #detail', function() {
            $('#detailpasien').modal('show')
        });

        $('.input-daterange input').each(function() {
            $(this).datepicker({
                format: "dd-mm-yyyy"
            });
        });
        $(document).on('click', '#cetak', function() {
            $(this).attr('href', '/admin/cetaklaporan?' + $('#formTanggal').serialize());
        })
    </script>

@endsection
