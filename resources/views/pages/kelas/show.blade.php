@extends('layouts.app')
    <!-- Page Heading -->
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Mapel Kelas {{ $data->romawi }}-{{ $data->code_kelas }}</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Mapel</th>
                        {{-- <th>Status</th> --}}
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Mapel</th>
                        {{-- <th>Status</th> --}}
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($kelasmapel as $kelass)

                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kelass->mapel->mata_pelajaran }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
