<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Siswa;
use App\Models\TahunPelajaran;

use Illuminate\Http\Request;

class KelasSiswaController extends Controller
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
        return view('pages.kelas_siswa.index',compact('tahun','keyword','kelas'));
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
     * @param  \App\Models\KelasSiswa  $kelasSiswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = Siswa::all();
        $data = kelas::with('siswa')->where('id',$id)->get();
        // dd($data);
        $siswa = [];
        foreach ($data as $kelas) {
            foreach ($kelas->siswa as $item) {
                array_push($siswa, $item);
            }
        }
        // dd($siswa);
        return view('pages.kelas_siswa.show', compact('data','siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KelasSiswa  $kelasSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(KelasSiswa $kelasSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KelasSiswa  $kelasSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KelasSiswa $kelasSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KelasSiswa  $kelasSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(KelasSiswa $kelasSiswa)
    {
        //
    }
}
