<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function show()
    {
        $datas = Transaction::all();
        $join = new Produk;
        return view('transaksi', compact('datas', 'join'));
    }
}
