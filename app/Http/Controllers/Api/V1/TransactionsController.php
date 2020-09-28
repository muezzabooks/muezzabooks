<?php

namespace App\Http\Controllers\Api\V1;

use App\Address;
use App\Cart;
use App\DetailTransaction;
use App\Http\Controllers\Controller;
use App\Image;
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
    public function index()
    {
        // $transaction = Transaction::leftJoin('images','transactions.id', '=','images.transaction_id')
        // ->select('transactions.*','images.path','images.name')->find(Auth::id());
        $transaction =Transaction::join('users', 'transactions.user_id','=','users.id')
            ->select('transactions.*')
            ->where('users.id', '=', Auth::id())
            ->orderBy('transactions.code')
            ->get();
        return response()->json($transaction);
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
            $path = public_path('destinations.json');
            $destination = collect(json_decode(file_get_contents($path), true));

            $data = $destination->where('code', $request->city)->first();
            
            $address = new Address();

            $address->name = $request->name;
            $address->phone = $request->phone;
            $address->city = $data['label'];
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
            $transaction->shipping_cost = $request->shipping_cost;
            $transaction->total = $total + $request->shipping_cost;
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

        } else {
            return response()->json('User is not logged in');
        }
        
    }

    public function buy(Request $request)
    {
        if (Auth::check()) {
            $path = public_path('destinations.json');
            $destination = collect(json_decode(file_get_contents($path), true));

            $data = $destination->where('code', $request->city)->first();
            
            $address = new Address();

            $address->name = $request->name;
            $address->phone = $request->phone;
            $address->city = $data['label'];
            $address->address = $request->address;
            $address->user_id = Auth::id();
            $address->save();

            $a = Address::latest()->pluck('id')->first();
            $cart = Cart::where('user_id',Auth::id())->get();
            $total = 0;
            $total += Product::where(['id' => $request->product_id])->pluck('price')->first();

            $transaction = new Transaction;

            $transaction->address_id = $a;
            $transaction->shipping_cost = $request->shipping_cost;
            $transaction->total = $total + $request->shipping_cost;
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

        } else {

            return response()->json('User is not logged in');

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
      $status = Transaction::where('transactions.code', $id)->value('status');
      $id_transaction = Transaction::where('transactions.code', $id)->pluck('id');
      if ($status === "processing") {
        $transaction = Transaction::join('addresses','transactions.address_id', '=','addresses.id')
          ->join('images','images.transaction_id','=','transactions.id')
          ->select('images.path','transactions.*','addresses.name','addresses.phone','addresses.city','addresses.address')
          ->where('transactions.code', $id)
          ->first();
      } else {
        $transaction = Transaction::join('addresses','transactions.address_id', '=','addresses.id')
          ->select('transactions.*','addresses.name','addresses.phone',
          'addresses.city','addresses.address')
          ->where('transactions.code', $id)
          ->first();
      }
      
      $product = DetailTransaction::join('transactions','transactions.id','=','detail_transactions.transaction_id')
        ->join('products','products.id','=','detail_transactions.product_id')
        ->join('images','images.product_id','=','products.id')
        ->select('images.path','products.product_name','products.price', 'detail_transactions.quantity')
        ->where('transactions.code', $id)
        ->get();

      return response()->json([
        'transaction :' => $transaction,
        'details : ' => $product,
        'status : ' => $status
      ]);
    }

    public function insertImage(Request $request,$id){
      $transaction = Transaction::where('transactions.code', $id)->first();
      $transaction_id = $transaction->id;

      if ($request->file('image')) {
          $imagePath = $request->file('image');
          $imageName = $imagePath->getClientOriginalName();

          $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
      } else {
        return response()->json('Upload image failed');
      }
      
      try {
        $answer = Image::create([
          'name' => $imageName, 
          'path' => '/storage/'.$path,
          'transaction_id' => $transaction_id
      ]);
      } catch (\Throwable $th) {
        return response()->json('Upload image failed');
      }
      
      
      $transaction->status = 'processing';
      $transaction->save();

      return response()->json('Upload image success');
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
