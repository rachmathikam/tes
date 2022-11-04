@extends('layouts.app')
    <!-- Page Heading -->
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pilih Kelas </h6>
    </div>
    <div class="card-body">
        @if(Auth::user()->role_id == '1')
        @endif()
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>Kelas</th>
                        {{-- <th>Status</th> --}}
                        @if(Auth::user()->role_id == '1')
                        <th class="text-center">Action</th>
                        @endif
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>Kelas</th>
                        {{-- <th>Status</th> --}}
                         @if(Auth::user()->role_id == '1')
                        <th class="text-center">Action</th>
                        @endif
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $kelas)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kelas->romawi }} - {{ $kelas->code_kelas }}</td>


                        {{-- <td class="text-center">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" data-id="{{$mapels->id}}"
                                data-toggle="toggle" data-on="Active" data-off="InActive" {{ $nilais->status ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customSwitch1"></label>
                              </div>
                        </td> --}}
                        @if(Auth::user()->role_id == '1')
                        <td class="text-center">
                            <a href="{{ route('nilai_harian.show', $kelas->id) }}"><btn class="btn btn-xs btn-primary "><i class="fas fa-edit fa-md"></i></btn></a>
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

