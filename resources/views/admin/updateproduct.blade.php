@extends('admin.adminlayout')
@section('product','active')
@section('header','Products')

@section('content')
<form action="{{ route('adminproducts.update',$product->id) }}" method="POST" enctype="multipart/form-data">

  @csrf
  @method('PUT')
  <div class="form-group">
      <label for="title" class="col-form-label">Title Book:</label>
      <input type="text" class="form-control" id="title" name="product_name"
      value="{{ $product->product_name }}">                            
    </div>
    @error('product_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror 
  
  <div class="form-group">
    <label for="desc" class="col-form-label">Description:</label>
    <textarea class="form-control" id="desc" name="description">{{ $product->description }}</textarea>                          
  </div>
  @error('description')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror 

  <div class="form-group">
      <label for="stock" class="col-form-label">Stock</label>
      <input type="number" class="form-control" id="stock" name="stock"
      value="{{ $product->stock }}">                           
    </div>
    @error('stock')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror 

    <div class="form-group">
      <label for="price" class="col-form-label">Price</label>
      <input type="number" class="form-control" id="price" name="price"
      value="{{ $product->price }}">                            
    </div>
    @error('price')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror 
    
    <div class="form-group">
      <label for="image" class="col-form-label">Image</label><br>
      <img src="{{ $product->path }}" height="70" alt=""><br>
      <input type="hidden" value="{{ $product->path }}" name="path">
      <input type="hidden" value="{{ $product->name }}" name="name">
      <input type="file" class="form-control" id="image" name="file">                            
    </div>
    @error('file')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror 
 

  <div class="modal-footer">
  <a href="{{ route('adminproducts.index') }}" class="btn btn-secondary">Close</a>
  <button type="submit" class="btn btn-primary">Send Update</button>
  </div>
</form>
@endsection
