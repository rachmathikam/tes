@section('css')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@extends('layouts.app')
    <!-- Page Heading -->
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
    </div>
    <div class="card-body">
        @if(Auth::user()->role_id == '1')
        <a href="{{ route('kelas.create') }}"><button class="btn btn-primary mb-2">Tambah Kelas</button></a>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kelas</th>
                        {{-- <th>Status</th> --}}
                        @if(Auth::user()->role_id == '1')
                        <th class="text-center">Action</th>
                        @endif
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kelas</th>
                        {{-- <th>Status</th> --}}
                        @if(Auth::user()->role_id == '1')
                        <th class="text-center">Action</th>
                        @endif
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($kelas as $kelass)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kelass->nama_kelas }} - {{ $kelass->kode_kelas}}</td>


                        @if(Auth::user()->role_id == '1')
                        <td class="text-center">

                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                            action="{{ route('kelas.destroy', $kelass->id) }}" method="POST">
                            @csrf
                            <a href="{{ route('kelas.show',$kelass->id) }}"><btn class="btn btn-xs btn-primary"><i class="fas fa-eye fa-md"></i></btn></a>
                            <a href="{{ route('kelas.edit',$kelass->id) }}"><btn class="btn btn-xs btn-warning"><i class="fas fa-edit fa-md"></i></btn></a>

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

    <!-- DataTales Example -->
@section('js')

<!-- Page level plugins -->
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
@endsection
