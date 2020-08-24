<?php

namespace App\Http\Controllers;

use App\Address;
use App\Cart;
use App\DetailTransaction;
use App\Product;
use App\Image;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $products = Cart::where('user_id',Auth::id())->get();
            return view('checkout',[
                'products' => $products
            ]);
        } else {
            return view('checkout');
        }

        
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
            $detailTransaction->price = $details['price'] * $details['quantity'];
            $detailTransaction->save();
        }
        
        return redirect()->route('transaction.show', ['id' => $t]);
    }

    public function storeAuth(Request $request)
    {
        $address = new Address;

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
        $transaction->status = 'processing';
        $transaction->date = date("Y-m-d H:i:s");
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
        }
        
        return redirect()->route('transaction.show', ['id' => $t]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);
        $detailTransaction = DetailTransaction::where('transaction_id',$id)->get();
        // dd($detailTransaction[0]['product_id']);
        $address = Address::find($transaction['address_id']);
        return view('transaction',[
            'transaction' => $transaction, 
            'detail' => $detailTransaction,
            'address' => $address
        ]);
    }


    public function insertImage(Request $request){
        $id = $request->id;
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
  
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
          }

        $answer = Image::create([
            'name' => $imageName, 
            'path' => '/storage/'.$path,
            'transaction_id' => $id
             ]);

             dd($answer);
        return redirect('/done');
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
