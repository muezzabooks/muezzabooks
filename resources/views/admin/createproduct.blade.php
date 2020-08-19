@extends('admin.adminlayout')
@section('product','active')
@section('header','Products')

@section('content')
<form action="{{ route('adminproducts.store') }}" method="POST" enctype="multipart/form-data">

  @csrf
  <div class="form-group">
    <label for="title" class="col-form-label">Title Book:</label>
    <input type="text" class="form-control" id="title" name="product_name">                                                  
  </div>
  @error('product_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror  

  <div class="form-group">
    <label for="desc" class="col-form-label">Description:</label>
    <textarea class="form-control" id="desc" name="description"></textarea>                          
  </div>
    @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror 

  <div class="form-group">
      <label for="stock" class="col-form-label">Stock</label>
      <input type="number" class="form-control" id="stock" name="stock">                           
    </div>
      @error('stock')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror 

    <div class="form-group">
      <label for="price" class="col-form-label">Price</label>
      <input type="number" class="form-control" id="price" name="price">                           
    </div>
      @error('price')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror  

    <div class="form-group">
      <label for="image" class="col-form-label">Image</label>
      <input type="file" class="form-control" id="image" name="file">                            
    </div>
      @error('file')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror 

  <div class="modal-footer">
  <a href="{{ route('adminproducts.index') }}" class="btn btn-secondary">Close</a>
  <button type="submit" class="btn btn-primary">Send message</button>
  </div>
</form>
@endsection
