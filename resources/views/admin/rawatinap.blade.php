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
                        <th>Kamar</th>
                        <th>Status</th>
                        <th>Diagnosa Awal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                @forelse($data as $key => $d)
                    <tr>
                        <td width="20">{{ $key + 1 }}</td>
                        <td>{{ $d->no_reg }}</td>
                        <td>{{ $d->pasien->no_rm }}</td>
                        <td>{{ $d->pasien->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($d->tanggal_masuk)->isoFormat('LL, HH:mm') }}</td>
                        <td>{{ $d->kamar->nama_kamar }}</td>
                        <td></td>
                        <td>{{ $d->diagnosa_awal }}</td>
                        <td width="50">
                            <a class="btn btn-sm btn-warning" id="detailData" data-id="{{ $d->id }}"
                                href="/admin/rawatinap/{{ $d->id }}">Detail</a>
                            <a class="btn btn-sm btn-primary" id="editData" data-id="{{ $d->id }}"
                                data-penerimaan="{{ $d->penerimaan }}" data-diagnosa="{{ $d->diagnosa_awal }}"
                                data-hubpenanggungjawab="{{ $d->hubungan_penanggung_jawab }}"
                                data-penanggungjawab="{{ $d->penanggung_jawab }}"
                                data-tanggal="{{ $d->tanggal_masuk }}" data-kamar="{{ $d->kamar->id }}"
                                data-pasien="{{ $d->pasien->id }}">Edit</a>
                            <a class="btn btn-sm btn-danger" id="deleteData" data-id="{{ $d->id }}"
                                onclick="hapus('{{ $d->id }}','{{ $d->no_reg }}')">Hapus</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="9">Tidak ada data</td>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Rawat Inap</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form" onsubmit="return save()">
                            @csrf
                            <input id="id" name="id" type="number" hidden>

                            <label class="mt-3">Nama Pasien</label>
                            <select class=" me-2 w-100 form-control" aria-label="select" id="id_pasien" name="id_pasien">
                                <option value="" selected disabled>Pilih Pasien</option>
                                @foreach ($pasien as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>

                            <label class="mt-3">Kamar</label>
                            <select class=" me-2 w-100 form-control" aria-label="select" id="id_kamar" name="id_kamar">
                                <option value="" selected disabled>Pilih Kamar</option>
                                @foreach ($kamar as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_kamar }}</option>
                                @endforeach
                            </select>

                            <div class="mb-3 mt-3 ">
                                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                <input type="datetime-local" class="form-control " name="tanggal_masuk" id="tanggal_masuk"
                                    required>
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="penanggungjawab" class="form-label">Nama Penanggung Jawab</label>
                                <input type="text" class="form-control" id="penanggungjawab" name="penanggung_jawab">
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="hubpenanggungjawab" class="form-label">Hubungan Penanggung Jawab</label>
                                <input type="text" class="form-control" id="hubpenanggungjawab"
                                    name="hubungan_penanggung_jawab">
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="diagnosaawal" class="form-label">Diagnosa Awal</label>
                                <textarea id="diagnosaawal" name="diagnosa_awal" class="form-control"></textarea>
                            </div>

                            <label class="mt-3">Penerimaan</label>
                            <select class=" me-2 w-100 form-control" aria-label="select" id="penerimaan" name="penerimaan">
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
        $(document).on('click', ' #checkoutp', function() {
            $('#checkout').modal('show')
        });

        $(document).on('click', '#editData, #addData', function() {
            $('#tambahkategori #id').val($(this).data('id'))
            $('#tambahkategori #id_pasien').val($(this).data('pasien'))
            $('#tambahkategori #id_kamar').val($(this).data('kamar'))
            var tanggal = new Date($(this).data('tanggal'));
            tanggal.setMinutes(tanggal.getMinutes() - tanggal.getTimezoneOffset())
            if ($(this).data('id')) {
                tanggal = tanggal.toISOString().slice(0, 16)
            }
            $('#tambahkategori #tanggal_masuk').val(tanggal)
            $('#tambahkategori #penanggungjawab').val($(this).data('penanggungjawab'))
            $('#tambahkategori #hubpenanggungjawab').val($(this).data('hubpenanggungjawab'))
            $('#tambahkategori #diagnosaawal').val($(this).data('diagnosa'))
            $('#tambahkategori #penerimaan').val($(this).data('penerimaan'))
            $('#tambahkategori').modal('show')
        })

        function save() {
            var title = 'Tambah';
            if ($('#tambahkategori #id').val()) {
                title = 'Edit'
            }
            saveData(title + ' data', 'form');
            return false;
        }

        function after() {

        }

        function hapus(a, b) {
            deleteData(b, window.location.pathname + '/' + a + '/delete')
            return false;
        }
    </script>

@endsection
