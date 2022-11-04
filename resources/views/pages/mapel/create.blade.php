@extends('layouts.app')
@section('content')
    <!-- DataTales Example -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Siswa</h6>
        </div>
        <div class="card-body mb-5">
            <a href="{{ route('mapel.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
            <br>
            <br>
            <form class="form-horizontal" method="POST" action="{{ route('mapel.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="Romawi">Mata Pelajaran : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="mata_pelajaran" id="mata_pelajaran">
                            @error('mata_pelajaran')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <br>
                </div>
                <div class="form-group ml-1">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>

            </form>
        </div>
    </div>
@endsection
