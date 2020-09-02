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
        if (Auth::check()) {
            $products = Cart::where('user_id',Auth::id())->get();
            return view('cart',[
                'products' => $products
            ]);
        }

        return view('cart');
        
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
        $product = Product::leftJoin('images','products.id', '=','images.product_id')
        ->select('products.*','images.path','images.name')->find($id);

        if (Auth::check()) {

            $cart = Cart::where('user_id', Auth::id())->where('product_id',$product->id)->first();

            if ($cart === null) {
                $cart = new Cart;

                $cart->user_id = Auth::id();
                $cart->product_id = $product->id;
                $cart->quantity = 1;
                $cart->save();

                return redirect()->back();

            } else {
                $cart->quantity += 1;
                $cart->save();

                return redirect()->back();
            }

            

        } else {
            $cart = session()->get('cart');

            //if cart is empty then add the product
            if (!$cart) {
                $cart[$id] = [
                        "product_id" => $product->id,
                        "product_name" => $product->product_name,
                        "price" => $product->price,
                        "quantity" => 1,
                        "path" => $product->path
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
                    "quantity" => 1,
                    "path" => $product->path
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

    public function buy($id)
    {
        $product = Product::leftJoin('images','products.id', '=','images.product_id')
        ->select('products.*','images.path','images.name')->find($id);

        $cartBuy[$id] = [
            "product_id" => $product->id,
            "product_name" => $product->product_name,
            "price" => $product->price,
            "quantity" => 1,
            "path" => $product->path
        ];

        session()->put('cart_buy', $cartBuy);
        
        return redirect()->route('checkout.buy',['id' => $id]);
        
    }

    public function increase(Request $request, $id)
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->where('product_id',$request->id)->first();
            $cart->quantity += 1;
            $cart->save();

            return redirect()->back();

        } else {
            if (isset($id)) {
                $cart = session()->get('cart');
                $cart[$id]["quantity"]++;
            
                session()->put('cart', $cart);
                return redirect()->back();
            }
        }
        
    }

    public function decrease(Request $request, $id)
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->where('product_id',$request->id)->first();
            
            if ($cart->quantity === 1) {
                return redirect()->back();
            }

            $cart->quantity -= 1;
            $cart->save();
            
            return redirect()->back();

        } else {
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

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->where('product_id',$request->id)->first();
            $cart->delete();

            return redirect()->back();

        } else {

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
}
