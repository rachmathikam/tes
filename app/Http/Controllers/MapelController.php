<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\TahunPelajaran;
use App\Models\MapelAspek;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Mapel::with('aspek')->get();

        // dd($data);
        return view('pages.mapel.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $tahun_pelajaran = TahunPelajaran::all();
        return view('pages.mapel.create');

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
            'mata_pelajaran' =>'required',
        ],
        [
            'mata_pelajaran.required' => 'Mata Pelajaran harus di isi',
        ]);

        $input = $request->all();
        $check = Mapel::where('mata_pelajaran',$input['mata_pelajaran'])->count();
        if($check > 0){
            return redirect()->route('mapel.create')->with('error','inisisal Mata Pelajaran '.$input['mata_pelajaran'].'/'.' sudah ada');
        }
        $data = Mapel::create($input);
        $data->save();

        return redirect()->route('mapel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $data = Mapel::find($id);
       return view('pages.mapel.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Mapel::find($id);
        return view('pages.mapel.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'mata_pelajaran' =>'required',
        ]);
        // dd($request->all());

        $input = $request->all();
        $check = Mapel::where('mata_pelajaran',$input['mata_pelajaran'])->count();
        if($check > 0){
            return redirect()->route('mapel.edit',$id)->with('error','inisisal Mata Pelajaran '.$input['mata_pelajaran'].'/'.' sudah ada');
        }
        $data = Mapel::findorFail($id);
        $data->update([
            'mata_pelajaran' => $input['mata_pelajaran']
        ]);
        // dd($data->toArray());
        if($input){
            return redirect()->route('mapel.index');
        }else{
            return redirect()->route('mapel.create');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Mapel::findOrFail($id);
        $data->delete();

        if($data){
            return redirect()->route('mapel.index');
        }else{
            return redirect()->route('mapel.index');
        }
    }
}
