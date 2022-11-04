@extends('layouts.app')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Siswa</h6>
        </div>
        <div class="card-body mb-5">
                <a href="{{ route('kelas.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
            <br>
            <br>
            <form class="form-horizontal" method="POST" action="{{ route('kelas.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="Romawi">Masukkan Inisial Romawi  : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="romawi" id="romawi">
                                @error('romawi')
                                <span class="text-danger">{{ $message }}</span>
                             @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Pilih Kode Kelas</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="code_kelas">
                                    @foreach ( ['code_kelas' => 'A', 'B','C','D'] AS $kelas => $kelass )
                                    <option value="{{ $kelass }}" @selected($kelass)>{{ $kelass
                                     }}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                    </div>
                      <br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
