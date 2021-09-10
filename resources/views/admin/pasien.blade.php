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
                 @forelse($data as $key => $d)
                    <tr>
                        <td width="20">{{$key+1}}</td>
                        <td>{{$d->no_rm}}</td>
                        <td>{{$d->no_ktp}}</td>
                        <td>{{$d->nama}}</td>
                        <td>{{date('d F Y', strtotime($d->tanggal_lahir))}}</td>
                        <td>{{$d->jenis_kelamin}}</td>
                        <td width="150">
                            <a class="btn btn-sm btn-primary" id="editData" data-id="{{$d->id}}" data-pekerjaan="{{$d->pekerjaan}}" data-pendidikan="{{$d->pendidikan}}" data-status_perkawinan="{{$d->status_perkawinan}}" data-agama="{{$d->agama}}" data-gender="{{$d->jenis_kelamin}}" data-alamat="{{$d->alamat}}" data-tanggal="{{$d->tanggal_lahir}}" data-ktp="{{$d->no_ktp}}" data-nama="{{$d->nama}}" data-rm="{{$d->no_rm}}">Edit</a>
                            <a class="btn btn-sm btn-danger" id="deleteData" onclick="hapus('{{$d->id}}','{{$d->nama}}')">Hapus</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="7">Tidak ada data</td>
                    </tr>
                @endforelse

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
                        <form id="form" onsubmit="return save()">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <input id="id" name="id" type="number" hidden>
                                    <div class="mb-3">
                                        <label for="norm" class="form-label">Nomor Rekam Medis</label>
                                        <input type="text" class="form-control" id="norm" name="no_rm" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="noktp" class="form-label">Nomor KTP</label>
                                        <input type="text" class="form-control" id="noktp" name="no_ktp" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama pasien</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control " name="tanggal_lahir" id="tanggal_lahir"
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
                                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                                    </div>

                                    <label>Jenis Kelamin</label>
                                    <div class="form-check">
                                        <input style="padding: 0" class="form-check-input" type="radio" name="jenis_kelamin" id="Pria" value="Pria" checked required>
                                        <label class="form-check-label" for="Pria">
                                            Pria
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input style="padding: 0"  class="form-check-input" type="radio" name="jenis_kelamin" id="Wanita" value="Wanita" required>
                                        <label class="form-check-label" for="Wanita">
                                            Wanita
                                        </label>
                                    </div>

                                    <label class="mt-3">Status Perkawinan</label>
                                    <select class="form-select" name="status_perkawinan" id="status_perkawinan" required>
                                        <option value="" disabled selected>Pilih Status Perkawinan</option>
                                        <option value="Belum Kawin">Belum Kawin</option>
                                        <option value="Kawin">Kawin</option>
                                        <option value="Cerai Hidup">Cerai Hidup</option>
                                        <option value="Cerai Mati">Cerai Mati</option>
                                    </select>

                                    <label class="mt-3">Agama</label>
                                    <select class=" me-2 w-100 form-select" aria-label="select" id="agama" name="agama" required>
                                        <option value="" disabled selected>Pilih Agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Khatolik">Khatolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
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
            // $(this).datepicker({
            //     // format: "dd-mm-yyyy"
            // });
        });


        $(document).on('click', '#editData, #addData', function() {
            $('#tambahkategori #id').val($(this).data('id'))
            $('#tambahkategori #nama').val($(this).data('nama'))
            $('#tambahkategori #noktp').val($(this).data('ktp'))
            $('#tambahkategori #norm').val($(this).data('rm'))
            $('#tambahkategori #pendidikan').val($(this).data('pendidikan'))
            $('#tambahkategori #pekerjaan').val($(this).data('pekerjaan'))
            $('#tambahkategori #alamat').val($(this).data('alamat'))
            $('#tambahkategori #status_perkawinan').val($(this).data('status_perkawinan'))
            $('#tambahkategori #agama').val($(this).data('agama'))
            $('#tambahkategori #tanggal_lahir').val($(this).data('tanggal'))
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
            saveData(title+' data pasien', 'form');
            return false;
        }

        $('#form #tanggal_lahir').on('change',function () {
            console.log('adad')
            var tanggal = $('#tanggal_lahir').val();
            console.log(tanggal)
            console.log()
            var format = moment(tanggal).format('YYMM')+'-'+moment(tanggal).format('DD')+'01'+'-{{$count}}'
            $('#norm').val(format)
        })

        function hapus(a,b) {
            deleteData(b,window.location.pathname+'/'+a+'/delete')
            return false;
        }
    </script>

@endsection
