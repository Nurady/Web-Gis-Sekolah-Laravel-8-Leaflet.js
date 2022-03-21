<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use App\Models\Web;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function __construct()
    {
        $this->Web = new Web();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Pemetaan',
            'kecamatan' => $this->Web->DataKecamatan(),
            'sekolah' => $this->Web->AllDataSekolah(),
            'jenjang' => $this->Web->DataJenjang(),
            'allJenjang' => Jenjang::all(),
        ];

        return view('v_web', $data);
    }

    public function kecamatan($id)
    {
        $kec = $this->Web->DetailKecamatan($id);

        $data = [
            'title' => 'Kecamatan'. ' ' . $kec->kecamatan,
            'kecamatan' => $this->Web->DataKecamatan(),
            'sekolah' => $this->Web->DataSekolah($id),
            'jenjang' => $this->Web->DataJenjang(),
            'kec' => $kec,
            'allJenjang' => Jenjang::all(),
        ];

        return view('v_kecamatan', $data);
    }

    public function jenjang($id)
    {
        
        $jenj = $this->Web->DetailJenjang($id);
  
        $data = [
            'title' => 'Jenjang'. ' ' . $jenj->jenjang,
            'kecamatan' => $this->Web->DataKecamatan(),
            'sekolah' => $this->Web->DataSekolahJenjang($id), 
            'jenjang' => $this->Web->DataJenjang(),
        ];

        return view('v_jenjang', $data);
    }

    public function detailsekolah($id)
    {
        $sekolah = $this->Web->DetailDataSekolah($id);     
           
        $data = [
            'title' => 'Detail'. ' ' . $sekolah->nama,
            'kecamatan' => $this->Web->DataKecamatan(),
            'jenjang' => $this->Web->DataJenjang(),
            'sekolah' => $sekolah,
        ];
        return view('v_detailsekolah', $data);
    }
}
