<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenjangController extends Controller
{
    public function __construct()
    {
        $this->Jenjang = new Jenjang();
    }

    public function index()
    {
        $data = [
            'title' => 'Jenjang',
            'jenjang' => $this->Jenjang->AllData()
        ];
        return view('admin.jenjang.v_index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Jenjang',
        ];

        return view('admin.jenjang.v_add', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenjang' => 'required',
            'icon' => 'required|mimes:jpg,jpeg,png|max:1024',
        ], [
            'jenjang.required' => 'Wajib Di isikan !!!',
            'icon.required' => 'Wajib Di isikan !!!',
            'icon.mimes' => 'jpg,jpeg,png!!!',
            'icon.max' => 'Max 1024 KB !!!',
        ]);

        $file = $request->icon;
        $filename = time(). ".". $file ->getClientOriginalName();
        $file->move(public_path('icon'), $filename);

        $data = [
            'jenjang' => $request->jenjang,
            'icon' => $filename,
        ];

        $this->Jenjang->InsertData($data);

        return redirect()->route('jenjang')->with('create', 'Data Jenjang Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Jenjang',
            'jenjang' => $this->Jenjang->DetailData($id),
        ];

        return view('admin.jenjang.v_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenjang' => 'required',
        ], [
            'jenjang.required' => 'Wajib Di isikan !!!',
        ]);
        
        if ($request->icon) {
            // $jenjang = $this->Jenjang->DetailData($id);

            // if ($jenjang->icon <> "") {
            //     unlink(public_path('icon') . '/' . $jenjang->icon);
            // }
            

            $file = $request->icon;
            $filename = time(). ".". $file ->getClientOriginalName();
            $file->move(public_path('icon'), $filename);
            
            $data = [
                'jenjang' => $request->jenjang,
                'icon' => $filename,
            ];
    
            $this->Jenjang->UpdateData($id, $data);         
        } else {
            $data = [
                'jenjang' => $request->jenjang,
            ];
    
            $this->Jenjang->UpdateData($id, $data);
        }

        return redirect()->route('jenjang')->with('update', 'Data Jenjang Berhasil Di Update');
    }

    public function delete($id)
    {
        $jenjang = $this->Jenjang->DetailData($id);
        if ($jenjang->icon <> "") {
            unlink(public_path('icon') . '/' . $jenjang->icon);
        }

        $this->Jenjang->DeleteData($id);

        return redirect()->route('jenjang')->with('delete', 'Berhasil Menghapus Data Jenjang');
    }
}
