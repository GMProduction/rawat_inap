@extends('admin.base')
@section('title')
    Data Kategori
@endsection
@section('content')

    <section class="m-2">


        <div class="table-container">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Data Obat</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" id="addData">Tambah Data
                </button>
            </div>

            <table class="table table-striped table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jenis Obat</th>
                        <th>Tarif</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <td>1</td>
                <td>Panadol</td>
                <td>Obat Nyamuk</td>
                <td>20000</td>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formKategori" onsubmit="return saveKategori()">
                            @csrf
                            <input id="id" name="id" type="number" hidden>
                            <div class="mb-3">
                                <label for="namaobat" class="form-label">Nama Obat</label>
                                <input type="text" class="form-control" id="namaobat" name="namaobat">
                            </div>


                            <div class="mb-3 mt-3">
                                <label for="jenisobat" class="form-label">Jenis Obat</label>
                                <input type="text" class="form-control" id="jenisobat" name="jenisobat">
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label">harga</label>
                                <input type="text" class="form-control" id="tarif" name="harga">
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
