<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function AllData()
    {
        return DB::table('kecamatans')->get();
    }

    public function InsertData($data) 
    {
        DB::table('kecamatans')->insert($data);
    }

    public function DetailData($id)
    {
        return DB::table('kecamatans')
                ->where('id', $id)
                ->first();
    }

    public function UpdateData($id, $data)
    {
        DB::table('kecamatans')->where('id', $id)->update($data);
    }

    public function DeleteData($id)
    {
        DB::table('kecamatans')->where('id', $id)->delete();
    }

    public function sekolahs()
    {
        return $this->hasMany(Sekolah::class);
    }
}
