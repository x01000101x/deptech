<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function show()
    {
        return Transaction::all();
    }

    public function showById($id)
    {

        return Transaction::where('id', $id)->first();
    }


    public function create()
    {
        request()->validate([
            'in' => 'required|numeric',
            'out' => 'required|numeric',
            'produk_id' => 'required|numeric',
        ]);

        $produk = new Produk;

        $prodid = request('produk_id');
        $out = request('out');
        $in = request('in');

        $data = $produk->where('id', $prodid)->first();

        // return response()->json([]);

        if ($data->stok_produk < 1 && $out > 0 && $in < 1) {
            return response()->json([
                'message' => 'maaf stok kosong!'
            ]);
        } elseif (($data->stok_produk - $out + $in) <= 0) {
            return response()->json([
                'message' => 'maaf stok kurang!'
            ]);
        } else {
            $summary = $data->stok_produk - $out + $in;
            $produk->where('id', $prodid)->update([
                "nama_produk" => $data->nama_produk,
                "deskripsi_produk" => $data->deskripsi_produk,
                "stok_produk" => $summary,
                "kategori_produk" => $data->kategori_produk,
                "gambar_produk" => $data->gambar_produk
            ]);
            $transaction = new Transaction;
            $transaction->produk_id = request('produk_id');
            $transaction->in = request('in');
            $transaction->out = request('out');

            $transaction->save();

            return response()->json([
                'message' => 'transaction berhasil dibuat',
                'data' => $transaction
            ], 200);
        }
    }
}
