<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class AdminProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.adminproduct')->with('products', $products);
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
        $products = Product::create($request->all());
        // $product = new Product;
        // $product->product_name = $request->product_name;
        // $product->description = $request->description;
        // $product->stock = $request->stock;
        // $product->price = $request->price;
        // $product->save;

        return redirect('/admin/adminproducts');
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
        $product = Product::find($id);
        return view('admin.update', compact('product'));
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

        return redirect('admin/adminproducts');

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

        return redirect('admin/adminproducts');
    }
}
