@extends('layouts.app')
    <!-- Page Heading -->
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pilih Siswa</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>NIS</th>
                        <th>Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-center">
                        <th>No</th>
                        <th>NIS</th>
                        <th>Name</th>

                        <th class="text-center">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $siswas)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $siswas->NIS }}</td>
                        <td>{{ $siswas->user->name }}</td>
                        <td class="text-center">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                            action="{{ route('nilai_harian.destroy', $siswas->id) }}" method="POST">
                            @csrf
                            <a href="{{ route('nilai.index', $siswas->id) }}"><btn class="btn btn-xs btn-primary "><i class="fas fa-file fa-md"></i></btn></a>

                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-xs"><i
                                class="fas fa-trash fa-md"></i></button>
                          </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

    <!-- DataTales Example -->

