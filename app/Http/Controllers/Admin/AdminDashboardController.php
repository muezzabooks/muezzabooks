<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Transaction;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function show(){
        $product = Product::count();
        $user = User::count();
        $week = Transaction::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $month =  Transaction::whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->count();

        return view('admin/adminhome',[
            'product' => $product,
            'user' => $user,
            'week' => $week,
            'month' => $month
        ]);
       
    }
}
