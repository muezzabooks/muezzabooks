@extends('admin.adminlayout')

@section('content')
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="p-3">
                    <form action="{{ route('adminproduct.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @foreach ($product as $p)
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title Book:</label>
                            <input type="text" class="form-control" id="title" name="product_name"
                            value="{{ $p->product_name }}">
                            
                          </div>
                        @endforeach
                        
                        <div class="form-group">
                          <label for="desc" class="col-form-label">Description:</label>
                          <textarea class="form-control" id="desc" name="description"></textarea>
                          
                        </div>
                        <div class="form-group">
                            <label for="stock" class="col-form-label">Stock</label>
                            <input type="text" class="form-control" id="stock" name="stock">
                           
                          </div>
                          <div class="form-group">
                            <label for="price" class="col-form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price">
                            
                          </div>
                          {{-- <div class="form-group">
                            <label for="image" class="col-form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                          </div> --}}
                    
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection