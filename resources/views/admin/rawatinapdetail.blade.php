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
                        <input type="text" class="form-control" id="noreg" readonly >
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="norm" class="form-label">Nomor Rekam Medis</label>
                        <input type="text" class="form-control" id="norm" readonly >
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="namapasien" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control" id="namapasien" readonly >
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="diagnosa" class="form-label">Diagnosa Awal</label>
                        <input type="text" class="form-control" id="diagnosa" readonly >
                    </div>

                    <hr>
                    <a class="btn btn-warning"> Cetak Persetujuan</a>
                    <a class="btn btn-primary"> Checkout</a>
                </div>
            </div>
            <div class="col-8">
                <div class="table-container">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Data Perawatan</h5>
                        <button type="button ms-auto" class="btn btn-primary btn-sm" id="addData">Tambah Data
                        </button>
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
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <td>1</td>
                        <td>Joko</td>
                        <td></td>
                        <td>12 September 2021</td>
                        <td>80/100</td>
                        <td>39</td>
                        <td>Obat Keras</td>
                        <td>Pasang Selang</td>
                        <td>20000</td>
                        <td width="150">
                            <a class="btn btn-sm btn-primary" id="editData">Ubah</a>
                            <a class="btn btn-sm btn-danger" id="editData">Hapus</a>
                        </td>
                        {{-- @forelse($data as $key => $d)
                            <tr>
                                <td width="20">{{$key+1}}</td>
                                <td width="100"><img src="{{$d->url_foto}}" height="75"></td>
                                <td>{{$d->nama_kategori}}</td>
                                <td width="50">
                                    <a class="btn btn-sm btn-primary" id="editData" data-id="{{$d->id}}" data-nama="{{$d->nama_kategori}}" data-image="{{$d->url_foto}}">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="8">Tidak ada kategori</td>
                            </tr>
                        @endforelse --}}

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
                        <form id="formKategori" onsubmit="return saveKategori()">
                            @csrf
                            <input id="id" name="id" type="number" hidden>

                            <label class="mt-3">Dokter</label>
                            <select class=" me-2 w-100 form-control" aria-label="select" id="dokter" name="dokter">
                                <option value="no_rm">Pilih Dokter</option>
                            </select>

                            <label class="mt-3">Perawat</label>
                            <select class=" me-2 w-100 form-control" aria-label="select" id="perawat" name="perawat">
                                <option value="no_rm">Pilih Perawat</option>
                            </select>

                            <div class="mb-3 mt-3 input-daterange">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="text" class="form-control " name="tanggal" id="tanggal"
                                    required>
                            </div>
                            
                            <label class="mt-3">Obat</label>
                            <select class=" me-2 w-100 form-control" aria-label="select" id="obat" name="obat">
                                <option value="no_rm">Pilih Obat</option>
                            </select>

                            <label class="mt-3">tindakan</label>
                            <select class=" me-2 w-100 form-control" aria-label="select" id="tindakan" name="tindakan">
                                <option value="no_rm">Pilih Tindakan</option>
                            </select>


                            <div class="mb-3 mt-3">
                                <label for="tensi" class="form-label">Tensi Darah</label>
                                <input type="text" class="form-control" id="tensi" name="tensi">
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="suhu" class="form-label">Suhu Badan</label>
                                <input type="text" class="form-control" id="suhu" name="suhu">
                            </div>
                            <hr>
                            <div class="mb-3 mt-3">
                                <label for="biaya" class="form-label">Biaya</label>
                                <input type="text" class="form-control" readonly id="biaya" name="biaya">
                            </div>

                            <div class="mb-4"></div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')
    <script>
        $(document).on('click', '#addData', function() {
           

            $('#tambahkategori').modal('show')
        })

        $(document).on('click', '#editData', function() {
            $('#tambahkategori #id').val($(this).data('id'))
            $('#tambahkategori #nama_kategori').val($(this).data('nama'))
            $('#tambahkategori #url_foto').val('')
            $('#tambahkategori #imgKate').attr('src', $(this).data('image'))
            $('#tambahkategori').modal('show')
        })

        function saveKategori() {
            saveData('Tambah kategori', 'formKategori', '/admin/produk/kategori');
            return false;
        }

        $('.input-daterange input').each(function() {
            $(this).datepicker({
                format: "dd-mm-yyyy"
            });
        });
    </script>

@endsection
