<?php

namespace App\Http\Controllers;

use App\Models\NilaiHarian;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class NilaiHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Kelas::all();
        // dd($data->toArray());
        return view('pages.nilai_harian.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Kelas::all();
        return view('pages.nilai_harian.create',compact('data'));
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
     * @param  \App\Models\NilaiHarian  $nilaiHarian
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Siswa::where('kelas_id',$id)->get();
        // dd($data);
        return view('pages.nilai_harian.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiHarian  $nilaiHarian
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiHarian $nilaiHarian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiHarian  $nilaiHarian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NilaiHarian $nilaiHarian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiHarian  $nilaiHarian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = NilaiHarian::findOrFail($id);
        $data->delete();

        return redirect()->route('nilai_harian.index')->with('success','nilai berhasil di hapus');
    }
}
