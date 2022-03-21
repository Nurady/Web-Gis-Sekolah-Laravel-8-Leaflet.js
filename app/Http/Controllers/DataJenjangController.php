<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use App\Models\Sekolah;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class DataJenjangController extends Controller
{
    public function data_jenjang($id)
    {
       $jenjangRow = Jenjang::with('sekolahs')->findOrFail($id);
       
       $title = 'Data Jenjang' . ' ' . $jenjangRow->jenjang;
       $kecamatan = Kecamatan::all();
       $jenjang = Jenjang::all();
       $allJenjang = Jenjang::all();
       
       return view('data_jenjang', compact('jenjangRow', 'title', 'kecamatan', 'jenjang', 'allJenjang')); 
    }

    public function data_jenjang_detailsekolah($id)
    {
        $kecamatan = Kecamatan::all();
        $jenjang = Jenjang::all();
        $allJenjang = Jenjang::all();

        $jenjangRow = Jenjang::with('sekolahs')->findOrFail($id);
        $detailSekolah = $jenjangRow->sekolahs;
        
        $detailDataSekolah = Sekolah::findOrFail($id);
        $title = 'Data Sekolah' . ' ' . $detailDataSekolah->nama;

        return view('data_detailsekolah', compact('detailSekolah', 'detailDataSekolah', 'title', 'kecamatan', 'jenjang','allJenjang'));
    }
}
