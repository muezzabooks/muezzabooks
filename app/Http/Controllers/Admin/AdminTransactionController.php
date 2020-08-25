<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;

class AdminTransactionController extends Controller
{
    public function index(){

        $data = Transaction::all();
       return view('admin.transaction')->with('data', $data);
   }

   public function show($id){

    $transaction = Transaction::leftJoin('images','transactions.id', '=','images.transaction_id')
    ->select('transactions.*','images.path')
    ->where('transactions.id', $id)
    ->first();
    return view('admin.detailtransaction')->with('data', $transaction);
   }
}
