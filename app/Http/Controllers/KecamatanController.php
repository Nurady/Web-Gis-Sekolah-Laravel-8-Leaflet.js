<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function __construct()
    {
        $this->Kecamatan = new Kecamatan;
    }

    public function index()
    {
        $data = [
            'title' => 'Kecamatan',
            'kecamatan' => $this->Kecamatan->AllData(),
        ];

        return view('admin.kecamatan.v_index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Kecamatan',
        ];

        return view('admin.kecamatan.v_add', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kecamatan' => 'required',
            'warna' => 'required',
            'geojson' => 'required'
        ], [
            'kecamatan.required' => 'Wajib Diisikan !!!',
            'warna.required' => 'Wajib Diisikan !!!',
            'geojson.required' => 'Wajib Diisikan !!!',
        ]);

        $data = [
            'kecamatan' => $request->kecamatan,
            'warna' => $request->warna,
            'geojson' => $request->geojson,
        ];

        $this->Kecamatan->InsertData($data);

        return redirect()->route('kecamatan')->with('pesan', 'Data Kecamatan Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Kecamatan',
            'kecamatan' => $this->Kecamatan->DetailData($id),
        ];

        return view('admin.kecamatan.v_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kecamatan' => 'required',
            'warna' => 'required',
            'geojson' => 'required'
        ], [
            'kecamatan.required' => 'Wajib Diisikan !!!',
            'warna.required' => 'Wajib Diisikan !!!',
            'geojson.required' => 'Wajib Diisikan !!!',
        ]);

        $data = [
            'kecamatan' => $request->kecamatan,
            'warna' => $request->warna,
            'geojson' => $request->geojson,
        ];

        $this->Kecamatan->UpdateData($id, $data);

        return redirect()->route('kecamatan')->with('update', 'Berhasil Update Data Kecamatan');
    }

    public function delete($id)
    {
        $this->Kecamatan->DeleteData($id);

        return redirect()->route('kecamatan')->with('delete', 'Berhasil Menghapus Data Kecamatan');
    }
}
