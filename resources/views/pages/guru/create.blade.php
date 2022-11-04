@extends('layouts.app')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Guru</h6>
        </div>
        <div class="card-body mb-5">
            <a href="{{ route('guru.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
            <br>
            <br>
            <form class="form-horizontal" method="POST" action="{{ route('guru.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="NIP">NIP : <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="NIP" id="NIP">
                        @error('NIP')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Name : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email : <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password : <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" id="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                 <label for="password">Mengajar : <span class="text-danger">*</span></label>
                                <select class="form-control" name="mapels_id">
                                    @foreach ($guru as $gurus)
                                      <option value="{{ $gurus->id }}" {{ ( $gurus->id ) ? 'selected' : '' }}> {{ $gurus->mata_pelajaran }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir : <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir">
                                @error('tanggal_lahir')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir">
                                @error('tempat_lahir')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alamat : <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat"></textarea>
                        @error('alamat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-4 mb-3">
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin : <span class="text-danger">*</span></label>
                                <select class="custom-select" required name="jenis_kelamin">
                                    <option value="">pilih</option>
                                    @foreach (['jenis_kelamin' => 'laki-laki', 'perempuan'] as $guru => $gurus)
                                        <option value="{{ $gurus }}"
                                            {{ old('jenis_kelamin', $gurus) == $gurus ? 'selected' : '' }}>
                                            {{ $gurus }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_kelamin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telpone : <span class="text-danger">*</span></label>
                        <input type="no_telp" class="form-control" name="no_telp" id="no_telp">
                        @error('no_telp')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="custom-file col-6">
                        <input type="file" class="custom-file-input" id="customFile" name="image"
                            onchange="readURL(this);">
                        <label class="custom-file-label" for="customFile">-- Pilih Gambar -- : <span class="text-danger">*</span></label>
                        <img id="blah" class="mt-3" src="{{ asset('admin/img/undraw_profile.svg') }}"
                            style="width: 180px; margin-bottom:200px;">
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

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
