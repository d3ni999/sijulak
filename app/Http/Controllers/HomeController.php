<?php

namespace App\Http\Controllers;

use App\Models\JadwalKegiatan;

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
        $tomorrow = date("Y-m-d", time() + 86400);

        $hari_ini = JadwalKegiatan::whereDate('waktu', '=', date('Y-m-d'))->get();
        $besok_hari = JadwalKegiatan::whereDate('waktu', '=', $tomorrow)->get();
        return view('index', [
            'hari_ini' => $hari_ini,
            'besok_hari' => $besok_hari,
        ]);
    }
}
