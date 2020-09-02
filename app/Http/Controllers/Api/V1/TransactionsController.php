<?php

namespace App\Http\Controllers\Api\V1;

use App\Address;
use App\Cart;
use App\DetailTransaction;
use App\Http\Controllers\Controller;
use App\Product;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            
            $address = new Address();

            $address->name = $request->name;
            $address->phone = $request->phone;
            $address->city = $request->city;
            $address->zip_code = $request->zip;
            $address->address = $request->address;
            $address->user_id = Auth::id();
            $address->save();

            $a = Address::latest()->pluck('id')->first();
            $cart = Cart::where('user_id',Auth::id())->get();
            $total = 0;
            foreach ($cart as $id => $details) {
                $total += Product::where(['id' => $details->id])->pluck('price')->first();
            }

            $transaction = new Transaction;

            $transaction->address_id = $a;
            $transaction->total = $total;
            $transaction->status = 'waiting for validation';
            $transaction->date = date("Y-m-d H:i:s");
            $transaction->user_id = Auth::id();
            $transaction->save();

            $t = Transaction::latest()->pluck('id')->first();
            foreach ($cart as $id => $details) {
                $price = Product::where(['id' => $details->id])->pluck('price')->first();

                $detailTransaction = new DetailTransaction;
                $detailTransaction->transaction_id = $t;
                $detailTransaction->product_id = $details->product_id;
                $detailTransaction->quantity = $details->quantity;
                $detailTransaction->price = $price * $details['quantity'];
                $detailTransaction->save();

                $details->delete();
            }
            
            return response()->json($transaction);

        }
        
    }

    public function buy(Request $request)
    {
        if (Auth::check()) {
            
            $address = new Address();

            $address->name = $request->name;
            $address->phone = $request->phone;
            $address->city = $request->city;
            $address->zip_code = $request->zip;
            $address->address = $request->address;
            $address->user_id = Auth::id();
            $address->save();

            $a = Address::latest()->pluck('id')->first();
            $cart = Cart::where('user_id',Auth::id())->get();
            $total = 0;
            $total += Product::where(['id' => $request->product_id])->pluck('price')->first();

            $transaction = new Transaction;

            $transaction->address_id = $a;
            $transaction->total = $total;
            $transaction->status = 'waiting for validation';
            $transaction->date = date("Y-m-d H:i:s");
            $transaction->user_id = Auth::id();
            $transaction->save();

            $t = Transaction::latest()->pluck('id')->first();
            $detailTransaction = new DetailTransaction;
            $detailTransaction->transaction_id = $t;
            $detailTransaction->product_id = $request->product_id;
            $detailTransaction->quantity = $request->product_quantity;
            $detailTransaction->price = $request->product_price;
            $detailTransaction->save();
            
            return response()->json($transaction);

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
