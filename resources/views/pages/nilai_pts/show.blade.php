@section('css')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@extends('layouts.app')
<!-- Page Heading -->
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $kelas->tahun_pelajaran->tahun_pelajarans }} / {{ $kelas->nama_kelas }}-{{ $kelas->kode_kelas }} {{ $siswa->user->name }} </h6>
        </div>
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-md-6">

                    {{-- <form action="{{ route('kelas_siswa.index') }}" method="GET">
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
                </form> --}}

            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Tahun Pelajaran</th>
                            <th>Nilai Harian</th>
                            <th>Nilai UTS</th>
                            <th>Aspek</th>
                            <th>Pesan Guru</th>
                            {{-- <th>Status</th> --}}
                                <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai Harian</th>
                            <th>Nilai UTS</th>
                            <th>Aspek</th>
                            <th>Pesan Guru</th>

                            {{-- <th>Status</th> --}}
                                <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data as $datas)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $datas->mapel->mata_pelajaran }} </td>
                                <td>{{ $datas->nilai_rata2 }}</td>
                                <td>{{ $datas->nilai_pts->nilai_pts }}</td>
                                <td>{{ $datas->aspek }}</td>
                                <td>{{ $datas->nilai_pts->pensan_guru }}</td>
                                {{-- <td class="text-center">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" data-id="{{$mapels->id}}"
                                data-toggle="toggle" data-on="Active" data-off="InActive" {{ $mapels->status ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customSwitch1"></label>
                              </div>
                        </td> --}}
                                    <td class="text-center">
                                        <a href="{{ route('nilai_pts.edit', $datas->id) }}">
                                            <btn class="btn btn-xs btn-warning "><i class="fas fa-edit fa-sm"></i>
                                            </btn>
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
