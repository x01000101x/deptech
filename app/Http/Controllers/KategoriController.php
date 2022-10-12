<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function show()
    {
        return Kategori::all();
    }

    public function create()
    {
        request()->validate([
            'nama' => 'required|string|unique:kategoris,nama_kategori',
            'deskripsi' => 'required|string',
        ]);

        $kategori = new Kategori;
        $kategori->nama_kategori = request('nama');
        $kategori->deskripsi_kategori = request('deskripsi');

        $kategori->save();

        return response()->json([
            'message' => 'kategori berhasil dibuat',
            'data' => $kategori
        ], 200);
    }

    public function showById($id)
    {
        return Kategori::where('id', $id)->first();
    }

    public function update($id)
    {
        $Kategori = new Kategori;
        $Kategori->where('id', $id)->update([
            "nama_kategori" => request('nama'),
            "deskripsi_kategori" => request('deskripsi')
        ]);

        return response()->json([
            'message' => 'berhasil update',
        ], 200);
    }

    public function delete($id)
    {
        Kategori::destroy($id);

        return response()->json([
            'message' => 'berhasil hapus',
        ], 200);
    }
}
