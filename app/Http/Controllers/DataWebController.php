<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use App\Models\Sekolah;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class DataWebController extends Controller
{
    public function index()
    {
        $title = 'Pemetaan';
        $kecamatan = Kecamatan::all();
        $allJenjang = Jenjang::all();
        $sekolah = Sekolah::with('jenjang')->get();

        return view('data_web', compact('title', 'kecamatan', 'allJenjang', 'sekolah'));
    }
}
