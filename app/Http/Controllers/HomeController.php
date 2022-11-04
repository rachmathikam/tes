<?php

namespace App\Http\Controllers;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Kelas;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $siswa = Siswa::count();
        $kelas = Kelas::count();
        $mapel = Mapel::count();
        return view('home',compact('siswa', 'kelas', 'mapel'));
    }
}
