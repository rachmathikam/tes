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
            // dd($request->all());
            $request->validate([
                    'siswa' =>'required',
                    'kelas_id' =>'required',
            ]);
            // dd($request->all());

            $input = $request->all();
            $check = KelasSiswa::where('kelas_id',$input['kelas_id'])->where('siswa_id',$input['siswa'])->count();

            if($check > 0){
                return redirect()->route('kelas_siswa.show',$input['kelas_id'])->with('error',' Siswa sudah ada.');
            }

            KelasSiswa::create([
                            'kelas_id' => $input['kelas_id'],
                            'siswa_id' => $input['siswa'],
                        ]);


                // multiple inputs controller
            // for($i = 0; $i < count($input['siswa']); $i++){
            //     if (count($input['siswa']) > 1) {
            //         if (count($input['siswa']) - 1 == $i) {
            //             if ($input['siswa'][$i] != $input['siswa'][$i-1]) {
            //                 KelasSiswa::create([
            //                     'kelas_id' => $input['kelas_id'],
            //                     'siswa_id' => $input['siswa'][$i],
            //                 ]);
            //             }else{
            //                 return redirect()->route('kelas_siswa.show',$input['kelas_id'])->with('error',' penambahan siswa sama.');
            //             }
            //         }else{
            //             if ($input['siswa'][$i] != $input['siswa'][$i+1]) {
            //                 KelasSiswa::create([
            //                     'kelas_id' => $input['kelas_id'],
            //                     'siswa_id' => $input['siswa'][$i],
            //                 ]);
            //             }else{
            //                 return redirect()->route('kelas_siswa.show',$input['kelas_id'])->with('error',' Siswa sudah ada.');
            //             }
            //         }
            //     }else{
            //         KelasSiswa::create([
            //             'kelas_id' => $input['kelas_id'],
            //             'siswa_id' => $input['siswa'][$i],
            //         ]);
            //     }
            // }


            return redirect()->route('kelas_siswa.show',$request['kelas_id'])->with('success','siswa berhasil di tambahkan');
            // $data = KelasSiswa::create($input);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KelasSiswa  $kelasSiswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tahun = TahunPelajaran::first();
        // dd($tahun);
        $siswas = Siswa::all();
        $data = kelas::with('siswa')->where('id',$id)->first();
        // dd($data);
        $siswa = [];
        foreach ($data->siswa as $item) {
            array_push($siswa, $item);
        }
        // dd($siswa);
        return view('pages.kelas_siswa.show', compact('tahun','data','siswa','siswas'));
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
