<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show()
    {
        $datas = Produk::all();

        return view('produk', compact('datas'));
    }
}
