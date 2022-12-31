<?php

namespace App\Http\Controllers;

use App\Models\NilaiPTS;
use App\Models\NilaiHarian;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Siswa;
use App\Models\TahunPelajaran;
use App\Models\Mapel;
use Illuminate\Http\Request;
use DB;

class NilaiPTSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'nullable',
            'siswa_id' => 'nullable',
            'mapel' =>'required',
            'semester' => 'required',
            'aspek' => 'required',
            'nilai_h1' => 'required',
            'nilai_h2' => 'required',
            'nilai_h3' => 'required',
            'nilai_h4' => 'required',
            'nilai_rata2' => 'required',
            'pesan_guru'=>'required',
        ]);
        $input = $request->all();
        $check = NilaiHarian::join('kelas_siswas','kelas_siswas.id','nilai_harians.kelas_siswa_id')
                            ->join('mapels','mapels.id', '=', 'nilai_harians.mapels_id')
                            ->join('nilai_p_t_s','nilai_harians.id', '=', 'nilai_p_t_s.nilai_harian_id')
                            ->where('kelas_id',$input['kelas_id'])
                            ->where('siswa_id',$input['siswa_id'])
                            ->where('aspek', $input['aspek'])
                            ->where('semester',$input['semester'])
                            ->where('mapels_id',$input['mapel'])
                            ->count();

        if($check > 0){
            return redirect()->route('nilai_pts.show',$input['kelas_id'].':'.$input['siswa_id'])->with('error','nilai asepk dengan mapel dan semester ini telah ada');
        }
        //    dd($check > false);

        $nilai = [
            $input['nilai_h1'],
            $input['nilai_h2'],
            $input['nilai_h3'],
            $input['nilai_h4'],
        ];
            $rataRata = array_sum($nilai)/count($nilai);

            $kelas_siswa = KelasSiswa::where('kelas_id',$input['kelas_id'])->where('siswa_id',$input['siswa_id'])->first();

            DB::beginTransaction();
            try {
                $harian = NilaiHarian::create([
                            'kelas_siswa_id' => $kelas_siswa->id,
                            'mapels_id' => $input['mapel'],
                            'aspek'    => $input['aspek'],
                            'nilai_n1' => $input['nilai_h1'],
                            'nilai_n2' => $input['nilai_h2'],
                            'nilai_n3' => $input['nilai_h3'],
                            'nilai_n4' => $input['nilai_h4'],
                            'nilai_rata2' => $rataRata,
                        ]);

                $pts = NilaiPTS::create([
                            'nilai_harian_id' => $harian->id,
                            'semester'  => $input['semester'],
                            'nilai_pts' => $input['nilai_pts'],
                            'pensan_guru' => $input['pesan_guru'],
                        ]);
             //    dd($guru);
                DB::commit();

                return redirect()->route('nilai_pts.show',$input['kelas_id'].':'.$input['siswa_id'])->with('success', 'berhasil menambahkan nilai');

            } catch (\Exceptions $exception) {
                DB::rollback();

                return redirect()->route('nilai_pts.show', $input['kelas_id'].':'.$input['siswa_id'])->with('failed', 'gagal menambahkan nilai');
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiPTS  $nilaiPTS
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id)
    {

        $data = explode(':', $id);
// dd($data);
        $kelas = KelasSiswa::where('kelas_id',$data[0])->where('siswa_id', $data[1])->first();
        // dd($kelas);
        $keyword = $request->keyword ;
        $nilai = NilaiHarian::join('nilai_p_t_s','nilai_harians.id', '=', 'nilai_p_t_s.nilai_harian_id')->where('kelas_siswa_id', $kelas->id)->where('semester','LIKE', '%'.$keyword.'%')->get();
        // dd($nilai);


// dd($data->toArray());


        $mapel = Mapel::all();
        $siswa = Siswa::where('id',$kelas->siswa_id)->first();
        $kelas = Kelas::where('id',$kelas->kelas_id)->first();

    // dd($data);
        // dd($data->toArray());
        return view('pages.nilai_pts.show',compact('nilai','data','siswa','kelas','mapel','keyword','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiPTS  $nilaiPTS
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiPTS $nilaiPTS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiPTS  $nilaiPTS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
    //   dd($request->all());

      $request->validate([
        'kelas_id' => 'nullable',
        'siswa_id' => 'nullable',
        'mapel' =>'required',
        'semester' => 'required',
        'aspek' => 'required',
        'nilai_h1' => 'required',
        'nilai_h2' => 'required',
        'nilai_h3' => 'required',
        'nilai_h4' => 'required',
        'nilai_rata2' => 'required',
        'pesan_guru'=>'required',
      ]);

      $input = $request->all();
      $nilai = [
        $input['nilai_h1'],
        $input['nilai_h2'],
        $input['nilai_h3'],
        $input['nilai_h4'],
    ];
        $rataRata = array_sum($nilai)/count($nilai);

      $kelas_siswa = KelasSiswa::where('kelas_id',$input['kelas_id'])->where('siswa_id',$input['siswa_id'])->first();

      $nilai_harian = NilaiHarian::first();
    //   dd($nilai_harian);
      $nilai_pts = NilaiPTS::first();
    //   dd($nilai_harian);

        $nilai_harian->update([
            'kelas_siswa_id' => $kelas_siswa->id,
            'mapels_id'=> $input['mapel'],
            'aspek'    => $input['aspek'],
            'nilai_n1' => $input['nilai_h1'],
            'nilai_n2' => $input['nilai_h2'],
            'nilai_n3' => $input['nilai_h3'],
            'nilai_n4' => $input['nilai_h4'],
            'nilai_rata2' =>  $rataRata,
        ]);

        $nilai_pts->update([
            'nilai_harian_id' => $nilai_harian->id,
            'semester' => $input['semester'],
            'nilai_pts' => $input['nilai_pts'],
            'pensan_guru' => $input['pesan_guru'],
        ]);

        if($nilai_pts){
            return redirect()->route('nilai_pts.show',$id)->with('success','Data berhasil di update');
        }else{
            return redirect()->route('nilai_pts.show',$id)->with('error','Data gagal di update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiPTS  $nilaiPTS
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $nilai_harian = NilaiHarian::with('nilai_pts')->first();
        // dd($nilai_harian);
        $nilai = $nilai_harian->delete();




        if($nilai){
                return redirect()->route('nilai_pts.show',$id)->with('success','data berhasil di hapus');
        }else{
            return redirect()->route('nilai_pts.show',$id)->with('error','data gagal di hapus');
        }
    }
}
