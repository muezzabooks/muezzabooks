<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $products = Cart::all();
        return view('cart',[
            'products' => $products
        ]);
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
    public function store(Request $request, $id)
    {   
        $product = Product::find($id);

        if (Auth::check()) {
            # code...
        } else {
            $cart = session()->get('cart');

            //if cart is empty then add the product
            if (!$cart) {
                $cart = [
                    $id = [
                        "product_id" => $product->id,
                        "product_name" => $product->name,
                        "price" => $product->price,
                        "quantity" => 1
                    ]
                ];

                session()->put('cart', $cart);
                return redirect()->back()->with('success','Produk telah ditambahkan ke keranjang belanja anda');
            }

            //if product already exist in cart then increase the quantity
            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
 
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Produk telah ditambahkan ke keranjang belanja anda');
            }

            //if product doesnt exist in cart then add the product
            $cart[$id] = [
                    "product_id" => $product->id,
                    "product_name" => $product->product_name,
                    "price" => $product->price,
                    "quantity" => 1
                ];

            session()->put('cart', $cart);
            return redirect()->back()->with('success','Produk telah ditambahkan ke keranjang belanja anda');
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
    public function update(Request $request)
    {
        if($request->id && $request->quantity)
        {
            $cart = session()->get('cart');
 
            $cart[$request->id]["quantity"] = $request->quantity;
 
            session()->put('cart', $cart);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->id) {
 
            $cart = session()->get('cart');
 
            if(isset($cart[$request->id])) {
 
                unset($cart[$request->id]);
 
                session()->put('cart', $cart);
            }
 
            session()->flash('success', 'Berhasil dihapus dari keranjang');
        }
    }
}
