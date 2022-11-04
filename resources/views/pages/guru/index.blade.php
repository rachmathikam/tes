@extends('layouts.app')
    <!-- Page Heading -->
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('guru.create') }}"><button class="btn btn-primary mb-2">Tambah Guru</button></a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>NIP</th>
                        <th>Name</th>
                        <th>Alamat</th>
                        <th>Mengajar</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-center">
                        <th>No</th>
                        <th>NIP</th>
                        <th>Name</th>
                        <th>Alamat</th>
                        <th>Mengajar</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($guru as $gurus)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $gurus->NIP }}</td>
                        <td>{{ $gurus->user->name }}</td>
                        <td>{{ $gurus->alamat }}</td>
                        <td>{{ $gurus->mapel->mata_pelajaran }}</td>
                        <td class="text-center">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" data-id="{{$gurus->id}}"
                                data-toggle="toggle" data-on="Active" data-off="InActive" {{ $gurus->status ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customSwitch1"></label>
                              </div>
                        </td>
                        <td class="text-center">

                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                            action="{{ route('guru.destroy', $gurus->id) }}" method="POST">
                            @csrf
                            <a href="{{ route('guru.show', $gurus->id) }}"><btn class="btn btn-xs btn-primary "><i class="fas fa-eye fa-md"></i></btn></a>
                            <a href="{{ route('guru.edit',$gurus->id) }}"><btn class="btn btn-xs btn-warning"><i class="fas fa-edit fa-md"></i></btn></a>

                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-xs"><i
                                class="fas fa-trash fa-md"></i></button>
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
<script type="text/javascript">
    // $(document).ready(function() {
    //     $('#guru_table').DataTable({
    //         processing: true,
    //         serverside: true,
    //         ajax: {
    //             url: "{{ route('guru.index') }}",
    //             type: 'GET'
    //         },
    //         responsive: true,
    //         columns: [
    //             {
    //                 data: 'DT_RowIndex',
    //             },
    //             {
    //                 data: 'NIP',
    //             },
    //             {
    //                 data: 'name',
    //             },
    //             {
    //                 data: 'action',
    //             },
    //         ]
    //     })
    // });
    // function deleteItem(e) {
    //     let id = e.getAttribute('data-id');
    //     let name = e.getAttribute('data-name');
    //     const swalWithBootstrapButtons = Swal.mixin({
    //         customClass: {
    //             confirmButton: 'btn btn-success',
    //             cancelButton: 'btn btn-danger'
    //         },
    //         buttonsStyling: true
    //     });
    //     swalWithBootstrapButtons.fire({
    //         title: 'Are you sure?',
    //         text: "Do you want to delete " + name + "?",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'Yes, delete it!',
    //         cancelButtonText: 'No, cancel!',
    //         reverseButtons: true
    //     }).then((result) => {
    //         if (result.value) {
    //             if (result.isConfirmed) {
    //                 $.ajax({
    //                     type: 'POST',
    //                     url: "guru/" + id,
    //                     data: {
    //                         "_token": "{{ csrf_token() }}",
    //                         "_method": 'DELETE',
    //                     },
    //                     success: function(data) {
    //                         if (data.success) {
    //                             toastr.success(name + ' has been deleted.')
    //                             var oTable = $('#guru_table').DataTable(); //inialisasi datatable
    //                             oTable.ajax.reload();
    //                         }else{
    //                             toastr.error(data.message)
    //                         }
    //                     }
    //                 });
    //             }
    //         } else if (
    //             result.dismiss === Swal.DismissReason.cancel
    //         ) {
    //             swal.fire(
    //                 'Cancelled',
    //                 'Data is not deleted',
    //                 'error'
    //             )
    //         }
    //     });
    // }

    $(function() {
    $('.custom-control-input').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script>
    <!-- DataTales Example -->

