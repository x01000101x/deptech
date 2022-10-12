<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function show()
    {
        $datas = Kategori::all();
        return view('kategori', compact('datas'));
    }
}
