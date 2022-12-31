<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\TahunPelajaran;
use App\Models\CodeKelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KelasController extends Controller
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
        $kelas = Kelas::where('tahun_pelajaran_id', 'LIKE', '%'.$keyword.'%')
            ->orderBy('tahun_pelajaran_id','desc')
            ->orderByRaw("FIELD(nama_kelas , 'VII', 'VIII','IX') asc")
            ->orderBy('kode_kelas','asc')
            ->get();
            // dd($kelas);


        $tahun = TahunPelajaran::all();
        return view('pages.kelas.index',compact('tahun','keyword','kelas','tambah_kelas'));
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
            'tahun_pelajaran_id' => 'required',
            'nama_kelas' =>'required',
            'kode_kelas' =>'required',
        ],
        [
            'tahun_pelajaran.required' => 'silahkan pilih tahun pelajaran',
            'nama_kelas.required' => 'silahkan isi nama kelas',
            'kode_kelas.required' => 'silahkan isi kode kelas',

        ]
    );
        // dd($request->toArray());
        $input = $request->all();

        $check = Kelas::where('tahun_pelajaran_id',$input['tahun_pelajaran_id'])->where('nama_kelas',$input['nama_kelas'])->where('kode_kelas',$input['kode_kelas'])->count();
        if($check > 0){
            return redirect()->route('kelas.index')->with('error','inisisal nama kelas '.$input['nama_kelas'].'/'.$input['kode_kelas'].' sudah ada');
        }
        $data = Kelas::create($input);
        $data->save();
        if($data){
            return redirect()->route('kelas.index')->with('success', 'Kelas berhasil di tambahkan');
        }else{
            return redirect()->route('kelas.index')->with('error', 'Kelas gagal ditambahkan');
        }

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

