@extends('layouts.app')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Siswa</h6>
        </div>
        <div class="card-body mb-5">
                <a href="{{ route('siswa.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
            <br>
            <br>
            <form class="form-horizontal" method="POST" action="{{ route('siswa.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="NIS">NIS</label>
                        <input type="text" class="form-control" name="NIS" id="NIS">
                        @error('NIS')
                        <span class="text-danger">{{ $message }}</span>
                     @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                             @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                             @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                     @enderror
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir">
                                @error('tanggal_lahir')
                                <span class="text-danger">{{ $message }}</span>
                             @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir">
                                @error('tempat_lahir')
                                <span class="text-danger">{{ $message }}</span>
                             @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alamat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat"></textarea>
                        @error('alamat')
                        <span class="text-danger">{{ $message }}</span>
                     @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="kelas_id" class="form-label">Kelas</label>
                            <select name="kelas_id" id="kelas_id" width="100%" class="form-control">
                                <option>-- Pilih --</option>
                                @foreach ($kelas as $kelass)
                                    <option value="{{ $kelass->id }}" @selected($kelass->id)>
                                        {{ $kelass->romawi }} - {{ $kelass->code_kelas }}</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                      <div class="row">
                          <div class="col-4 mb-3">
                              <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                  <select class="custom-select" required name="jenis_kelamin">
                                    <option value="">pilih</option>
                                      @foreach(["jenis_kelamin" => "laki-laki","perempuan"] AS $siswa => $siswas)
                                      <option value="{{ $siswas }}" {{ old("jenis_kelamin", $siswas) == $siswas ? "selected" : "" }}>{{ $siswas }}</option>
                                      @endforeach
                                    </select>
                                    @error('jenis_kelamin')
                                    <span class="text-danger">{{ $message }}</span>
                                 @enderror
                                </div>
                            </div>
                        </div>
                      <div class="custom-file col-6">
                        <input type="file" class="custom-file-input" id="customFile" name="image" onchange="readURL(this);">
                        <label class="custom-file-label" for="customFile" >-- Pilih  Gambar --</label>
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

