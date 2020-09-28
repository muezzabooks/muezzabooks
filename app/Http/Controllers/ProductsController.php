<?php

namespace App\Http\Controllers;

use App\Product;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::leftJoin('images','products.id', '=','images.product_id')
        ->select('products.*','images.path')->take(8)->get();
        if (Auth::check()) {
        $count = Cart::where('user_id',Auth::id())->count();
        return view('home',[
            'products' => $products,
            'count' => $count
            ]);
        } 
        else
        {
            $count = 0;
            return view('home',[
                'products' => $products,
                'count' => $count
                ]);
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createproduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $products = Product::where('id', $id)->get();
        $products = Product::leftJoin('images','products.id', '=','images.product_id')
        ->select('products.*','images.path','images.name')->find($id);
        $count = Cart::where('user_id',Auth::id())->count();

        if($products == null){
            return abort(404);
        }
        else{
            return view('detail',[
                'products' => $products,
                'count' => $count
                ]);
        }        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
