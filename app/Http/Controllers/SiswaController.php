<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Hash;
use Illuminate\Http\Request;
use DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Siswa::all();
       return view('pages.siswa.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request){
        Excel::import(new SiswaImport,
                      $request->file('file')->store('files'));
        return redirect()->route('siswa.index')->with('success','data import excel berhasil');
    }


    public function create()
    {
        $kelas = Kelas::all();
        // dd($kelas);
        return view('pages.siswa.create',compact('kelas'));
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
            'NIS' =>'required',
            'name' =>'required',
            'email' => 'required',
            'password' => 'required',
            // 'status' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
            'jenis_kelamin' => 'required',
            'kelas_id' => 'required',
       ],
       [
        'NIP.required'           => 'NIP wajib terisi.',
        'name.required'          => 'Nama wajib terisi.',
        'email.required'         => 'Email wajib terisi.',
        'password.required'      => 'Password wajib terisi.',
        'Alamat.required'        => 'Alamat wajib terisi.',
        'tempat_lahir.required'  => 'Tempat Lahir wajib terisi.',
        'tanggal_lahir.required' => 'Tanggal Lahir wajib terisi.',
        'image.required'         => 'Gambar wajib terisi.',
        'jenis_kelamin.required' => 'Jenis Kelamin wajib terisi.',
        'kelas.required'         => 'Kelas wajib terisi.',
        ]
    );
    //    dd($request->toArray());
       $input = $request->all();
       if ($request->file('image')) {
           $file = $request->file('image');
           $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
           $file->move('image/avatar', $nama_file);
           $input['image'] = $nama_file;
       }else{
           unset($input['image']);
       }


       DB::beginTransaction();
       try {
          User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => bcrypt($input['password']),
                'role_id' => 3,
            ]);
        //    dd($user);
           $userid = User::get()->last();
        //    dd($userid);
           Siswa::create(
               [
                   'NIS'  => $input['NIS'],
                   'tempat_lahir' => $input['tempat_lahir'],
                   'tanggal_lahir' => $input['tanggal_lahir'],
                   'jenis_kelamin' => $input['jenis_kelamin'],
                   'alamat' => $input['alamat'],
                   'user_id' => $userid->id,
                   'image' => $input['image'],
                   'kelas_id'=>$input['kelas_id'],
               ]
           );
        //    dd($guru);
           DB::commit();

           return redirect()->route('siswa.index')->with('success', 'Siswa Successfully Added');

       } catch (\Exceptions $exception) {
           DB::rollback();

           return redirect()->route('siswa.create')->with('failed', 'failed');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Siswa::find($id);
        return view('pages.siswa.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Siswa::findOrFail($id);
        return view('pages.siswa.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // dd($request->all());
        $request->validate([
            // 'user_id' => 'required',
            'NIS' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'confirmed',
            'status' => 'nullable',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
            'jenis_kelamin' => 'required',
        ]);
        $input = $request->all();
        // dd($input);
            $input['password'] = Hash::make($request->password);

        if ($request->file('image')) {
            $file = $request->file('image');
            $nama_file = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move('image/avatar', $nama_file);
            $input['image'] = $nama_file;
        }else{
            unset($input['image']);
        }
        $data = Siswa::findOrFail($id);

        $user = User::findOrfail($data->user_id);
        $user->update([
            'name'=> $input['name'],
            'password'=> $input['password'],
            'email'=> $input['email'],
        ]);

        $data->update([
            'NIS' => $input['NIS'],
            'status'=> 0,
            'alamat'=> $input['alamat'],
            'tempat_lahir'=> $input['tempat_lahir'],
            'tanggal_lahir'=> $input['tanggal_lahir'],
            'image'=> $input['image'],
            'jenis_kelamin'=> $input['jenis_kelamin'],
        ]);
        // dd($data);
        if($data){
            return redirect()->route('siswa.index')->with('success', 'siswa berhasil di edit');
        }else{
            return redirect()->route('siswa.index')->with('failed', 'siswa gagal di edit');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Siswa::findOrFail($id);
        $user = User::find($data->user_id);
        $siswa = $user->delete();

        if($siswa){
            return redirect()->route('siswa.index')->with('success', 'siswa berhasil di delete');
        }else{
            return redirect()->route('siswa.index')->with('failed', 'siswa gagal di delete');
        }
    }
}
