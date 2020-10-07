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

      if($status == "waiting" || $status == "waiting for validation"){
          $transaction = Transaction::join('addresses','transactions.address_id', '=','addresses.id')
          ->select('transactions.*','addresses.name','addresses.phone',
          'addresses.city','addresses.address')
          ->where('transactions.id', $id)
          ->first();
      }
      else {
          $transaction = Transaction::join('images','transactions.id', '=','images.transaction_id')
          ->join('addresses','transactions.address_id', '=','addresses.id')
          ->select('transactions.*','addresses.name','addresses.phone', 'images.path',
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

    public function waiting(){
        $data = Transaction::join('addresses','transactions.address_id', '=','addresses.id')
        ->select('transactions.*','addresses.name')
        ->where('transactions.status','waiting')
        ->orWhere('transactions.status','waiting for validation')
        ->get();
       return view('admin.waiting')->with('data', $data);
    }

    public function processing(){
        $data = Transaction::join('addresses','transactions.address_id', '=','addresses.id')
        ->select('transactions.*','addresses.name')
        ->where('transactions.status','processing')
        ->get();
       return view('admin.processing')->with('data', $data);
    }

    public function confirmed(){
        $data = Transaction::join('addresses','transactions.address_id', '=','addresses.id')
        ->select('transactions.*','addresses.name')
        ->where('transactions.status','confirmed')
        ->get();
       return view('admin.confirmed')->with('data', $data);
    }

    public function done(){
        $data = Transaction::join('addresses','transactions.address_id', '=','addresses.id')
        ->select('transactions.*','addresses.name')
        ->where('transactions.status','delivered')
        ->orWhere('transactions.status','closed')
        ->get();
       return view('admin.done')->with('data', $data);
    }
   
   public function update(Request $request, $id){
       
    $status = $request->status;
    $resi = $request->resi;

        $transaction = Transaction::find($id);
        $transaction->status = $status;
        $transaction->no_resi = $resi;
        $transaction->save();

       return redirect('admin/transaction');
   }

   public function invoice($id){
        
        $transaction = Transaction::join('addresses','transactions.address_id', '=','addresses.id')
        ->select('transactions.*','addresses.name','addresses.phone',
        'addresses.city','addresses.address')
        ->where('transactions.id', $id)
        ->first();

        $product = \App\DetailTransaction::join('transactions','transactions.id','=','detail_transactions.transaction_id')
        ->join('products','products.id','=','detail_transactions.product_id')
        ->select('products.product_name','products.price','detail_transactions.quantity')
        ->where('transactions.id', $id)
        ->get();
        return view('admin.invoice',[
        'data'=> $transaction,
        'product' => $product
        ]);
   }

}
