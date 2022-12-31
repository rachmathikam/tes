<?php

namespace App\Http\Controllers;

use App\Models\NilaiSiswa;
use App\Models\NilaiHarian;
use App\Models\TahunPelajaran;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Siswa;
use App\Models\NilaiPTS;
use Illuminate\Http\Request;
use DB;

class NilaiSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $tambah_kelas = Kelas::all();
        // dd($tambah_kelas->toArray());
        $kelas = Kelas::where('tahun_pelajaran_id', 'LIKE', '%'.$keyword.'%')->get();
        $tahun = TahunPelajaran::all();
        return view('pages.nilai_siswa.index',compact('tahun','keyword','kelas','tambah_kelas'));
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
       $request->validate([
            'kelas_id' => 'nullable',
            'tahun_pelajaran_id'=>'nullable',
            'siswa' => 'required',
            'status' => 'required',
       ]);

    $input =  $request->all();

    // $th_pelajaran = Kelas::with('tahun_pelajaran')->first();
    // dd($th_pelajaran->toArray());
    $check1 = KelasSiswa::join('kelas','kelas.id', '=','kelas_siswas.kelas_id')
                        ->where('tahun_pelajaran_id',$input['tahun_pelajaran_id'])
                        ->where('siswa_id',$input['siswa'])
                        ->first();
    // dd($check1);
    if(!is_null($check1)){
        return redirect()->route('nilai_siswa.show',$input['kelas_id'])->with('error','siswa sudah ada');

    }

    	$data = KelasSiswa::create([
            'kelas_id'    => $input['kelas_id'],
            'siswa_id'    => $input['siswa'],
            'status'      => $input['status']
        ]);

            return redirect()->route('nilai_siswa.show',$input['kelas_id'])->with('success','siswa berhasil di tambah');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiSiswa  $nilaiSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        // dd($id);
        $pilih_kelas = Kelas::all();
        $kelas = KelasSiswa::join('kelas','kelas.id', '=', 'kelas_siswas.kelas_id')
                        ->where('kelas_id',$id)->first();
        $datas = Kelas::where('id',$id)->first();
        // dd($datas);


        $data = kelas::with('siswa','tahun_pelajaran')->where('id',$id)->get();
        // dd($data);
        $siswa = [];
        foreach ($data as $kelas) {
            foreach ($kelas->siswa as $item) {
                array_push($siswa, $item);
            }
        }

            $keyword = $request->id;
            $data_kelas = Kelas::where('tahun_pelajaran_id', 'LIKE', '%'.$keyword.'%')
            ->orderBy('tahun_pelajaran_id','desc')
            ->orderByRaw("FIELD(nama_kelas , 'XI', 'VIII','VII') asc")
            ->get();
            // dd($data_kelas);

            $tambah_siswa = Siswa::all();

        return view('pages.nilai_siswa.show', compact('data','siswa','kelas','siswa','tambah_siswa','pilih_kelas','keyword','data_kelas','datas'));
    }


    public function tambahStore(Request $request)
    {

        $request->validate([

            'kelas_id' => 'required',
            'siswa' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        // dd($input);
        $check = KelasSiswa::where('kelas_id',$input['kelas_id'])->count();

        if($check > 0){
            return redirect()->back()->with('error','siswa sudah ada');
        }

        $data = KelasSiswa::create([
            'kelas_id'    => $input['kelas_id'],
            'siswa_id'    => $input['siswa'],
            'status'      => $input['status']
        ]);
        // dd($data);

        return redirect()->route('nilai_siswa.show',$input['kelas_id'])->with('success','siswa berhasil di tambah');



    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiSiswa  $nilaiSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiSiswa $nilaiSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiSiswa  $nilaiSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiSiswa  $nilaiSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = explode(':', $id);
        $kelas = KelasSiswa::where('kelas_id', $data[0])->where('siswa_id',$data[1])->first();

        $kelas->delete();
        return redirect()->route('nilai_siswa.show',$id)->with('success','siswa berhasil di hapus');

    }
}
