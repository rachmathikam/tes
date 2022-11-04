@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Profile</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Profile Edit</h6>
    </div>
    <div class="card-body">
        <form class="form-horizontal" action="{{ route('siswa.update',$data->id) }}" method="POST" id="form_profile" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-12">
                <div class="form-group">
                    <div class="form-group">
                        <label for="NIS">NIS  : <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="NIS" id="NIS" value="{{ $data->NIS }}">

                        <span class="text-danger" id="full_name_error"></span>
                    </div>
                    <label for="name">name : <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $data->user->name }}">

                    <span class="text-danger" id="name_error"></span>
                </div>
                <div class="form-group">
                    <label for="email">Email : <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ $data->user->email }}">
                    <span class="text-danger" id="email_error"></span>
                </div>
                <div class="form-group">
                    <label for="passwod">password : <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="passwod" id="passwod" value="{{ $data->user->password }}">
                    <span class="text-danger" id="password_error"></span>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ $data->tempat_lahir }}">
                            <span class="text-danger" id="tempat_lahir_error"></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir : <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ $data->tanggal_lahir }}">
                            <span class="text-danger" id="tanggal_lahir_error"></span>
                        </div>
                    </div>
                </div>
                <div class="pb-2 pt-2">
                    <hr style="border: 1px solid">
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Alamat : <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat">{{ $data->alamat }}</textarea>
                    <span class="text-danger" id="alamat_error"></span>
                </div>
              <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <label for="tanggal_lahir">Jenis Kelamin : <span class="text-danger">*</span></label>
                        <select class="custom-select" required name="jenis_kelamin">
                            @foreach(["jenis_kelamin" => "laki-laki","perempuan"] AS $data => $siswa)
                            <option value="{{ $siswa }}" {{ old("jenis_kelamin", $siswa) == $siswa ? "selected" : "" }}>{{ $siswa }}</option>
                            @endforeach
                        </select>
                      </div>
                </div>
              </div>
              <hr class=" mb-3">
              <div class="custom-file col-6">
                <input type="file" class="custom-file-input" id="customFile" onchange="readURL(this);" name="image">
                <label class="custom-file-label" for="customFile">-- Pilih  Gambar --</label>
                <img id="blah" class="mt-3" src="{{ asset('admin/img/undraw_profile.svg') }}" style="width: 180px; margin-bottom:200px;" >
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
<script type="text/javascript">

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#blah').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
    </script>
@endsection
