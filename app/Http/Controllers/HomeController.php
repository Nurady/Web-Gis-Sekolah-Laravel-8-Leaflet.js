<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jenjang;
use App\Models\Sekolah;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        // return view('home');
        // $data = ['title' => 'Dashboard'];
        return view('v_home', [
            'title' => 'Dashboard',
            'totalKecamatan' => Kecamatan::count(),
            'totalSekolah' => Sekolah::count(),
            'totalJenjang' => Jenjang::count(),
            'totalUser' => User::count(),
        ]);
    }
}
