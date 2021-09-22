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
                            <div class="input-group">
                                <label>Nama Pasien</label>
                                <input type="text" class="form-control ms-2" value="{{request('name')}}" name="name" style="background-color: white">
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
                @forelse($data as $key => $d)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$d->nama}}</td>
                        <td>{{$d->alamat}}</td>
                        <td>{{date('d F Y', strtotime($d->tanggal_lahir))}}</td>
                        <td class="text-center"><a class="btn btn-warning btn-sm" data-id="{{$d->id}}" id="detail">Detail</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
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
                            <tbody id="tbDetail">

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
        $(document).on('click', ' #detail', function () {
            var id = $(this).data('id');
            detailTable(id);
            $('#detailpasien').modal('show')
        });

        $('.input-daterange input').each(function () {
            $(this).datepicker({
                format: "dd-mm-yyyy"
            });
        });
        $(document).on('click', '#cetak', function () {
            $(this).attr('href', '/admin/cetaklaporan?' + $('#formTanggal').serialize());
        })

        function detailTable(id) {
            $.get(window.location.pathname+'/'+id, function (data) {
                console.log(data)
                $('#tbDetail').empty();
                $.each(data, function (key, value) {
                    var dokter = value['dokter'] ? value['dokter']['nama'] : "-";
                    var perawat = value['perawat'] ? value['perawat']['nama'] : "-";
                    var obat = value['obat'] ? value['obat']['nama_obat'] : "-";
                    var tindakan = value['tindakan'] ? value['tindakan']['nama_tindakan'] : "-";
                    var biaya = value['biaya'] ? value['biaya'].toLocaleString() : '-';
                    $('#tbDetail').append('<tr>\n' +
                        '                                <td>'+parseInt(key+1)+'</td>\n' +
                        '                                <td>'+dokter+'</td>\n' +
                        '                                <td>perawat</td>\n' +
                        '                                <td>'+moment(value['tanggal']).format('DD MMMM YYYY')+'</td>\n' +
                        '                                <td>'+value['anamnesa']+'</td>\n' +
                        '                                <td>'+value['tensi_darah']+'</td>\n' +
                        '                                <td>'+value['suhu_badan']+'</td>\n' +
                        '                                <td>'+obat+'</td>\n' +
                        '                                <td>'+tindakan+'</td>\n' +
                        '                                <td>'+biaya+'</td>\n' +
                        '                            </tr>')
                })
            })
        }
    </script>

@endsection
