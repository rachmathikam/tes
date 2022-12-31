@section('css')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@extends('layouts.app')
<!-- Page Heading -->
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pilih Kelas</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <form action="{{ route('kelas.index') }}" method="GET">
                        <label for="status_payment">Filter By Tahun Pelajaran : </label>
                        <select name="keyword" id="status_payment" class="form-control mt-1">
                            <option value="{{ $keyword }}">-- Pilih Tahun Pelajaran --</option>
                            @foreach ($tahun as $tahuns)
                                <option value="{{ $tahuns->id }}">{{ $tahuns->tahun_pelajarans }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary" style="margin-top:35px;" type="submit"><i
                            class="fas fa-fw fa-search"></i></button></a>
                </div>
                </form>
            </div>
            <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
    Tambah Kelas
  </button>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('kelas.store') }}" method="POST">
                @method('POST')
                @csrf
          <div class="row">
            <label for="">Tahun Pelajaran</label>
                <select name="tahun_pelajaran_id" id="status_payment" class="form-control mt-1">
                    <option value="">-- Pilih Tahun Pelajaran --</option>
                    @foreach ($tahun as $tahuns)
                        <option value="{{ $tahuns->id }}">{{ $tahuns->tahun_pelajarans }}</option>
                    @endforeach
                </select>
            <div class="form-group mt-3 ">
                <label for="exampleInputPassword1">Nama Kelas</label>
                <input type="text" class="form-control"  placeholder="Nama Kelas" name="nama_kelas" @error('nama_kelas') is-invalid @enderror>
                @error('nama_kelas')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
              </div>
              <div class="form-group mt-3 ml-3">
                <label for="exampleInputPassword1">Kode Kelas</label>
                <input type="text" class="form-control"  placeholder="Kode Kelas" name="kode_kelas" @error('kode_kelas') is-invalid @enderror>
                @error('kode_kelas')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
              </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah Kelas</button>
        </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Tahun Pelajaran</th>
                            <th>Kelas</th>


                            {{-- <th>Status</th> --}}
                                <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Tahun Pelajaran</th>
                            <th>Kelas</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($kelas as $datas)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $datas->tahun_pelajaran->tahun_pelajarans }} </td>
                                <td>{{ $datas->nama_kelas }} - {{ $datas->kode_kelas }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('nilai_siswa.show', $datas->id) }}" style="text-decoration:none">
                                            <i class="fa-solid fa-arrow-right mr-1"></i>
                                        </a>
                                        <a href="{{ route('nilai_siswa.edit', $datas->id) }}" style="text-decoration:none">
                                            <i class="fas fa-edit fa-sm  mr-1"></i>
                                        </a>
                                        <a href="{{ route('nilai_siswa.destroy', $datas->id) }}" style="text-decoration:none">
                                            <i class="fas fa-trash fa-sm  mr-1"></i>
                                        </a>
                                    </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')

<!-- Page level plugins -->
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
@endsection
<!-- DataTales Example -->
