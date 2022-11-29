<?php

namespace App\Http\Controllers;

use App\Models\NilaiSiswa;
use App\Models\NilaiHarian;
use App\Models\TahunPelajaran;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

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

        // $kelas = KelasSiswa::with('kelas','siswa')->get();
        // dd($kelas->toArray());
        $kelas = Kelas::where('tahun_pelajaran_id', 'LIKE', '%'.$keyword.'%')->get();

        // dd($kelas);
        $tahun = TahunPelajaran::all();
        return view('pages.nilai_siswa.index',compact('tahun','keyword','kelas'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiSiswa  $nilaiSiswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $tahun = TahunPelajaran::first();
        // dd($tahun);
        $siswas = Siswa::all();
        $data = kelas::with('siswa','tahun_pelajaran')->where('id',$id)->get();
        // dd($data);
        $siswa = [];
        foreach ($data as $kelas) {
            foreach ($kelas->siswa as $item) {
                array_push($siswa, $item);
            }
        }
        // dd($siswa);
        return view('pages.nilai_siswa.show', compact('tahun','data','siswa','siswas'));
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
    public function update(Request $request, NilaiSiswa $nilaiSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiSiswa  $nilaiSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiSiswa $nilaiSiswa)
    {
        //
    }
}
