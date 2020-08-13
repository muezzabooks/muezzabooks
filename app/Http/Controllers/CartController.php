<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
                        "product_name" => $product->product_name,
                        "price" => $product->price,
                        "quantity" => 1
                    ]
                ];

                session()->put('cart', $cart);
                return redirect()->back()->with('success','Produk telah ditambahkan ke keranjang belanja anda');
            }

            //if product already exist in cart then increase the quantity
            if ($cart[0]['product_name'] === $product->product_name) {
                $cart[0]['quantity']++;
 
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Produk telah ditambahkan ke keranjang belanja anda');
            }
            else if (isset($cart[$id])) {
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
    public function increase(Request $request, $id)
    {
        if(isset($id))
        {
            $cart = session()->get('cart');
            $cart[$id]["quantity"]++;

            session()->put('cart', $cart);
            return redirect()->back();
        }
    }

    public function decrease(Request $request, $id)
    {
        if(isset($id))
        {
            $cart = session()->get('cart');
            $quantity = $cart[$id]["quantity"];

            if ($quantity === 1) {
                return redirect()->back();
            }

            $cart[$id]["quantity"] = $quantity - 1;

            session()->put('cart', $cart);
            return redirect()->back();
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
        if(isset($request->id)) {
 
            $cart = session()->get('cart');
 
            if(isset($cart[$request->id])) {
 
                unset($cart[$request->id]);
 
                session()->put('cart', $cart);
            }
            
            session()->flash('success', 'Product removed successfully');
        }
    }
}
