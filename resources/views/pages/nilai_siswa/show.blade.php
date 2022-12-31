@section('css')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection
@extends('layouts.app')
    <!-- Page Heading -->
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $kelas->tahun_pelajaran->tahun_pelajarans }} / {{ $kelas->nama_kelas }}-{{ $kelas->kode_kelas }} / Pilih Siswa</h6>
        <a href="{{ route('kelas.index') }}">
            <button class="btn btn-primary" style="margin-top:35px;" type="submit">
                <i class="fa-solid fa-arrow-left"></i> Kembali</button></a>
    </div>
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary mt-4 ml-4" data-toggle="modal" data-target="#exampleModal">
                Tambah Siswa
              </button>
              <button type="button" class="btn btn-primary mt-4 float-right mr-4" data-toggle="modal" data-target="#naik_kelas">
               Naik Kelas / Tetap Kelas
              </button>
        </div>
    </div>
    <div class="modal fade" id="naik_kelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Naik Kelas / Tetap Kelas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/nilai_siswa/tambahStore') }}" method="POST">
                    @csrf
                    @method('POST')
                    <label for="">Pilih Siswa</label>
                    <select class="form-control" name="siswa">
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($siswa as $siswas)
                        <option value="{{$siswas->id}}">{{ $siswas->user->name }}</option>
                        @endforeach
                    </select>
                    <label for="">Pilih Kelas</label>
                    <select class="form-control" name="kelas_id">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($data_kelas as $kelaz)
                        <option value="{{$kelaz->id}}">{{ $kelaz->tahun_pelajaran->tahun_pelajarans }} / {{ $kelaz->nama_kelas }} - {{ $kelaz->kode_kelas }} </option>
                        @endforeach
                        {{-- <input type="hidden" value="{{ $datas->tahun_pelajaran_id}}" name="tahun_pelajaran_id"> --}}
                    </select>
                    <label for="">Pilih Status Siswa</label>
                    <select class="form-control" name="status">
                        <option value="">-- Pilih Status --</option>
                        @foreach(["status" => "Proses belajar", "Naik Kelas","Tetap Kelas"] AS $status )
                        <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
          </div>
        </div>
      </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('nilai_siswa.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" class="form-control" name="kelas_id" value="{{ $kelas->id }}">
                    <input type="hidden" class="form-control" name="tahun_pelajaran_id" value="{{ $kelas->tahun_pelajaran_id }}">
                    <label for="">Pilih Siswa</label>
                    <select class="form-control" name="siswa">
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($tambah_siswa as $data)
                        <option value="{{$data->id}}">{{ $data->user->name }}</option>
                        @endforeach
                    </select>
                    <label for="">Pilih Status Siswa</label>
                    <select class="form-control" name="status">
                        <option value="">-- Pilih Status --</option>
                        @foreach(["status" => "Proses belajar", "Naik Kelas","Tetap Kelas"] AS $status )
                        <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
          </div>
        </div>
      </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Penilaian</th>




                        {{-- <th>Status</th> --}}
                            <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Penilaian</th>


                        <th class="text-center">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($siswa as $datas)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $datas->NIS }} </td>
                            <td>{{ $datas->user->name }} </td>
                            <td>{{ $datas->jenis_kelamin }}</td>
                            <td>
                                <div class="dropdown show">
                                    <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     Pilih Penilaian
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                      <a class="dropdown-item" href="{{ route('nilai_pts.show', $kelas->id.':'.$datas->id) }}">Penilaian PTS</a>
                                      <a class="dropdown-item" href="{{ route('nilai_pas.show', $kelas->id.':'.$datas->id) }}">Penilaian PAS</a>
                                    </div>
                                  </div>
                                </td>



                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('nilai_siswa.destroy',$kelas->id.':'.$datas->id) }}" method="POST">
                                    @csrf
                                    <a href="{{ route('nilai_siswa.edit', $datas->id) }}" style="text-decoration:none">
                                        <i class="fas fa-edit fa-sm  mr-1"></i>
                                    </a>
                                    @method('DELETE')
                                        <button type="submit" class="btn"> <i class="fas fa-trash fa-sm  mr-1"></i></button>

                                    </form>
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>

{{-- <script>


var rowCount = 0;

$('#add').click(function() {
    rowCount++;
    $('#orders').append('<tr id="row'+rowCount+'"><td><select class="custom-select my-1 mr-sm-2 product_price" id="inlineFormCustomSelectPref" data-type="product_price"  name="siswa[]" for="1"><option selected>Choose...</option>@foreach($siswas as $datas)<option value="{{ $datas->id }}" @selected($datas->id)>{{ $datas->user->name }}</option>@endforeach</select></td><td><button type="button" name="remove" id="'+rowCount+'" class="btn btn-danger btn_remove cicle">-</button></td></tr>');
});

// Add a generic event listener for any change on quantity or price classed inputs
$("#orders").on('input', 'input.quantity,input.product_price', function() {
  getTotalCost($(this).attr("for"));
});

$(document).on('click', '.btn_remove', function() {
  var button_id = $(this).attr('id');
  $('#row'+button_id+'').remove();
});

function getTotalCost(ind) {
  var qty = $('#quantity_'+ind).val();
  var price = $('#product_price_'+ind).val();
  var totNumber = (qty * price);
  var tot = totNumber.toFixed(2);
  $('#total_cost_'+ind).val(tot);
}

function calculateSubTotal () {
  var subtotal = 0;
  $('.total_cost').each(function() {
     subtotal += parseFloat($(this).val());
     subtotal = subtotal.toFixed(2);
  });
  $('#subtotal').val(subtotal.toFixed(2));
}
// Using a new index rather
</script> --}}
@endsection
    <!-- DataTales Example -->

