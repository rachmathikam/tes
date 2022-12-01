<?php

namespace App\Http\Controllers;

use App\Models\NilaiPTS;
use App\Models\NilaiHarian;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Siswa;
use App\Models\TahunPelajaran;
use Illuminate\Http\Request;

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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiPTS  $nilaiPTS
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = explode(':', $id);

        $kelas = KelasSiswa::where('kelas_id',$data[0])->where('siswa_id', $data[1])->first();
        // dd($kelas);
        $data = NilaiHarian::where('kelas_siswa_id', $kelas->id)->get();

        // dd($tahun);
        $siswa = Siswa::where('id',$kelas->siswa_id)->first();
        $kelas = Kelas::where('id',$kelas->kelas_id)->first();

    // dd($data);
        // dd($data->toArray());
        return view('pages.nilai_pts.show',compact('data','siswa','kelas'));
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
    public function update(Request $request, NilaiPTS $nilaiPTS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiPTS  $nilaiPTS
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiPTS $nilaiPTS)
    {
        //
    }
}
