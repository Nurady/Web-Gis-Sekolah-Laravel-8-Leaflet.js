<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Jenjang;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function __construct()
    {
        $this->Sekolah = new Sekolah();
        $this->Jenjang = new Jenjang();
        $this->Kecamatan = new Kecamatan();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Sekolah',
            // 'sekolah' => $this->Sekolah->AllData()
            'sekolah' => Sekolah::with(['jenjang', 'kecamatan'])->get(),
        ];
        
        return view('admin.sekolah.v_index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Sekolah',
            'jenjang' => $this->Jenjang->AllData(),
            'kecamatan' => $this->Kecamatan->AllData()
        ];

        return view('admin.sekolah.v_add', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'status' => 'required',
            'jenjang_id' => 'required',
            'kecamatan_id' => 'required',
            'alamat' => 'required',
            'foto' => 'required|mimes:jpg,jpeg,png|max:1024',
            'posisi' => 'required',
            'deskripsi' => 'required',
        ], [
            'nama.required' => 'Wajib !!!',
            'status.required' => 'Wajib !!!',
            'jenjang_id.required' => 'Wajib !!!',
            'kecamatan_id.required' => 'Wajib !!!',
            'alamat.required' => 'Wajib !!!',
            'foto.required' => 'Wajib !!!',
            'foto.mimes' => 'jpg,jpeg,png !!!',
            'foto.max' => 'Max 1024 KB !!!',
            'posisi.required' => 'Wajib !!!',
            'deskripsi.required' => 'Wajib !!!',
        ]);

        $file = $request->foto;
        $filename = $file ->getClientOriginalName();
        $file->move(public_path('foto'), $filename);

        $data = [
            'nama' => $request->nama,
            'status' => $request->status,
            'jenjang_id' => $request->jenjang_id,
            'kecamatan_id' => $request->kecamatan_id,
            'alamat' => $request->alamat,
            'foto' => $filename,
            'posisi' => $request->posisi,
            'deskripsi' => $request->deskripsi,
        ];

        $this->Sekolah->InsertData($data);

        return redirect()->route('sekolah')->with('create', 'Data Sekolah Berhasil Ditambahkan');
    }

    public function edit($id)
    {        
        $data = [
            'title' => 'Edit Data Sekolah',
            // 'sekolah' => $this->Sekolah->DetailData($id),
            'sekolah' => Sekolah::findOrFail($id),
            'jenjang' => $this->Jenjang->AllData(),
            'kecamatan' => $this->Kecamatan->AllData()
        ];

        return view('admin.sekolah.v_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'status' => 'required',
            'jenjang_id' => 'required',
            'kecamatan_id' => 'required',
            'alamat' => 'required',
            'foto' => 'mimes:jpg,jpeg,png|max:1024',
            'posisi' => 'required',
            'deskripsi' => 'required',
        ], [
            'nama.required' => 'Wajib !!!',
            'status.required' => 'Wajib !!!',
            'jenjang_id.required' => 'Wajib !!!',
            'kecamatan_id.required' => 'Wajib !!!',
            'alamat.required' => 'Wajib !!!',
            'foto.mimes' => 'jpg,jpeg,png !!!',
            'foto.max' => 'Max 1024 KB !!!',
            'posisi.required' => 'Wajib !!!',
            'deskripsi.required' => 'Wajib !!!',
        ]);

        if ($request->foto <> "")  {
            // $sekolah = $this->Sekolah->DetailData($id);
            // $sekolah = Sekolah::findOrFail($id);

            // if ($sekolah->foto <> "") {
            //     unlink(public_path('foto') . '/' . $sekolah->foto);
            // }           

            $file = $request->foto;
            $filename = $file ->getClientOriginalName();
            $file->move(public_path('foto'), $filename);
            
            $data = [
                'nama' => $request->nama,
                'status' => $request->status,
                'jenjang_id' => $request->jenjang_id,
                'kecamatan_id' => $request->kecamatan_id,
                'alamat' => $request->alamat,
                'foto' => $filename,
                'posisi' => $request->posisi,
                'deskripsi' => $request->deskripsi,
            ];
    
            $this->Sekolah->UpdateData($id, $data);       
        } else {
            $data = [
                'nama' => $request->nama,
                'status' => $request->status,
                'jenjang_id' => $request->jenjang_id,
                'kecamatan_id' => $request->kecamatan_id,
                'alamat' => $request->alamat,
                'posisi' => $request->posisi,
                'deskripsi' => $request->deskripsi,
            ];
    
            $this->Sekolah->UpdateData($id, $data);
        }

        return redirect()->route('sekolah')->with('update', 'Data Sekolah Berhasil Diupdate');
    }

    public function delete($id)
    {
        // $sekolah = $this->Sekolah->DetailData($id);
        $sekolah = Sekolah::findOrFail($id);
        
        if ($sekolah->foto <> "") {
            unlink(public_path('foto') . '/' . $sekolah->foto);
        }

        $this->Sekolah->DeleteData($id);

        return redirect()->route('sekolah')->with('delete', 'Berhasil Menghapus Data Sekolah');
    }
}
