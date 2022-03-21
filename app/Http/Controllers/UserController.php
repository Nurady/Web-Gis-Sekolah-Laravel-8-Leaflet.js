<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.v_index', [
            'title' => 'User',
            'users' => User::all()
        ]);
    }

    public function create()
    {
        return view('admin.user.v_add', [
            'title' => 'Tambah User'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed',
            'photo' => 'required|mimes:jpg,jpeg,png|max:1024',
        ]);

        $photo = $request->photo;
        $filename = $photo->getClientOriginalName();
        $destinationPath = 'public/photo_user';
        $photoPath = $photo->storeAs($destinationPath, $filename);        

        User::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'photo'     => $photoPath,
            'password'  => bcrypt($request->input('password'))
        ]);

        return redirect()->route('user.index')->with('create', 'Data User Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.v_edit', [
            'user' => $user,
            'title' => 'Edit User'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'.$id,
        ]);

        $user = User::findOrFail($id);

        if ($request->input('password') == "" && $request->file('photo') == "") {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email')
            ]);
        } 
        
        if ($request->input('password') && $request->file('photo')) {
            $request->validate([
                'name'      => 'required',
                'email'     => 'required|email|unique:users,email,'.$id,
                'password'  => 'min:8|confirmed',
            ]);

            if ($user->photo) {
                Storage::delete($user->photo);
            }

            $photo = $request->photo;
            $filename = $photo->getClientOriginalName();
            $destinationPath = 'public/photo_user';
            $photoPath = $photo->storeAs($destinationPath, $filename);   

            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'photo' => $photoPath,
                'password'  => bcrypt($request->input('password'))
            ]);
        } 
        
        if ($request->input('password')) {
            $request->validate([
                'name'      => 'required',
                'email'     => 'required|email|unique:users,email,'.$id,
                'password'  => 'min:8|confirmed',
            ]);
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password'))
            ]);
        } 
        
        if ($request->file('photo')) {
            if ($user->photo) {
                Storage::delete($user->photo);
            }

            $photo = $request->photo;
            $filename = $photo->getClientOriginalName();
            $destinationPath = 'public/photo_user';
            $photoPath = $photo->storeAs($destinationPath, $filename);   

            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'photo' => $photoPath,
            ]);
        }

        return redirect()->route('user.index')->with('update', 'Data User Berhasil Diupdate');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->photo) {
            Storage::delete($user->photo);
        }

        $user->delete();
        return redirect()->route('user.index')->with('delete', 'Data User Berhasil Dihapus');
    }
}
