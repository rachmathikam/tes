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
        <form class="form-horizontal" action="{{ route('tahunpelajaran.update',$data->id) }}" method="POST" id="form_profile" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tahun_pelajarans">Tahun Pelajaran : <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" min="2013" name="tahun_pelajarans" max="2099"
                        step="1" value="{{ $data->tahun_pelajarans }}" />
                        <span class="text-danger" id="tahun_pelajaran"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pilih Semester: <span class="text-danger">*</span></label>
                        <select class="form-control" id="exampleFormControlSelect1" name="semester">
                            @foreach (['semester' => 'ganjil', 'genap'] as $data => $datas)
                                <option value="{{ $datas }}" @selected($datas)>{{ $datas }}
                                </option>
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
        </form>
    </div>
</div>
@endsection

