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
        <form class="form-horizontal" action="{{ route('mapel.update',$data->id) }}" method="POST" id="form_profile" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Mata Pelajaran : <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="mata_pelajaran" id="email" value="{{ $data->mata_pelajaran }}">
                    <span class="text-danger" id="email_error"></span>
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

