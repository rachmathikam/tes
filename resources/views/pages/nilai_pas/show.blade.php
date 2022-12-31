@section('css')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@extends('layouts.app')
<!-- Page Heading -->
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $kelas->tahun_pelajaran->tahun_pelajarans }} / {{ $kelas->nama_kelas }}-{{ $kelas->kode_kelas }} / {{ $siswa->user->name }} </h6>
            <a href="{{ route('nilai_siswa.show',$id) }}">
            <button class="btn btn-primary" style="margin-top:35px;" type="submit">
                <i class="fa-solid fa-arrow-left"></i> Kembali</button></a>
        </div>

        <div class="card-body">
            <div class="row mb-5">
                <div class="col-md-3">

                    <form action="{{ route('nilai_pts.show',$id) }}" method="GET">
                        <label for="status_payment">Filter By Semester : </label>
                        <select name="keyword" id="status_payment" class="form-control mt-">
                            <option value="">-- Pilih Semester --</option>
                             @foreach (['semester' => 'ganjil','genap'] AS $semester )
                             <option value="{{ $semester }}">{{ $semester }}</option>
                             @endforeach


                            {{-- @foreach ($tahun as $tahuns)
                            @endforeach --}}
                        </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary" style="margin-top:35px;" type="submit">
                        <i class="fas fa-fw fa-search"></i></button></a>
                </div>
                </form>
            </div>

            <button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal" data-target="#exampleModal">
               Tambah Nilai
          </button>
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai {{ $siswa->user->name }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('nilai_pas.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Mata Pelajaran:</label>
                        <select name="mapel" id="" class="custom-select">
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @foreach ($mapel as $mapels)
                            <option value="{{ $mapels->id }}">{{ $mapels->mata_pelajaran }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="status_payment">pilih Semester : </label>
                    <select name="semester" id="status_payment" class="form-control mb-2">
                        <option >-- Pilih Semester --</option>
                         @foreach (['semester' => 'ganjil','genap'] AS $semester )
                         <option value="{{ $semester }}">{{ $semester }}</option>
                         @endforeach
                    </select>
                    <label for="status_payment">pilih aspek : </label>
                    <select name="aspek" id="status_payment" class="form-control mb-2">
                        <option >-- Pilih aspek --</option>
                         @foreach (['apsek' => 'pengetahuan','keterampilan','bacaan','hafalan'] AS $aspek )
                         <option value="{{ $aspek }}">{{ $aspek }}</option>
                         @endforeach
                    </select>
                        <input type="hidden" value="{{ $data[0] }}" name="kelas_id">
                        <input type="hidden" value="{{ $data[1] }}" name="siswa_id">

                        <p id="physics">
                          Nilai Harian:
                          <input type="number" class="col-2 nilai" name="nilai_h1">
                          <input type="number" class="col-2 nilai"  name="nilai_h2">
                          <input type="number" class="col-2 nilai" name="nilai_h3">
                          <input type="number" class="col-2 nilai" name="nilai_h4">
                          <input id="nilai_rata2" class="col-2" readonly name="nilai_rata2">
                        </p>
                        <label for="">Nilai PAS: &nbsp;&nbsp;&nbsp;</label>
                        <input type="number" class="col-2" name="nilai_pas">



                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Pesan Guru</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="pesan_guru"></textarea>
                      </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <button class="btn btn-success float-right mb-3" type="button" data-toggle="modal" data-target="#exampleModalLong">
            + Excel
          </button>
          <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Tambah Nilai dengan Excel</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="">
                      <input type="file" class="mb-3">
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Tambah</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai Harian</th>
                            <th>Nilai UTS</th>
                            <th>Aspek</th>
                            <th>Pesan Guru</th>
                            <th>Semester</th>

                            {{-- <th>Status</th> --}}
                                <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai Harian</th>
                            <th>Nilai UTS</th>
                            <th>Aspek</th>
                            <th>Pesan Guru</th>
                            <th>semester</th>

                            {{-- <th>Status</th> --}}
                                <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($nilai as $datas)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $datas->mapel->mata_pelajaran }} </td>
                                <td>{{ $datas->nilai_rata2 }}</td>
                                <td>{{ $datas->nilai_uas }}</td>
                                <td>{{ $datas->aspek }}</td>
                                <td>{{ $datas->pensan_guru }}</td>
                                <td>{{ $datas->semester }}</td>
                                {{-- <td class="text-center">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" data-id="{{$mapels->id}}"
                                data-toggle="toggle" data-on="Active" data-off="InActive" {{ $mapels->status ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customSwitch1"></label>
                              </div>
                        </td> --}}

                                    <td class="text-center">
                                      <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                      action="{{ route('nilai_pas.destroy', $id) }}" method="POST">
                                      <button type="button" class="btn btn-warning" id="edit" data-toggle="modal"
                                         data-mapel="{{ $datas->mapels_id }}"
                                         data-mapel1="{{ $datas->mapel->mata_pelajaran }}"
                                         data-semester="{{ $datas->semester }}"
                                         data-aspek="{{ $datas->aspek }}"
                                         data-nilai_h1="{{ $datas->nilai_n1 }}"
                                         data-nilai_h2="{{ $datas->nilai_n2 }}"
                                         data-nilai_h3="{{ $datas->nilai_n3 }}"
                                         data-nilai_h4="{{ $datas->nilai_n4 }}"
                                         data-nilai_rata2="{{ $datas->nilai_rata2 }}"
                                         data-nilai_pts="{{ $datas->nilai_pts }}"
                                         data-pesan_guru="{{ $datas->pensan_guru }}"
                                         data-target="#edit">
                                        <i class="fas fa-fw fa-edit"></i>
                                      </button>

                                      <!-- The Modal -->


                                    </div>

                                      @csrf

                                          @method('DELETE')
                                          <button class="btn btn-xs btn-danger" type="submit"><i class="fas fa-trash fa-sm"></i>
                                          </button>
                                        </form>
                                      </td>
                                      <div class="modal" id="edit">
                                        <div class="modal-dialog modal-lg">
                                          <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Edit Nilai</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form action="{{ route('nilai_pts.update',$id) }}" method="POST">
                                                  @csrf
                                                  @method('PUT')
                                                  <input type="hidden" id ="kelas" value="{{ $data[0] }}" name="kelas_id">
                                                  <input type="hidden" id="siswa" value="{{ $data[1] }}" name="siswa_id">
                                                  <label for="">Mata Pelajaran :</label>
                                                  <input type="text" class="form-control" readonly id="mapel1">
                                                  <input type="hidden" class="form-control" id="mapel"  name="mapel">
                                                  <label for="">semester :</label>
                                                  <input type="text" class="form-control" readonly id="semester"  name="semester">
                                                  <label for="">aspek :</label>
                                                  <input type="text" class="form-control mb-3" readonly id="aspek"  name="aspek">

                                                  <p id="physics">
                                                    Nilai Harian:
                                                    <input type="number" class="col-2 nilai_edit" id="nilai_h1" name="nilai_h1">
                                                    <input type="number" class="col-2 nilai_edit" id="nilai_h2" name="nilai_h2">
                                                    <input type="number" class="col-2 nilai_edit" id="nilai_h3" name="nilai_h3">
                                                    <input type="number" class="col-2 nilai_edit" id="nilai_h4" name="nilai_h4">

                                                  </p>
                                                  <label for="">Nilai PTS: &nbsp;&nbsp;&nbsp;</label>
                                                  <input type="number" class="col-2" id="nilai_pts" name="nilai_pts">



                                                <div class="form-group">
                                                  <label for="exampleFormControlTextarea1">Pesan Guru</label>
                                                  <textarea class="form-control" id="pesan_guru" rows="3" name="pesan_guru"></textarea>
                                                </div>
                                              </div>

                                              <!-- Modal footer -->
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                              </form>
                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>

                                          </div>
                                        </div>
                                      </div>
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
  var numInput = $('.nilai');
//   console.log(numInput);

function calcAvg() {
  var sum = 0;
  // add the current val of each input field to the sum variable
  numInput.each(function() {
    sum += Number($(this).val());
    });
    // set the avg to the #result input field
    $('#nilai_rata2').val(sum / numInput.length);
};

  // run the calcAvg function everytime the input changes
numInput.change(calcAvg);


$('#edit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var mapel = button.data('mapel');
        var semester = button.data('semester');
        var aspek = button.data('aspek');
        var nilai_h1 = button.data('nilai_h1');
        var nilai_h2 = button.data('nilai_h2');
        var nilai_h3 = button.data('nilai_h3');
        var nilai_h4 = button.data('nilai_h4');
        var nilai_rata2 = button.data('nilai_rata2');
        var nilai_pts = button.data('nilai_pts');
        var pesan_guru = button.data('pesan_guru');
        var mapel1 = button.data('mapel1');

    // console.log(button);
        var modal = $(this)
        modal.find('.modal-body #mapel').val(mapel)
        modal.find('.modal-body #semester').val(semester)
        modal.find('.modal-body #aspek').val(aspek)
        modal.find('.modal-body #nilai_h1').val(nilai_h1)
        modal.find('.modal-body #nilai_h2').val(nilai_h2)
        modal.find('.modal-body #nilai_h3').val(nilai_h3)
        modal.find('.modal-body #nilai_h4').val(nilai_h4)
        modal.find('.modal-body #nilai_rata2_edit').val(nilai_rata2)
        modal.find('.modal-body #nilai_pts').val(nilai_pts)
        modal.find('.modal-body #pesan_guru').val(pesan_guru)
        modal.find('.modal-body #mapel1').val(mapel1)


});




// modal edit form

</script>
@endsection
<!-- DataTales Example -->
