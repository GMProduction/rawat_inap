@extends('admin.base')
@section('title')
    Data Kategori
@endsection
@section('content')

    <section class="m-2">

        <section class="row">
            <div class="col-4">
                <div class="table-container">

                    <p class="fw-bold">Data Pasien</p>
                    <hr>
                    <div class="mb-3 mt-3">
                        <label for="noreg" class="form-label">No. Regsitrasi</label>
                        <input type="text" class="form-control" id="noreg" readonly value="{{$pasien->no_reg}}">
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="norm" class="form-label">Nomor Rekam Medis</label>
                        <input type="text" class="form-control" id="norm" readonly value="{{$pasien->pasien->no_rm}}">
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="namapasien" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control" id="namapasien" readonly value="{{$pasien->pasien->nama}}">
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="diagnosa" class="form-label">Diagnosa Awal</label>
                        <textarea class="form-control" readonly>{{$pasien->diagnosa_awal}}</textarea>
                    </div>

                    <hr>
                    @if($pasien->pembayaran)
                        <a type="submit" class="btn btn-success" target="_blank" href="/admin/cetakpembayaran/{{$pasien->id}}">Cetak Tagihan</a>
                        <a type="submit" class="btn btn-warning" target="_blank" href="/admin/cetakpembayarandetail">Cetak Rincian</a>
                    @else
                        <a class="btn btn-warning" href="/admin/cetakpersetujuan/{{$pasien->id}}" target="_blank"> Cetak Persetujuan</a>
                        <a class="btn btn-primary" id="checkoutp"> Checkout</a>
                    @endif

                </div>
            </div>
            <div class="col-8">
                <div class="table-container">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Data Perawatan</h5>
                        @if(!$pasien->pembayaran)
                            <button type="button ms-auto" class="btn btn-primary btn-sm" id="addData">Tambah Data
                            </button>
                        @endif
                    </div>

                    <table class="table table-striped table-bordered ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Dokter</th>
                            <th>Perawat</th>
                            <th>Tanggal</th>
                            <th>Tensi</th>
                            <th>Suhu</th>
                            <th>Obat</th>
                            <th>Tindakan</th>
                            <th>Biaya</th>
                            @if(!$pasien->pembayaran)
                                <th>Aksi</th>
                            @endif
                        </tr>
                        </thead>

                        @forelse($data as $key => $d)
                            <tr>
                                <td width="20">{{$key+1}}</td>
                                <td>{{$d->dokter ? $d->dokter->nama : '-'}}</td>
                                <td>{{$d->perawat ? $d->perawat->nama : '-'}}</td>
                                <td>{{\Carbon\Carbon::parse($d->tanggal)->isoFormat('LL, HH:mm')}}</td>
                                <td>{{$d->tensi_darah}}</td>
                                <td>{{$d->suhu_badan}}</td>
                                <td>{{$d->obat ? $d->obat->nama_obat : '-'}}</td>
                                <td>{{$d->tindakan ? $d->tindakan->nama_tindakan : '-'}}</td>
                                <td>Rp. {{number_format($d->biaya,0)}}</td>
                                @if(!$pasien->pembayaran)
                                    <td width="50">
                                        <a class="btn btn-sm btn-primary" id="editData" data-id="{{$d->id}}" data-hobat="{{$d->obat ? $d->obat->harga : 0}}"
                                           data-htindakan="{{$d->tindakan ? $d->tindakan->harga : 0}}" data-hdokter="{{$d->dokter ? $d->dokter->tarif : 0}}" data-harga="{{$d->biaya}}"
                                           data-suhu="{{$d->suhu_badan}}" data-tensi="{{$d->tensi_darah}}" data-tindakan="{{$d->tindakan ? $d->tindakan->id : ''}}"
                                           data-obat="{{$d->obat ? $d->obat->id : ''}}" data-tanggal="{{$d->tanggal}}" data-perawat="{{$d->perawat ? $d->perawat->id : ''}}"
                                           data-dokter="{{$d->dokter ? $d->dokter->id : ''}}" data-image="{{$d->url_foto}}">Edit</a>
                                        <a class="btn btn-sm btn-danger" id="deleteData" onclick="hapus('{{$d->id}}','')">Hapus</a>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="10">Tidak ada data</td>
                            </tr>
                        @endforelse

                    </table>
                    {{-- <div class="d-flex justify-content-end">
                        {{$data->links()}}
                    </div> --}}
                </div>
            </div>
        </section>

        <div class="modal fade" id="tambahkategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Rawat Inap</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form" onsubmit="return save()">
                            @csrf
                            <input id="id" name="id" type="number" hidden>

                            <label class="mt-3">Dokter</label>
                            <select class=" me-2 w-100 form-control" aria-label="select" id="dokter" name="id_dokter">
                                <option value="" data-harga="0" data-type="hdokter">Tanpa Dokter</option>
                                @foreach($dokter as $d)
                                    <option value="{{$d->id}}" data-type="hdokter" data-harga="{{$d->tarif}}">{{$d->nama}}</option>
                                @endforeach
                            </select>

                            <label class="mt-3">Perawat</label>
                            <select class=" me-2 w-100 form-control" aria-label="select" id="perawat" name="id_perawat">
                                <option value="">Tanpa Perawat</option>
                                @foreach($perawat as $d)
                                    <option value="{{$d->id}}">{{$d->nama}}</option>
                                @endforeach
                            </select>

                            <div class="mb-3 mt-3 ">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="datetime-local" class="form-control " name="tanggal" id="tanggal"
                                       required>
                            </div>

                            <label class="mt-3">Obat</label>
                            <select class=" me-2 w-100 form-control" aria-label="select" id="obat" name="id_obat">
                                <option value="" data-harga="0" data-type="hobat">Tanpa Obat</option>
                                @foreach($obat as $d)
                                    <option value="{{$d->id}}" data-type="hobat" data-harga="{{$d->harga}}">{{$d->nama_obat}}</option>
                                @endforeach
                            </select>

                            <label class="mt-3">tindakan</label>
                            <select class=" me-2 w-100 form-control" aria-label="select" id="tindakan" name="id_tindakan">
                                <option value="" data-harga="0" data-type="htindakan">Tanpa Tindakan</option>
                                @foreach($tindakan as $d)
                                    <option value="{{$d->id}}" data-type="htindakan" data-harga="{{$d->harga}}">{{$d->nama_tindakan}}</option>
                                @endforeach
                            </select>


                            <div class="mb-3 mt-3">
                                <label for="tensi" class="form-label">Tensi Darah</label>
                                <input type="text" class="form-control" id="tensi" name="tensi_darah" required>
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="suhu" class="form-label">Suhu Badan</label>
                                <input type="text" class="form-control" id="suhu" name="suhu_badan" required>
                            </div>
                            <hr>
                            <div class="mb-3 mt-3">
                                <label for="harga" class="form-label">Biaya</label>
                                <input type="text" class="form-control" readonly id="harga">
                                <input hidden class="form-control" readonly id="biaya" name="biaya">
                            </div>

                            <div class="mb-4"></div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="checkout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Checkout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formBayar" onsubmit="return checkout()">
                            @csrf
                            <input id="id" name="id_rawat" type="number" hidden value="{{$pasien->id}}">
                            <div class="mb-3 mt-3">
                                <label for="noreg" class="form-label">Nomor Registrasi</label>
                                <input type="text" class="form-control" id="noreg" readonly value="{{$pasien->pasien->no_rm}}">
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="nama" class="form-label">Nama Pasien</label>
                                <input type="text" class="form-control" id="nama" readonly value="{{$pasien->pasien->nama}}">
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="biayakamar" class="form-label">Total Biaya Kamar</label>
                                <input type="text" class="form-control text-end" id="biayakamar" readonly
                                       value="{{number_format($pasien->kamar->harga)}}  x {{$hari}} hari = {{number_format($pasien->kamar->harga * $hari,0)}}">
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="biayaperawatan" class="form-label">Total Biaya Perawatan</label>
                                <input type="text" class="form-control text-end" id="biayaperawatan" value="{{number_format($total_biaya,0)}}"
                                       readonly>
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="biayaperawatan" class="form-label">Total Keseluruhan</label>
                                <input type="text" class="form-control text-end" id="biayaperawatan" value="{{number_format(($pasien->kamar->harga * $hari) + $total_biaya, 0)}}"
                                       readonly>
                            </div>

                            <div class="mb-4"></div>
                            <input hidden name="biaya_kamar" value="{{$pasien->kamar->harga}}">
                            <input hidden name="jumlah_hari" value="{{$hari}}">
                            <input hidden name="total_biaya_kamar" value="{{$hari * $pasien->kamar->harga}}">
                            <input hidden name="biaya_perawatan" value="{{$total_biaya}}">
                            <input hidden name="total_biaya" value="{{$total_biaya + ($hari * $pasien->kamar->harga)}}">
                            <input hidden name="status" value="1">
                            <button type="submit" class="btn btn-primary">Bayar</button>
                            <a type="submit" class="btn btn-success" target="_blank" href="/admin/cetakpembayaran/{{$pasien->id}}">Cetak Tagihan</a>
                            <a type="submit" class="btn btn-warning" target="_blank" href="/admin/cetakpembayarandetail">Cetak Rincian</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')
    <script>
        var hdokter = 0, hobat = 0, htindakan = 0;

        $(document).on('click', ' #checkoutp', function () {
            $('#checkout').modal('show')
        });

        $(document).on('click', '#editData, #addData', function () {
            $('#tambahkategori #id').val($(this).data('id'))
            $('#tambahkategori #dokter').val($(this).data('dokter'))
            $('#tambahkategori #perawat').val($(this).data('perawat'))
            $('#tambahkategori #obat').val($(this).data('obat'))
            $('#tambahkategori #tindakan').val($(this).data('tindakan'))
            $('#tambahkategori #tensi').val($(this).data('tensi'))
            $('#tambahkategori #suhu').val($(this).data('suhu'))
            var harga = $(this).data('harga') ?? 0;
            $('#tambahkategori #biaya').val(harga)
            hobat = 0
            hdokter = 0
            htindakan = 0
            if ($(this).data('id')) {
                hobat = $(this).data('hobat')
                hdokter = $(this).data('hdokter')
                htindakan = $(this).data('htindakan')
                harga = harga.toLocaleString();
            }
            $('#tambahkategori #harga').val(harga)

            var tanggal = new Date($(this).data('tanggal'));
            tanggal.setMinutes(tanggal.getMinutes() - tanggal.getTimezoneOffset())
            if ($(this).data('id')) {
                tanggal = tanggal.toISOString().slice(0, 16)
            }
            $('#tambahkategori #tanggal').val(tanggal)
            $('#tambahkategori').modal('show')
        })

        $(document).on('change', '#dokter, #obat, #tindakan', function () {
            var type = $(this).find(':selected').data('type');
            window[type] = $(this).find(':selected').data('harga');
            var total = hdokter + hobat + htindakan;
            $('#harga').val(total.toLocaleString())
            $('#biaya').val(total)
            // type = $(this).find(':selected').data('harga')
            // console.log($('#obat').find(':selected').data('harga'))
            // console.log($('#tindakan').find(':selected').data('harga'))
        })

        function save() {
            var title = 'Tambah';
            if ($('#tambahkategori #id').val()) {
                title = 'Edit'
            }
            saveData(title + ' data', 'form');
            return false;
        }

        function checkout() {
            saveData('Checkout Pembayaran', 'formBayar', window.location.pathname + '/bayar');
            return false;
        }

        function after() {

        }

        function hapus(a, b) {
            deleteData(b, '/admin/rawatinap/' + a + '/deleteperawatan')
            return false;
        }

        $('.input-daterange input').each(function () {
            $(this).datepicker({
                format: "dd-mm-yyyy"
            });
        });
    </script>

@endsection
