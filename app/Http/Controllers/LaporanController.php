<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function create()
    {
        return view('siswa.lapor');
    }
}