@extends('layouts.app')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Tahun Pelajaran</h6>
        </div>
        <div class="card-body mb-5">
            <a href="{{ route('tahunpelajaran.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
            <br>
            <br>
            <form class="form-horizontal" method="POST" action="{{ route('tahunpelajaran.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tahun_pelajarans">Tahun Pelajaran</label>
                            <input class="form-control" type="number" min="2013" name="tahun_pelajarans" max="2099"
                                step="1" value="2016" />
                            @error('tahun_pelajarans')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Semester</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="semester">
                                @foreach (['semester' => 'ganjil', 'genap'] as $data => $datas)
                                    <option value="{{ $datas }}" @selected($datas)>{{ $datas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
