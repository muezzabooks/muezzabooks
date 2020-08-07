<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function detail(){
        return view('detail');
    }

    public function cart(){
        return view('cart');
    }
    public function checkout(){
        return view('checkout');
    }
}
