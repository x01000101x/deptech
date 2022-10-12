<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function show()
    {
        return User::all();
    }

    public function create()
    {
        request()->validate([
            'nama_depan' => 'required|string',
            'nama_belakang' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|min:8'
        ]);

        $admin = new User;
        $admin->name = request('nama_depan');
        $admin->name2 = request('nama_belakang');
        $admin->lahir = request('tanggal_lahir');
        $admin->kelamin = request('jenis_kelamin');
        $admin->email = request('email');
        $admin->password = Hash::make(request('password'));
        $admin->save();

        return response()->json([
            'message' => 'akun admin berhasil dibuat!',
            'data' => $admin
        ], 200);
    }

    public function showById($id)
    {
        return User::where('id', $id)->first();
    }

    public function update($id)
    {
        $User = new User;
        $User->where('id', $id)->update([
            "name" => request('nama_depan'),
            "name2" => request('nama_belakang'),
            "email" => request('email'),
            "kelamin" => request('jenis_kelamin'),
            "lahir" => request('tanggal_lahir'),
            "password" => Hash::make(request('password')),
        ]);

        return response()->json([
            'message' => 'berhasil update',
        ], 200);
    }

    public function delete($id)
    {
        User::destroy($id);

        return response()->json([
            'message' => 'berhasil hapus',
        ], 200);
    }
}
