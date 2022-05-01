<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('bank.home');
    }
}
