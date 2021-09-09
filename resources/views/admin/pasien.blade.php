@extends('admin.base')
@section('title')
    Data Kategori
@endsection
@section('content')

    <section class="m-2">


        <div class="table-container">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Data pasien</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" id="addData">Tambah Data
                </button>
            </div>

            <table class="table table-striped table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No RM</th>
                        <th>No KTP</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <td>1</td>
                <td>rm-01213487</td>
                <td>331746454878754</td>
                <td>Joko</td>
                <td>22 Agustus 1889</td>
                <td>Perempuan</td>
                <td width="170">
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

        <div class="modal fade" id="tambahkategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formKategori" onsubmit="return saveKategori()">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <input id="id" name="id" type="number" hidden>
                                    <div class="mb-3">
                                        <label for="norm" class="form-label">Nomor Rekam Medis</label>
                                        <input type="text" class="form-control" id="norm" name="norm" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label for="noktp" class="form-label">Nomor KTP</label>
                                        <input type="text" class="form-control" id="noktp" name="noktp" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="namapasien" class="form-label">Nama pasien</label>
                                        <input type="text" class="form-control" id="namapasien" name="namapasien"
                                            required>
                                    </div>

                                    <div class="mb-3 input-daterange">
                                        <label for="tanggallahir" class="form-label">Tanggal Lahir</label>
                                        <input type="text" class="form-control " name="tanggallahir" id="tanggallahir"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="pendidikan" class="form-label">Pendidikan</label>
                                        <input type="text" class="form-control" id="pendidikan" name="pendidikan"
                                            required>
                                    </div>





                                    <div class="mb-3">
                                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
                                    </div>

                                </div>
                                <div class="col-6">

                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                                    </div>

                                    <label>Jenis Kelamin</label>
                                    <div class="form-check">
                                        <input style="padding: 0" class="form-check-input" type="radio" name="jeniskelamin"
                                            id="laki" value="1" checked>
                                        <label class="form-check-label" for="laki">
                                            Laki-laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input style="padding: 0" class="form-check-input" type="radio" name="jeniskelamin"
                                            id="perempuan" value="2">
                                        <label class="form-check-label" for="perempuan">
                                            Perempuan
                                        </label>
                                    </div>

                                    <label class="mt-3">Status Perkawinan</label>
                                    <div class="form-check">
                                        <input style="padding: 0" class="form-check-input" type="radio"
                                            name="statusperkawinan" id="belum" value="1" checked>
                                        <label class="form-check-label" for="belum">
                                            Belum Menikah
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input style="padding: 0" class="form-check-input" type="radio"
                                            name="statusperkawinan" id="sudah" value="2">
                                        <label class="form-check-label" for="sudah">
                                            Sudah Menikah
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input style="padding: 0" class="form-check-input" type="radio"
                                            name="statusperkawinan" id="cerai" value="3">
                                        <label class="form-check-label" for="cerai">
                                            Cerai
                                        </label>
                                    </div>


                                    <label class="mt-3">Agama</label>
                                    <select class=" me-2 w-100 form-control" aria-label="select" id="agama" name="agama">
                                        <option value="islam">Islam</option>
                                        <option value="kristen">Kristen</option>
                                        <option value="khatolik">Khatolik</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="budha">Budha</option>
                                    </select>

                                </div>
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
        $('.input-daterange input').each(function() {
            $(this).datepicker({
                format: "dd-mm-yyyy"
            });
        });

        $(document).on('click', '#addData', function() {
            $('#tambahkategori #id').val('')
            $('#tambahkategori #nama_kategori').val('')
            $('#tambahkategori #url_foto').val('')
            $('#tambahkategori #imgKate').attr('src', '')

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
    </script>

@endsection
