<?php

namespace App\Http\Controllers\Api\V1;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {

            $products = Cart::where('user_id',Auth::id())->get();

            return response()->json($products);

        }

        return response()->json("User is not logged in.");

        
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

                return response()->json($cart);

            } else {

                $cart->quantity += 1;
                $cart->save();

                return response()->json('Quantity increased');
            }
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
    public function increase(Request $request, $id)
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->where('product_id',$id)->first();

            if ($cart === null) {
                return response()->json('Product doesnt exist in cart');
            }

            $cart->quantity += 1;
            $cart->save();

            return response()->json('Quantity increased');
        }
    }

    public function decrease(Request $request, $id)
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->where('product_id',$id)->first();
            
            if ($cart === null) {
                return response()->json('Product doesnt exist in cart');
            }

            if ($cart->quantity === 1) {
                return response()->json('Cant decrease quantity anymore');
            }

            $cart->quantity -= 1;
            $cart->save();
            
            return response()->json('Quantity decreased');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->where('product_id',$id)->first();
            $cart->delete();

            return response()->json('Product removed from cart');
        }
    }
}
