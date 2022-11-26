@extends('layouts.app')
@section('content')
    <!-- DataTales Example -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Kelas Mapel</h6>
        </div>
        <div class="col-md-12">
            <form action="{{ route('detailkelas.store') }}" method="POST">
                @csrf
                @method('POST')
            <div class="row">
              <table class="table table-bordered" id="orders">
                <tr>
                  <th>Kelas</th>
                  <th>Mata Pelajaran</th>
                  <th>Tambah</th>
                </tr>
                <tr>
                  <td><select class="custom-select my-1 mr-sm-2 product_price" id="inlineFormCustomSelectPref" data-type="product_price"  name='kelas_id[]' for="1">
                    <option selected>Choose...</option>
                    @foreach ($data as $datas )
                    <option value="{{ $datas->id }}" @selected( $datas->id)>{{ $datas->nama_kelas }} - {{$datas->kode_kelas  }}</option>
                    @endforeach
                  </select></td> <!-- purchase_cost -->
                  <td><select class="custom-select my-1 mr-sm-2 quantity " id="inlineFormCustomSelectPref" name='mapel_id[]' for="1">
                    <option selected>Choose...</option>
                    @foreach ($mapel as $mapels )
                    <option value="{{ $mapels->id }}" @selected($mapels->id)>{{ $mapels->mata_pelajaran }}</option>
                    @endforeach

                  </select></td>
                  <td><button type="button" name="add" id="add" class="btn btn-success circle">+</button></td>
                </tr>
              </table>
            </div>
          </div>

          <div class="line line-dashed line-lg pull-in" style="clear: both;"></div>

          <input type="submit" class="btn btn-primary col-2" value="Submit">
        </form>

    </div>

    <script>
        var rowCount = 0;

$('#add').click(function() {
    rowCount++;
    $('#orders').append('<tr id="row'+rowCount+'"><td><select class="custom-select my-1 mr-sm-2 product_price" id="inlineFormCustomSelectPref" data-type="product_price"  name="kelas_id[]" for="1"><option selected>Choose...</option>@foreach($data as $datas)<option value="{{ $datas->id }}" @selected($datas->id)>{{ $datas->nama_kelas }} - {{ $datas->kode_kelas }}</option>@endforeach</select></td><td><select class="custom-select my-1 mr-sm-2 quantity" id="inlineFormCustomSelectPref" name="mapel_id[]" for="1"><option selected>Choose...</option>@foreach($mapel as $mapels)<option value="{{ $mapels->id }}" @selected($mapels->id)>{{ $mapels->mata_pelajaran }}</option>@endforeach</select></td><td><button type="button" name="remove" id="'+rowCount+'" class="btn btn-danger btn_remove cicle">-</button></td></tr>');
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
// Using a new index rather than your global variable i


    </script>
@endsection
