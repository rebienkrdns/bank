<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;

class RootController extends Controller
{
    public function index(){
        return view('bank.root');
    }
}
