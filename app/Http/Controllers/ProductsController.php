<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

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

        return view('home')->with('products', $products);
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

        if($products == null){
            return abort(404);
        }
        else{
            return view('detail')
        ->with('products', $products);
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
        $products = Product::find($product);
        return view('admin.updateproduct')->with('product', $products);
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
        $product_name = $request->product_name;
        $description = $request->description;
        $stock = $request->stock;
        $price = $request->price;
        $image = $request->image;

        $products = Product::find($id);
        $products->product_name = $product_name;
        $products->description = $description;
        $products->stock = $stock;
        $products->price = $price;
        $products->image = $image;

        $products->save();

        return response()->json([
            'message' => 'Data Berhasil Update',
            'product' => $products
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::find($id);
        $products->delete();

        return response()->json([
            'message' => 'Berhasil Dihapus'
        ]);
    }
}
