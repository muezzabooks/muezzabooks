<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class ImageController extends Controller
{
    public function index()
    {

      return view('admin.images');
    }

    public function store(Request $request)
    {
        $request->validate([
          'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = new Image;

        if ($request->file('file')) {
          $imagePath = $request->file('file');
          $imageName = $imagePath->getClientOriginalName();

          $path = $request->file('file')->storeAs('uploads', $imageName, 'public');
        }

        $image->name = $imageName;
        $image->path = '/storage/'.$path;
        $image->save();

        return back()->with('success', 'Image uploaded successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'product_code' => 'required',
            'description' => 'required',
        ]);
         
        $update = ['title' => $request->title, 'description' => $request->description];
 
        if ($files = $request->file('image')) {
           $destinationPath = 'public/uploads/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $update['image'] = "$profileImage";
        }
        Product::where('id',$id)->update($update);
   
        return Redirect::to('products')
       ->with('success','Great! Product updated successfully');
    }
   
}