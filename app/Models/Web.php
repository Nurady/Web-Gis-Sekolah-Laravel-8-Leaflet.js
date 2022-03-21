<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Web extends Model
{
    use HasFactory;

    public function DataKecamatan()
    {
        return DB::table('kecamatans')->get();
    }

    public function DataJenjang()
    {
        return DB::table('jenjangs')->get();
    }

    public function DetailJenjang($id)
    {
        return DB::table('jenjangs')
                ->where('id', $id)
                ->first();
    }

    public function DataSekolahJenjang($id)
    {
        return DB::table('sekolahs')
                ->join('jenjangs', 'jenjangs.id', '=', 'sekolahs.jenjang_id')
                ->join('kecamatans', 'kecamatans.id', '=', 'sekolahs.kecamatan_id')
                ->where('sekolahs.jenjang_id', $id)
                ->get();
    }

    public function DetailKecamatan($id)
    {
        return DB::table('kecamatans')
                ->where('id', $id)
                ->first();
    }

    public function DataSekolah($id)
    {
        return DB::table('sekolahs')
                ->join('jenjangs', 'jenjangs.id', '=', 'sekolahs.jenjang_id')
                ->join('kecamatans', 'kecamatans.id', '=', 'sekolahs.kecamatan_id')
                ->where('sekolahs.kecamatan_id', $id)
                ->get();
    }

    public function AllDataSekolah()
    {
        return DB::table('sekolahs')
                ->join('jenjangs', 'jenjangs.id', '=', 'sekolahs.jenjang_id')
                ->join('kecamatans', 'kecamatans.id', '=', 'sekolahs.kecamatan_id')
                ->get();
    }

    public function DetailDataSekolah($id)
    {
        return DB::table('sekolahs')
                ->join('jenjangs', 'jenjangs.id', '=', 'sekolahs.jenjang_id')
                ->join('kecamatans', 'kecamatans.id', '=', 'sekolahs.kecamatan_id')
                ->where('sekolahs.id', $id)
                ->first();
    }
}
