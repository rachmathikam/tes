<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;
use DB;
class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $guru = Guru::all();
        // dd($guru->toArray());
        return view('pages.guru.index',compact('guru'));
    }

    public function changeStatus(Request $request)
    {
        $guru = Guru::find($request->user_id);
        $guru->status = $request->status;
        $guru->save();
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guru = Mapel::all();
        return view('pages.guru.create',compact('guru'));
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
            'NIP' =>'required',
            'name' =>'required',
            'email' => 'required',
            'password' => 'required',
            // 'status' => 'required',
            'mapels_id' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_telp' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
            'jenis_kelamin' => 'required',
       ],
       [
            'NIP.required'           => 'NIP wajib terisi.',
            'name.required'          => 'Nama wajib terisi.',
            'email.required'         => 'Email wajib terisi.',
            'password.required'      => 'Password wajib terisi.',
            'Alamat.required'        => 'Alamat wajib terisi.',
            'tempat_lahir.required'  => 'Tempat Lahir wajib terisi.',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib terisi.',
            'no_telp.required'       => 'Nomer HP wajib terisi.',
            'image.required'         => 'Gambar wajib terisi.',
            'mata_pelajaran.required'=> 'Mata Pelajaran wajib terisi.',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib terisi.',
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
                'role_id' => 2,
            ]);
        //    dd($user);
           $userid = User::get()->last();
        //    dd($userid);
           Guru::create(
               [
                   'NIP'  => $input['NIP'],
                   'tempat_lahir' => $input['tempat_lahir'],
                   'tanggal_lahir' => $input['tanggal_lahir'],
                   'jenis_kelamin' => $input['jenis_kelamin'],
                   'alamat' => $input['alamat'],
                   'no_telp' => $input['no_telp'],
                   'user_id' => $userid->id,
                   'mapels_id' => $input['mapels_id'],
                   'image' => $input['image'],
               ]
           );
        //    dd($guru);
           DB::commit();

           return redirect()->route('guru.index')->with('success', 'Data');

       } catch (\Exceptions $exception) {
           DB::rollback();

           return redirect()->route('guru.create')->with('failed', 'failed');
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $guru = Guru::findOrFail($id);
        return view('pages.guru.show',compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guru = Guru::find($id);
        return view('pages.guru.edit',compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            // 'user_id' => 'required',
            'NIP' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'confirmed',
            'status' => 'nullable',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_telp' => 'required',
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
        $data = Guru::findOrFail($id);

        $user = User::findOrfail($data->user_id);
        $user->update([
            'name'=> $input['name'],
            'password'=> $input['password'],
            'email'=> $input['email'],
        ]);

        $data->update([
            'status'=> 0,
            'alamat'=> $input['alamat'],
            'tempat_lahir'=> $input['tempat_lahir'],
            'tanggal_lahir'=> $input['tanggal_lahir'],
            'no_telp'=> $input['no_telp'],
            'image'=> $input['image'],
            'jenis_kelamin'=> $input['jenis_kelamin'],
        ]);
        // dd($data);

        return redirect()->route('guru.index')->with('success','data sucessfully edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $user = User::findOrFail($guru->user_id);
        // dd($user);
        $data = $user->delete();

        if($data){
           return redirect()->route('guru.index')->with('success','Data berhasil di delete');
        }else{
            return redirect()->route('guru.index')->with('error','Data gagal di delete');
        }
    }
}
