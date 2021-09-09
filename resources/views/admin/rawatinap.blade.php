@extends('admin.base')
@section('title')
    Data Kategori
@endsection
@section('content')

    <section class="m-2">


        <div class="table-container">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Data Rawat Inap</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" id="addData">Tambah Data
                </button>
            </div>

            <table class="table table-striped table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nomor Registrasi</th>
                        <th>Nomor RM</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                        <th>Diagnosa Awal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <td>1</td>
                <td>reg123456</td>
                <td>rm12345</td>
                <td>Joko</td>
                <td>12 September 2021</td>
                <td>Rawat Inap</td>
                <td>Sakit Jiwa</td>
                <td width="210">
                    <a class="btn btn-sm btn-warning" href="/admin/rawatinapdetail">Detail</a>
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
                            <div class="mb-3">
                                <label for="namapasien" class="form-label">Nama Pasien</label>
                                <input type="text" class="form-control" id="namapasien" name="namapasien">
                            </div>

                            <label class="mt-3">Nama Pasien</label>
                            <select class=" me-2 w-100 form-control" aria-label="select" id="namapasien" name="namapasien">
                                <option value="no_rm">Joko</option>
                            </select>

                            
                            <label class="mt-3">Kamar</label>
                            <select class=" me-2 w-100 form-control" aria-label="select" id="kamar" name="kamar">
                                <option value="no_kamar">Mawar 1</option>
                            </select>

                            <div class="mb-3 mt-3 input-daterange">
                                <label for="tanggallahir" class="form-label">Tanggal Masuk</label>
                                <input type="text" class="form-control " name="tglmasuk" id="tglmasuk"
                                    required>
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="penanggungjawab" class="form-label">Nama Penanggung Jawab</label>
                                <input type="text" class="form-control" id="penanggungjawab" name="penanggungjawab">
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="hubpenanggungjawab" class="form-label">Hubungan Penanggung Jawab</label>
                                <input type="text" class="form-control" id="hubpenanggungjawab" name="hubpenanggungjawab">
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="diagnosaawal" class="form-label">Diagnosa Awal</label>
                                <input type="text" class="form-control" id="diagnosaawal" name="diagnosaawal">
                            </div>

                            <label class="mt-3">Penerimaan</label>
                            <select class=" me-2 w-100 form-control" aria-label="select" id="kamar" name="kamar">
                                <option value="igd">IGD</option>
                                <option value="langsung">Langsung</option>
                                <option value="rujukan">Rujukan</option>
                            </select>

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

        $('.input-daterange input').each(function() {
            $(this).datepicker({
                format: "dd-mm-yyyy"
            });
        });

    </script>

@endsection
