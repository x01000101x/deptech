<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;


class ProdukController extends Controller
{
    public function show()
    {
        $toto = Produk::all();

        return response()->json([
            'nama' => $toto->nama_produk
        ]);
    }

    public function create()
    {
        request()->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'stok' => 'required|numeric',
            'kategori' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $file_name = time() . '.' . request('gambar')->extension();
        request('gambar')->move(public_path('products'), $file_name);
        $path = "/products/$file_name";

        $produk = new Produk;
        $produk->nama_produk = request('nama');
        $produk->deskripsi_produk = request('deskripsi');
        $produk->stok_produk = request('stok');
        $produk->kategori_produk = request('kategori');
        $produk->gambar_produk = $path;
        $produk->save();

        return response()->json([
            'message' => 'produk berhasil dibuat',
            'data' => $produk
        ], 200);
    }

    public function showById($id)
    {
        $toto = Produk::where('id', $id)->first();
        return response()->json([
            'id' => $toto->id,
            'nama' => $toto->nama_produk,
            'deskripsi' => $toto->deskripsi_produk,
            'stok' => $toto->stok_produk,
            'kategori' => $toto->kategori_fk,
            'gambar' => $toto->gambar_produk,

        ]);
    }

    public function update($id)
    {
        $file_name = time() . '.' . request('gambar')->extension();
        request('gambar')->move(public_path('products'), $file_name);
        $path = "/products/$file_name";

        $Produk = new Produk;
        $Produk->where('id', $id)->update([
            "nama_produk" => request('nama'),
            "deskripsi_produk" => request('deskripsi'),
            "stok_produk" => request('stok'),
            "kategori_produk" => request('kategori'),
            "gambar_produk" => $path
        ]);

        return response()->json([
            'message' => 'berhasil update',
        ], 200);
    }

    public function delete($id)
    {
        Produk::destroy($id);

        return response()->json([
            'message' => 'berhasil hapus',
        ], 200);
    }
}
