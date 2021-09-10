@extends('admin.base')
@section('title')
    Data Kategori
@endsection
@section('content')

    <section class="m-2">


        <div class="table-container">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Data Perawat</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" id="addData">Tambah Data
                </button>
            </div>

            <table class="table table-striped table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                 @forelse($data as $key => $d)
                    <tr>
                        <td width="20">{{$key+1}}</td>
                        <td>{{$d->nama}}</td>
                        <td>{{$d->jenis_kelamin}}</td>
                        <td width="150">
                            <a class="btn btn-sm btn-primary" id="editData" data-id="{{$d->id}}" data-nama="{{$d->nama}}" data-gender="{{$d->jenis_kelamin}}">Edit</a>
                            <a class="btn btn-sm btn-danger" id="deleteData" onclick="hapus('{{$d->id}}','{{$d->nama}}')">Hapus</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="4">Tidak ada perawat</td>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Perawat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form" onsubmit="return save()">
                            @csrf
                            <input id="id" name="id" type="number" hidden>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Perawat</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>


                            <label>Jenis Kelamin</label>
                            <div class="form-check">
                                <input style="padding: 0" class="form-check-input" type="radio" name="jenis_kelamin" id="Pria" value="Pria" checked>
                                <label class="form-check-label" for="Pria">
                                    Pria
                                </label>
                            </div>
                            <div class="form-check">
                                <input style="padding: 0"  class="form-check-input" type="radio" name="jenis_kelamin" id="Wanita" value="Wanita">
                                <label class="form-check-label" for="Wanita">
                                    Wanita
                                </label>
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

        $(document).on('click', '#editData, #addData', function() {
            $('#tambahkategori #id').val($(this).data('id'))
            $('#tambahkategori #nama').val($(this).data('nama'))
            $('#tambahkategori #Pria').prop('checked',true)
            if ($(this).data('id')){
                $('#tambahkategori #'+$(this).data('gender')).prop('checked',true)
            }
            $('#tambahkategori').modal('show')
        })

        function save() {
            var title = 'Tambah';
            if ( $('#tambahkategori #id').val()){
                title = 'Edit'
            }
            saveData(title+' data perawat', 'form');
            return false;
        }

        function hapus(a,b) {
            deleteData(b,window.location.pathname+'/'+a+'/delete')
            return false;
        }

    </script>

@endsection
