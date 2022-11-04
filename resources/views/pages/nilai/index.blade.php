@extends('layouts.app')
<!-- Page Heading -->
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
        </div>
        <div class="card-body">
            @if (Auth::user()->role_id == '1')
                <button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal"
                    data-target="#modalTambahBarang">Tambah Nilai</button>
            @endif

            <div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="modalTambahBarang"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Nilai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!--FORM TAMBAH BARANG-->
                            <form action="" method=" ">
                                <div class="form-group">
                                    <select class="custom-select my-1 mr-sm-2 quantity " id="inlineFormCustomSelectPref"
                                        name='mapel_id[]' for="1">
                                        <option selected>Choose...</option>
                                        @foreach ($mapel as $mapels)
                                            <option value="{{ $mapels->id }}" @selected($mapels->id)>
                                                {{ $mapels->mata_pelajaran }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Nilai Harian</label>
                                            <input type="text" class="form-control" id="addJumlahBarang" name="addJumlahBarang">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Nilai UTS</label>
                                            <input type="text" class="form-control" id="addJumlahBarang" name="addJumlahBarang">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Nilai UAS</label>
                                            <input type="text" class="form-control" id="addJumlahBarang" name="addJumlahBarang">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </form>
                            <!--END FORM TAMBAH BARANG-->
                        </div>
                    </div>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai Harian</th>
                            <th>Nilai UTS</th>
                            <th>Nilai UAS</th>
                            @if (Auth::user()->role_id == '1')
                                <th class="text-center">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai Harian</th>
                            <th>Nilai UTS</th>
                            <th>Nilai UAS</th>
                            @if (Auth::user()->role_id == '1')
                                <th class="text-center">Action</th>
                            @endif
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data as $nilai)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $nilai->mapel->mata_pelajaran }}</td>
                                <td>{{ $nilai->nilai_harian }}</td>
                                <td>{{ $nilai->nilai_uts }}</td>
                                <td>{{ $nilai->nilai_uas }}</td>



                                @if (Auth::user()->role_id == '1')
                                    <td class="text-center">

                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('nilai.destroy', $nilai->id) }}" method="POST">
                                            @csrf

                                            <a href="{{ route('kelas.edit', $nilai->id) }}">
                                                <btn class="btn btn-xs btn-primary"><i class="fas fa-edit fa-md"></i></btn>
                                            </a>

                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs"><i
                                                    class="fas fa-trash fa-md"></i></button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
