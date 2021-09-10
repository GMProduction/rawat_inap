@extends('admin.base')
@section('title')
    Data Kategori
@endsection
@section('content')

    <section class="m-2">


        <div class="table-container">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Data kamar</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" id="addData">Tambah Data
                </button>
            </div>

            <table class="table table-striped table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama kamar</th>
                        <th>Tarif Per Hari</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @forelse($data as $key => $d)
                    <tr>
                        <td width="20">{{$key+1}}</td>
                        <td>{{$d->nama_kamar}}</td>
                        <td>Rp. {{number_format($d->harga, 0)}}</td>
                        <td width="150">
                            <a class="btn btn-sm btn-primary" id="editData" data-id="{{$d->id}}" data-nama="{{$d->nama_kamar}}" data-harga="{{$d->harga}}">Edit</a>
                            <a class="btn btn-sm btn-danger" id="deleteData" onclick="hapus('{{$d->id}}','{{$d->nama_kamar}}')">Hapus</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="4">Tidak ada data</td>
                    </tr>
                @endforelse


            </table>
            {{-- <div class="d-flex justify-content-end">
                {{$data->links()}}
            </div> --}}
        </div>

        <div class="modal fade" id="tambahkategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data kamar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form" onsubmit="return save()">
                            @csrf
                            <input id="id" name="id" type="number" hidden>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama kamar</label>
                                <input type="text" class="form-control" id="nama" name="nama_kamar">
                            </div>


                            <div class="mb-3">
                                <label for="harga" class="form-label">Tarif Per Hari</label>
                                <input type="text" class="form-control" id="harga" name="harga">
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
        $(document).ready(function () {
            currency('harga')
        })
        $(document).on('click', '#editData, #addData', function() {
            $('#tambahkategori #id').val($(this).data('id'))
            $('#tambahkategori #nama').val($(this).data('nama'))
            var tarif = $(this).data('harga');
            if ($(this).data('id')){
                tarif = tarif.toLocaleString();
            }
            $('#tambahkategori #harga').val(tarif)
            $('#tambahkategori').modal('show')
        })

        function save() {
            var title = 'Tambah';
            if ( $('#tambahkategori #id').val()){
                title = 'Edit'
            }
            saveData(title+' data kamar', 'form');
            return false;
        }
        function hapus(a,b) {
            deleteData(b,window.location.pathname+'/'+a+'/delete')
            return false;
        }
    </script>

@endsection
