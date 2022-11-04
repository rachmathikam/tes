@extends('layouts.app')
    <!-- Page Heading -->
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Mata Pelajaran</h6>
    </div>
    <div class="card-body">
        @if(Auth::user()->role_id == '1')
        <a href="{{ route('mapel.create') }}"><button class="btn btn-primary mb-2">Tambah Mata Pelajaran</button></a>
        @endif()
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>Mata Pelajaran</th>
                        {{-- <th>Status</th> --}}
                        @if(Auth::user()->role_id == '1')
                        <th class="text-center">Action</th>
                        @endif
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>Mata Pelajaran</th>
                        {{-- <th>Status</th> --}}
                         @if(Auth::user()->role_id == '1')
                        <th class="text-center">Action</th>
                        @endif
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $mapels)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mapels->mata_pelajaran }}</td>
                        {{-- <td class="text-center">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" data-id="{{$mapels->id}}"
                                data-toggle="toggle" data-on="Active" data-off="InActive" {{ $mapels->status ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customSwitch1"></label>
                              </div>
                        </td> --}}
                        @if(Auth::user()->role_id == '1')
                        <td class="text-center">

                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                            action="{{ route('mapel.destroy', $mapels->id) }}" method="POST">
                            @csrf
                            {{-- <a href="{{ route('mapel.show', $mapels->id) }}"><btn class="btn btn-xs btn-primary "><i class="fas fa-eye fa-md"></i></btn></a> --}}
                            <a href="{{ route('mapel.edit',$mapels->id) }}"><btn class="btn btn-xs btn-warning"><i class="fas fa-edit fa-md"></i></btn></a>

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

