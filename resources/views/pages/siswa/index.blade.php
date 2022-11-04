@extends('layouts.app')
    <!-- Page Heading -->
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('siswa.create') }}"><button class="btn btn-primary mb-2">Tambah Siswa</button></a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>NIS</th>
                        <th>Name</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-center">
                        <th>No</th>
                        <th>NIS</th>
                        <th>Name</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $siswas)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $siswas->NIS }}</td>
                        <td>{{ $siswas->user->name }}</td>
                        <td>{{ $siswas->alamat }}</td>
                        <td>{{ $siswas->jenis_kelamin }}</td>
                        <td class="text-center">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" data-id="{{$siswas->id}}"
                                data-toggle="toggle" data-on="Active" data-off="InActive" {{ $siswas->status ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customSwitch1"></label>
                              </div>
                        </td>
                        <td class="text-center">

                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                            action="{{ route('siswa.destroy', $siswas->id) }}" method="POST">
                            @csrf
                            <a href="{{ route('siswa.show', $siswas->id) }}"><btn class="btn btn-xs btn-primary "><i class="fas fa-eye fa-md"></i></btn></a>
                            <a href="{{ route('siswa.edit',$siswas->id) }}"><btn class="btn btn-xs btn-warning"><i class="fas fa-edit fa-md"></i></btn></a>

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

