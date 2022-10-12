<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show()
    {
        $datas = User::all();
        return view('index', compact('datas'));
    }
}
