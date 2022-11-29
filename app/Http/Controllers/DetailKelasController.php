<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\KelasMapel;



class DetailKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Kelas::all();
        $mapel = Mapel::all();
        return view('pages.detailkelas.create',compact('data','mapel'));
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
            "kelas_id" => 'required',
            "mapel_id" => 'required',
            // |unique:kelas_mapel,mapels_id

        ],
    );
        // dd($request);

        $input = $request->all();
        // dd($input);
        $check = KelasMapel::whereIn('mapels_id',$input['mapel_id'])->whereIn('kelas_id',$input['kelas_id'])->count();
        // dd($check);
        if($check > 0){
            return redirect()->route('detailkelas.create')->with('error','mata pelajaran di kelas ini sudah ada.');
        }

        for($i = 0; $i < count($input['mapel_id']); $i++){
            KelasMapel::create([
                'kelas_id' => $input['kelas_id'][$i],
                'mapels_id' => $input['mapel_id'][$i],
            ]);
        }
        if($input){

            return redirect()->route('kelas.index')->with('success','kelas mapel berhasil di tambah');
        }else{
            return redirect()->route('kelas.index')->with('error','kelas mapel ada yang sama');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
