<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;

class AdminTransactionController extends Controller
{
    public function index(){

        $data = Transaction::join('addresses','transactions.address_id', '=','addresses.id')
        ->select('transactions.*','addresses.name')
        ->get();
       return view('admin.transaction')->with('data', $data);
   }

   public function show($id){

    $status = Transaction::where('id',$id)->first()->status;

         if($status == "waiting"){
            $transaction = Transaction::join('addresses','transactions.address_id', '=','addresses.id')
            ->select('transactions.*','addresses.name','addresses.phone',
            'addresses.city','addresses.address')
            ->where('transactions.id', $id)
            ->first();
         }
         else {
            $transaction = Transaction::join('images','transactions.id', '=','images.transaction_id')
            ->join('addresses','transactions.address_id', '=','addresses.id')
            ->select('transactions.*','addresses.name','addresses.phone',
            'addresses.city','addresses.address')
            ->where('transactions.id', $id)
            ->first();
         }

    $product = \App\DetailTransaction::join('transactions','transactions.id','=','detail_transactions.transaction_id')
    ->join('products','products.id','=','detail_transactions.product_id')
    ->select('products.product_name','products.price','detail_transactions.quantity')
    ->where('transactions.id', $id)
    ->get();
    return view('admin.detailtransaction',[
        'data'=> $transaction,
        'product' => $product
        ]);
   }
   
   public function update(Request $request, $id){
       
    $status = $request->status;

        $transaction = Transaction::find($id);
        $transaction->status = $status;
        $transaction->save();

       return redirect('admin/transaction');
   }

}
