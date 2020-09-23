<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Image;

class AdminProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('image')->get();
        $imageproduct = Product::leftJoin('images','products.id', '=','images.product_id')
        ->select('products.*','images.path')->get();
        // dd($products);
        // $products = Product::all();

        return view('admin.adminproduct')->with('products', $imageproduct);
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
        $validatedData = $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required|min:4',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1500|dimensions:min_height=500'

        ]);
        $products = Product::create($request->all());

        if ($request->file('file')) {
            $imagePath = $request->file('file');
            $imageName = $imagePath->getClientOriginalName();
  
            $path = $request->file('file')->storeAs('uploads', $imageName, 'public');
          }

        $answer = Image::create([
            'name' => $imageName, 
            'path' => '/storage/'.$path,
            'product_id' => $products->id
    ]);

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
        $product = Product::leftJoin('images','products.id', '=','images.product_id')
        ->select('products.*','images.path','images.name')->find($id);

        return view('admin.updateproduct', compact('product'));
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
        $validatedData = $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required|min:4',

        ]);

        $product_name = $request->product_name;
        $author = $request->author;
        $description = $request->description;
        $page = $request->page;
        $language = $request->language;
        $cover = $request->cover;
        $long = $request->long;
        $wide = $request->wide;
        $weight = $request->weight;
        $stock = $request->stock;
        $price = $request->price;
        $discount = $request->discount;
        $image = $request->image;
        

        $products = Product::find($id);
        $products->product_name = $product_name;
        $products->description = $description;
        $products->author = $author;
        $products->page = $page;
        $products->cover = $cover;
        $products->language = $language;
        $products->long = $long;
        $products->wide = $wide;
        $products->weight = $weight;
        $products->discount = $discount;
        $products->stock = $stock;
        $products->price = $price;

        if($products->save()){

            if ($request->file('file')) {
                $imagePath = $request->file('file');
                $imageName = $imagePath->getClientOriginalName();
      
                $path = $request->file('file')->storeAs('uploads', $imageName, 'public');
                $imagePathh = "/storage/".$path;;
            }
            else{
                $imagePathh = $request->path;
                $imageName = $request->name;
            }

            $image = Image::find($id);
            $image = Image::where('product_id',$id)->first();
            $image->name = $imageName;
            $image->path = $imagePathh;
            $image->product_id = $id;

            $image->save();
            return redirect('admin/adminproducts');
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
        $products = Product::find($id);
        $products->delete();

        return redirect('admin/adminproducts');
    }
}
