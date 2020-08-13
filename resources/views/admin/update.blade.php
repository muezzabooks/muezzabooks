@extends('admin.adminlayout')
@section('product','sidebar-active')

@section('content')
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="p-3">
                  <h3>Update Product</h3>
                  <hr>
                    <form action="{{ route('adminproducts.update',$product->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title Book:</label>
                            <input type="text" class="form-control" id="title" name="product_name"
                            value="{{ $product->product_name }}">
                            
                          </div>
                        
                        <div class="form-group">
                          <label for="desc" class="col-form-label">Description:</label>
                          <textarea class="form-control" id="desc" name="description">{{ $product->description }}</textarea>
                          
                        </div>
                        <div class="form-group">
                            <label for="stock" class="col-form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock"
                            value="{{ $product->stock }}">
                           
                          </div>
                          <div class="form-group">
                            <label for="price" class="col-form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price"
                            value="{{ $product->price }}">
                            
                          </div>
                          {{-- <div class="form-group">
                            <label for="image" class="col-form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                          </div> --}}
                    
                        <div class="modal-footer">
                        <a href="{{ route('adminproducts.index') }}" class="btn btn-secondary">Close</a>
                        <button type="submit" class="btn btn-primary">Send Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection