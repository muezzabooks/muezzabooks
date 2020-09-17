<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
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
        ->select('products.*','images.path')->get();

        return response()->json($products);
    }
    
    public function show($id)
    {
        $products = Product::leftJoin('images','products.id', '=','images.product_id')
        ->select('products.*','images.path','images.name')->find($id);

        if($products == null){
            return response()->json(['message' => 'product not found']);
        }
        else{
            return response()->json($products);
        }        
    }
}
