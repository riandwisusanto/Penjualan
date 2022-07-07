<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabarugiController extends Controller
{
    public function index()
    {
        return view('labarugi.index');
    }
}
