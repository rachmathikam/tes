@section('css')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@extends('layouts.app')
<!-- Page Heading -->
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $kelas->tahun_pelajaran->tahun_pelajarans }} / {{ $kelas->nama_kelas }}-{{ $kelas->kode_kelas }} {{ $siswa->user->name }} </h6>
        </div>
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-md-3">

                    <form action="{{ route('nilai_pts.show',$kelas->id) }}" method="GET">
                        <label for="status_payment">Filter By Semester : </label>
                        <select name="keyword" id="status_payment" class="form-control mt-1">
                            <option value="">-- Pilih Semester --</option>
                            <option value="1">Ganjil</option>
                            <option value="2">Genap</option>

                            {{-- @foreach ($tahun as $tahuns)
                            @endforeach --}}
                        </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary" style="margin-top:35px;" type="submit"><i
                            class="fas fa-fw fa-search"></i></button></a>
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
                  <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('nilai_pts.store') }}" method="POST">
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

                        <p id="physics">
                          Nilai Harian:
                          <input type="number" class="col-2 nilai" name="nilai_h1">
                          <input type="number" class="col-2 nilai"  name="nilai_h2">
                          <input type="number" class="col-2 nilai" name="nilai_h3">
                          <input type="number" class="col-2 nilai" name="nilai_h4">
                          <input id="physicsAverage" class="col-2" disabled>
                        </p>
                        <div class="hideen">
                            <p id="history" hidden>
                                History:
                                <input type="number" hidden>
                                <input type="number" hidden>
                                <input type="number" hidden>
                                <output id="historyAverage" hidden></output>
                            </p>
                        </div>
                        <button type="button" class="btn btn-primary" id="calculator">lihat</button>

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

            <button class="btn btn-success mb-3 float-right">+ Excel</button>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Tahun Pelajaran</th>
                            <th>Nilai Harian</th>
                            <th>Nilai UTS</th>
                            <th>Aspek</th>
                            <th>Pesan Guru</th>
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

                            {{-- <th>Status</th> --}}
                                <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data as $datas)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $datas->mapel->mata_pelajaran }} </td>
                                <td>{{ $datas->nilai_rata2 }}</td>
                                <td>{{ $datas->nilai_pts->nilai_pts }}</td>
                                <td>{{ $datas->aspek }}</td>
                                <td>{{ $datas->nilai_pts->pensan_guru }}</td>
                                {{-- <td class="text-center">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" data-id="{{$mapels->id}}"
                                data-toggle="toggle" data-on="Active" data-off="InActive" {{ $mapels->status ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customSwitch1"></label>
                              </div>
                        </td> --}}
                                    <td class="text-center">
                                        <a href="{{ route('nilai_pts.edit', $datas->id) }}">
                                            <btn class="btn btn-xs btn-warning "><i class="fas fa-edit fa-sm"></i>
                                            </btn>
                                        </a>
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

<!-- Page level plugins -->
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>

<script>
 document.getElementById('calculator').addEventListener('click', function() {
  var physicsTests = document.getElementById('physics').getElementsByClassName('nilai'),
    historyTests = document.getElementById('history').getElementsByTagName('input'),
    physicsTestsCount = 0,
    historyTestsCount = 0,
    physicsAverage = document.getElementById('physicsAverage'),
    historyAverage = document.getElementById('historyAverage'),
    i;
  for (i = 0; i < physicsTests.length; i++) {
    if (physicsTests[i].value) {
      physicsTestsCount++;
    }
    if (!physicsTestsCount) {
      physicsAverage.value = 'Silahkan Isi';
    } else {
      physicsAverage.value = (Number(physicsTests[0].value) + Number(physicsTests[1].value) + Number(physicsTests[2].value)
      + Number(physicsTests[3].value)) / physicsTestsCount;
    }
  }
  for (i = 0; i < historyTests.length; i++) {
    if (historyTests[i].value) {
      historyTestsCount++;
    }
    if (!historyTestsCount) {
      historyAverage.value = 'No assessment made!';
    } else {
      historyAverage.value = (Number(historyTests[0].value) + Number(historyTests[1].value) + Number(historyTests[2].value)) / historyTestsCount;
    }
  }
});
</script>
@endsection
<!-- DataTales Example -->
