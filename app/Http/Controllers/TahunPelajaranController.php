<?php

namespace App\Http\Controllers;

use App\Models\TahunPelajaran;
use Illuminate\Http\Request;

class TahunPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TahunPelajaran::all();
        // dd($data);
        return view('pages.tahunpelajaran.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = TahunPelajaran::all();
        return view('pages.tahunpelajaran.create',compact('data'));
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
            'tahun_pelajarans' =>'required',
            'is_active' =>'nullable',
        ]);



        $input = $request->all();
        // dd($input);
        if ($request->has('is_active')) {
            $input['is_active'] = 'active';
        }else{
            $input['is_active'] = 'inactive';
        }
        // dd($input);

        $check = TahunPelajaran::where('tahun_pelajarans',$input['tahun_pelajarans'])->count();
        if($check > 0){
            return redirect()->route('tahunpelajaran.create')->with('error','Inisisal Tahun Pelajaran '.$input['tahun_pelajarans'] .' sudah ada.');
        }

        $data = TahunPelajaran::create($input);

        if($data){
            return redirect()->route('tahunpelajaran.index')->with('success','Tahun Pelajaran berhasil di buat');
        }else{
            return redirect()->route('tahunpelajaran.create')->with('error','Tahun gagal berhasil di buat');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TahunPelajaran  $tahunPelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(TahunPelajaran $tahunPelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TahunPelajaran  $tahunPelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = TahunPelajaran::findOrfail($id);
        return view('pages.tahunPelajaran.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TahunPelajaran  $tahunPelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'tahun_pelajarans' => 'required',
            'semester' => 'required',
        ]);


        $input = $request->all();

        $check = TahunPelajaran::where('tahun_pelajarans',$input['tahun_pelajarans'])->where('semester',$input['semester'])->count();
        if($check > 0){
            return redirect()->route('tahunpelajaran.edit',$id)->with('error','Inisisal Tahun Pelajaran '.$input['tahun_pelajarans'].'/'.$input['semester']." ".'sudah ada.');
        }

        $data = TahunPelajaran::findOrfail($id);

        $data->update($input);
        if($data){
            return redirect()->route('tahunpelajaran.index')->with('success','Tahun Pelajaran berhasil di edit');
        }else{
            return redirect()->route('tahunpelajaran.edit')->with('error','Tahun Pelajaran gagal di edit');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TahunPelajaran  $tahunPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TahunPelajaran::findOrFail($id);
        $data->delete();
        if($data){
            return redirect()->route('tahunpelajaran.index')->with('success','Tahun Pelajaran berhasil di Hapus');
        }else{
            return redirect()->route('tahunpelajaran.create')->with('error','Tahun Pelajaran gagal di Hapus');
        }
    }
}
