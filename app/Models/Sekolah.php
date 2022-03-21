<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sekolah extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function AllData()
    {
        return DB::table('sekolahs')
                ->join('jenjangs', 'jenjangs.id', '=', 'sekolahs.jenjang_id')
                ->join('kecamatans', 'kecamatans.id', '=', 'sekolahs.kecamatan_id')
                ->get();
    }

    public function InsertData($data) 
    {
        DB::table('sekolahs')->insert($data);
    }

    public function DetailData($id)
    {
        return DB::table('sekolahs')
                ->join('jenjangs', 'jenjangs.id', '=', 'sekolahs.jenjang_id')
                ->join('kecamatans', 'kecamatans.id', '=', 'sekolahs.kecamatan_id')
                ->where('sekolahs.id', $id)
                ->first();
    }

    public function UpdateData($id, $data)
    {
        DB::table('sekolahs')->where('id', $id)->update($data);
    }

    public function DeleteData($id)
    {
        DB::table('sekolahs')->where('id', $id)->delete();
    }

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
