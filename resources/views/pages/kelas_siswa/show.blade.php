@section('css')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@extends('layouts.app')
    <!-- Page Heading -->
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Kelas {{ $data->nama_kelas }} - {{ $data->kode_kelas }}</h6>
    </div>

    <div class="card-body">
        @if(Auth::user()->role_id == '1')
        {{-- multi input modal --}}
        {{-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
            Tambah Kelas Siswa
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas Siswa {{ $tahun->tahun_pelajarans }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <form action="{{ route('kelas_siswa.store') }}" method="POST">
                            @csrf
                            @method('POST')
                        <div class="row">
                          <table class="table table-bordered" id="orders">
                            <tr>
                              <th>Tambah Siswa</th>
                            </tr>
                            <tr>
                                <input type="hidden" class="form-control" name="kelas_id" value="{{ $data->id }}">
                              <td><select class="custom-select product_price" id="inlineFormCustomSelectPref" data-type="product_price"  name='siswa[]' for="1">
                                <option selected>Choose...</option>
                                @foreach ($siswas as $datas )
                                <option value="{{ $datas->id }}" @selected( $datas->id)>{{ $datas->user->name }}</option>
                                @endforeach
                              </select></td> <!-- purchase_cost -->
                              <td><button type="button" name="add" id="add" class="btn btn-success circle">+</button></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div> --}}
        {{-- end multi input modal --}}

        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
    Tambah Siswa
  </button>

  <!-- Modal -->
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
            <form action="{{ route('kelas_siswa.store') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" class="form-control" name="kelas_id" value="{{ $data->id }}">
                <label for="">Pilih Siswa</label>
                <select class="form-control" name="siswa">
                    <option value="">-- Pilih Siswa --</option>
                    @foreach ($siswas as $data)
                    <option value="{{$data->id}}">{{ $data->user->name }}</option>
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
        @endif()
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>

                        {{-- <th>Status</th> --}}
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>

                        {{-- <th>Status</th> --}}
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($siswa as $datas)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $datas->NIS }}</td>
                        <td>{{ $datas->user->name }}</td>
                        <td>{{ $datas->jenis_kelamin }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')

<!-- Page level plugins -->
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>

<script>


var rowCount = 0;

$('#add').click(function() {
    rowCount++;
    $('#orders').append('<tr id="row'+rowCount+'"><input type="text" class="form-control" name="kelas_id" hidden value="{{ $data->id }}"><td><select class="custom-select my-1 mr-sm-2 product_price" id="inlineFormCustomSelectPref" data-type="product_price"  name="siswa[]" for="1"><option selected>Choose...</option>@foreach($siswas as $datas)<option value="{{ $datas->id }}" @selected($datas->id)>{{ $datas->user->name }}</option>@endforeach</select></td><td><button type="button" name="remove" id="'+rowCount+'" class="btn btn-danger btn_remove cicle">-</button></td></tr>');
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
</script>
@endsection
    <!-- DataTales Example -->

