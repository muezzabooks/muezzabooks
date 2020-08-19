<?php

namespace App\Http\Controllers;

use App\Address;
use App\DetailTransaction;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address = new Address;

        $address->name = $request->name;
        $address->phone = $request->phone;
        $address->city = $request->city;
        $address->zip_code = $request->zip;
        $address->address = $request->address;
        $address->save();

        $a = Address::latest()->pluck('id')->first();
        $total = 0;
        foreach (session('cart') as $id => $details) {
            $total+=$details['price'];
        }

        $transaction = new Transaction;

        $transaction->address_id = $a;
        $transaction->total = $total;
        $transaction->status = 'processing';
        $transaction->date = date("Y-m-d H:i:s");
        $transaction->save();

        $t = Transaction::latest()->pluck('id')->first();
        foreach (session('cart') as $id => $details) {
            $detailTransaction = new DetailTransaction;
            $detailTransaction->transaction_id = $t;
            $detailTransaction->product_id = $details['product_id'];
            $detailTransaction->quantity = $details['quantity'];
            $detailTransaction->price = $details['price'];
            $detailTransaction->save();
        }
        dd('success');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
