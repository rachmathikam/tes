<?php

namespace App\Http\Controllers;

use App\Models\NilaiPAS;
use App\Models\KelasSiswa;
use App\Models\NilaiHarian;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Mapel;
use DB;
use Illuminate\Http\Request;

class NilaiPASController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
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
            'nilai_pas'=>'required',
        ]);
        $input = $request->all();
        $check = NilaiHarian::join('kelas_siswas','kelas_siswas.id','nilai_harians.kelas_siswa_id')
                            ->join('mapels','mapels.id', '=', 'nilai_harians.mapels_id')
                            ->join('nilai_p_a_s','nilai_harians.id', '=', 'nilai_p_a_s.nilai_harian_id')
                            ->where('kelas_id',$input['kelas_id'])
                            ->where('siswa_id',$input['siswa_id'])
                            ->where('aspek', $input['aspek'])
                            ->where('semester',$input['semester'])
                            ->where('mapels_id',$input['mapel'])
                            ->count();

        if($check > 0){
            return redirect()->route('nilai_pas.show',$input['kelas_id'].':'.$input['siswa_id'])->with('error','nilai asepk dengan mapel dan semester ini telah ada');
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

                $pas = NilaiPAS::create([
                            'nilai_harian_id' => $harian->id,
                            'nilai_uas' => $input['nilai_pas'],
                            'semester'  => $input['semester'],
                            'pensan_guru' => $input['pesan_guru'],
                        ]);
             //    dd($guru);
                DB::commit();

                return redirect()->route('nilai_pas.show',$input['kelas_id'].':'.$input['siswa_id'])->with('success', 'berhasil menambahkan nilai');

            } catch (\Exceptions $exception) {
                DB::rollback();

                return redirect()->route('nilai_pas.show', $input['kelas_id'].':'.$input['siswa_id'])->with('failed', 'gagal menambahkan nilai');
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiPAS  $nilaiPAS
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data = explode(':', $id);
// dd($data);
        $kelas = KelasSiswa::where('kelas_id',$data[0])->where('siswa_id', $data[1])->first();
        // dd($kelas);
        $keyword = $request->keyword ;
        $nilai = NilaiHarian::join('nilai_p_a_s','nilai_harians.id', '=', 'nilai_p_a_s.nilai_harian_id')->where('kelas_siswa_id', $kelas->id)->where('semester','LIKE', '%'.$keyword.'%')->get();

        $mapel = Mapel::all();
        $siswa = Siswa::where('id',$kelas->siswa_id)->first();
        $kelas = Kelas::where('id',$kelas->kelas_id)->first();
        return view('pages.nilai_pas.show',compact('kelas','data','keyword','nilai','siswa','id','mapel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiPAS  $nilaiPAS
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiPAS $nilaiPAS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiPAS  $nilaiPAS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NilaiPAS $nilaiPAS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiPAS  $nilaiPAS
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nilai_harian = NilaiHarian::with('nilai_pas')->first();
        // dd($nilai_harian);
        $nilai = $nilai_harian->delete();

        if($nilai){
                return redirect()->route('nilai_pas.show',$id)->with('success','data berhasil di hapus');
        }else{
            return redirect()->route('nilai_pas.show',$id)->with('error','data gagal di hapus');
        }
    }
}
