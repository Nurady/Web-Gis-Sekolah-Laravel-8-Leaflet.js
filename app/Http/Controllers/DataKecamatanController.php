<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use App\Models\Sekolah;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class DataKecamatanController extends Controller
{
    public function data_kecamatan($id)
    {
        $kecamatanRow = Kecamatan::with('sekolahs')->findOrFail($id);
        $jenjangRow = Jenjang::with('sekolahs')->findOrFail($id);
       
        $title = 'Pemetaan Kecamatan' . ' ' . $kecamatanRow->kecamatan;
        $kecamatan = Kecamatan::all();
        $allJenjang = Jenjang::all();
        $sekolah = Sekolah::all();
        $kec = Kecamatan::findOrFail($id);
        $jenjang = Jenjang::all();
        
        return view('data_kecamatan', compact('kecamatanRow', 'jenjangRow', 'title', 'kecamatan', 'allJenjang', 'jenjang', 'sekolah', 'kec')); 
    }
}
