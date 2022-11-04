<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\CodeKelas;
use App\Models\KelasMapel;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::with('siswa')->get();
        // dd($kelas->toArray());
        return view('pages.kelas.index',compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Kelas::all();
        return view('pages.kelas.create',compact('data'));
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
            'romawi' =>'required',
            'code_kelas' =>'required',
        ]);
        // dd($request);
        $input = $request->all();

        $check = Kelas::where('romawi',$input['romawi'])->where('code_kelas',$input['code_kelas'])->count();
        if($check > 0){
            return redirect()->route('kelas.create')->with('error','inisisal Romawi '.$input['romawi'].'/'.$input['code_kelas'].' sudah ada');
        }
        $data = Kelas::create($input);
        $data->save();
        return redirect()->route('kelas.index')->with('success', 'Kelas has been deleted');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kelas::find($id);
        // dd($data);
        $kelasmapel = KelasMapel::where('kelas_id', $data->id)->with('kelas','mapel')->get();
        // dd($kelasmapel);
        return view('pages.kelas.show',compact('data','kelasmapel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Kelas::find($id);
        return view('pages.kelas.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'romawi' =>'required',
            'code_kelas' =>'required',
        ]);

        $input = $request->all();

        $check = Kelas::where('romawi',$input['romawi'])->where('code_kelas',$input['code_kelas'])->count();
        if($check > 0){
            return redirect()->route('kelas.create')->with('error','inisisal Romawi '.$input['romawi'].'/'.$input['code_kelas'].' sudah ada');
        }

        $kelas = Kelas::findOrFail($id);
        $kelas->update([
                'romawi' =>$input['romawi'],
                'code_kelas'=>$input['code_kelas'],
        ]);
        $kelas->save();

        if($kelas){
            return redirect()->route('kelas.index')->with('success','kelas berhasil di edit');
        }else{
            return redirect()->route('kelas.create')->with('error','kelas gagal di edit');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        // $kelasmapel = Kelasmapel::findorFail($kelas->kelas_id);
        // dd($kelasmapel);
        $data = $kelas->delete();

        if($data){
            return redirect()->route('kelas.index')->with('sucessfully', 'Kelas has been deleted');
        }
    }
}
