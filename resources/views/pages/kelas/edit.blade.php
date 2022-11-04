@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Kelas</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Kelas {{ $data->romawi }} - {{ $data->code_kelas }}</h6>
    </div>
    <div class="card-body">
        <form class="form-horizontal" action="{{ route('kelas.update',$data->id) }}" method="POST" id="form_profile" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-12">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="romawi">Tempat Lahir : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="romawi" id="romawi" value="{{ $data->romawi }}">
                            <span class="text-danger" id="romawi_error"></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Pilih Kode Kelas :<span class="text-danger">*</label>
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
              <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
