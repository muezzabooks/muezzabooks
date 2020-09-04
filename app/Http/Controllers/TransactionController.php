<?php

namespace App\Http\Controllers;

use App\Address;
use App\Cart;
use App\DetailTransaction;
use App\Product;
use App\Image;
use App\User;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $products = Cart::where('user_id',Auth::id())->get();
            $user = User::find(Auth::id())->pluck('name')->first();
            return view('checkout',[
                'products' => $products,
                'user' => $user,
            ]);
        } else {
            return view('checkout');
        }

        
    }

    public function indexBuy()
    {
        if (Auth::check()) {
            $user = User::find(Auth::id())->pluck('name')->first();
            return view('checkout_buy',['user' => $user]);
        } else {
            return view('checkout_buy');
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
    public function storeGuest(Request $request)
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
        $transaction->status = 'waiting for validation';
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

        $request->session()->flush();
        
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
            $total += Product::where(['id' => $details->product_id])->pluck('price')->first();
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
            $price = Product::where(['id' => $details->product_id])->pluck('price')->first();

            $detailTransaction = new DetailTransaction;
            $detailTransaction->transaction_id = $t;
            $detailTransaction->product_id = $details->product_id;
            $detailTransaction->quantity = $details->quantity;
            $detailTransaction->price = $price * $details['quantity'];
            $detailTransaction->save();
            
            $details->delete();
        }

        // foreach ($cart as $id => $details) {
        //     $details->delete();
        // }
        
        return redirect()->route('transaction.show', ['id' => $t]);
    }

    public function buy(Request $request)
    {
        $address = new Address;

        $address->name = $request->name;
        $address->phone = $request->phone;
        $address->city = $request->city;
        $address->address = $request->address;
        $address->save();

        $a = Address::latest()->pluck('id')->first();
        $total = 0;
        foreach (session('cart_buy') as $id => $details) {
            $total+=$details['price'];
        }

        $transaction = new Transaction;

        $transaction->address_id = $a;
        $transaction->total = $total;
        $transaction->status = 'waiting';
        $transaction->date = date("Y-m-d H:i:s");
        $transaction->save();

        $t = Transaction::latest()->pluck('id')->first();
        foreach (session('cart_buy') as $id => $details) {
            $detailTransaction = new DetailTransaction;
            $detailTransaction->transaction_id = $t;
            $detailTransaction->product_id = $details['product_id'];
            $detailTransaction->quantity = $details['quantity'];
            $detailTransaction->price = $details['price'] * $details['quantity'];
            $detailTransaction->save();
        }
        
        $request->session()->flush();
        
        return redirect()->route('transaction.show', ['id' => $t]);
    }

    public function checkTransaction(){
        return view('checktransaction');
    }

    public function checkTransactionSearch(Request $request){
        $kode = $request->kode;
        $transaction = Transaction::join('addresses','transactions.address_id', '=','addresses.id')
        ->select('transactions.*','addresses.name','addresses.phone',
        'addresses.city','addresses.address')
        ->where('transactions.id', $kode)
        ->first();
        $product = DetailTransaction::join('transactions','transactions.id','=','detail_transactions.transaction_id')
        ->join('products','products.id','=','detail_transactions.product_id')
        ->join('images','images.product_id','=','products.id')
        ->select('images.path','products.product_name','products.price', 'detail_transactions.quantity')
        ->where('transactions.id', $kode)
        ->get();

        if($transaction->status == "waiting"){
            $transaction = Transaction::find($kode);
            $detailTransaction = DetailTransaction::where('transaction_id',$kode)->get();
            // dd($detailTransaction[0]['product_id']);
            $address = Address::find($transaction['address_id']);
            return view('transaction',[
                'transaction' => $transaction, 
                'detail' => $detailTransaction,
                'address' => $address
            ]);
        }
        else{
            return view('checktransactionbycode', [
                'data' => $transaction,
                'product' => $product]);
        }
        
    }
     public function myTransaction($id){
        $data = User::join('addresses','users.id', '=','addresses.user_id')
        ->select('users.*','addresses.phone','addresses.city','addresses.address')
        ->where('users.id',$id)
        ->first();

        $transaction =Transaction::join('users', 'transactions.user_id','=','users.id')
        ->select('transactions.*')
        ->where('users.id', '=', $id)
        ->orderBy('transactions.id')
        ->get();

        $detail = Transaction::join('detail_transactions','transactions.id','=','detail_transactions.transaction_id')
        ->join('users','users.id','=','transactions.user_id')
        ->join('products','products.id' ,'=','detail_transactions.product_id')
        ->join('images','images.product_id','=','products.id')
        ->select('transactions.code','products.product_name','images.path','detail_transactions.quantity','products.price')
        ->where('users.id','=', $id)
        ->get();

        $product = \App\DetailTransaction::join('transactions','transactions.id','=','detail_transactions.transaction_id')
        ->join('products','products.id','=','detail_transactions.product_id')
        ->select('products.product_name','products.price','detail_transactions.quantity')
        ->where('transactions.id', $id)
        ->get();

        return view('mytransaction',[
            'data' => $transaction,
            'detail' => $detail,
            ]);
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
        
        $transaction = Transaction::find($id);
        $transaction->status = 'processing';

        return redirect()->route('transaction.show', ['id' => $id]);
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
