@extends('admin.adminlayout')
@section('product','active')
@section('header','Products')

@section('content')
<form action="{{ route('adminproducts.update',$product->id) }}" method="POST" enctype="multipart/form-data">

  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-md-6">
        <div class="form-group row">
          <label for="title" class="col-sm-3 col-form-label">Judul Buku</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="title" name="product_name" 
            value="{{ $product->product_name }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="author" class="col-sm-3 col-form-label">Author</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="author" name="author" 
            value="{{ $product->author }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="desc" class="col-sm-3 col-form-label">Deskripsi</label>
          <div class="col-sm-9">
            <textarea class="form-control" id="desc" name="description" required>{{ $product->description }}</textarea> 
          </div>
        </div>

        <div class="form-group row">
          <label for="publisher" class="col-sm-3 col-form-label">Cover</label>
          <div class="col-sm-9">
            <select name="cover" id="" style="width: 100%">
              <option value="soft" {{ $product->language == 'soft'? 'selected' : '' }}>Soft Cover</option>
              <option value="hard" {{ $product->language == 'hard'? 'selected' : '' }}>Hard Cover</option>
            </select>  
           
          </div>
        </div>

        <div class="form-group row">
          <label for="publisher" class="col-sm-3 col-form-label">Bahasa</label>
          <div class="col-sm-9">
            <select name="language" id="" style="width: 100%">
              <option value="indonesia" {{ $product->language == 'indonesia'? 'selected' : '' }}>Bahasa Indonesia</option>
              <option value="inggris" {{ $product->language == 'inggris'? 'selected' : '' }}>Bahasa Inggris</option>
            </select>  
           
          </div>
        </div>

        <div class="form-group row">
          <label for="publisher" class="col-sm-3 col-form-label">Penerbit</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="publisher" name="publisher" 
            value="{{ $product->publisher }}" required>
          </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group row">
          <label for="title" class="col-sm-3 col-form-label">Jumlah Halaman</label>
          <div class="col-sm-9">
            <input type="page" class="form-control" id="page" name="page" 
            value="{{ $product->page }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="author" class="col-sm-3 col-form-label">Ukuran (Panjang (cm) x Lebar(cm))</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="long" name="long" 
            value="{{ $product->long }}" required> 
          </div>
          <div class="col-md-1">x</div>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="wide" name="wide" 
            value="{{ $product->wide }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="desc" class="col-sm-3 col-form-label">Berat</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="weight" name="weight" 
            value="{{ $product->weight }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="desc" class="col-sm-3 col-form-label">Stok</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="stok" name="stock" 
            value="{{ $product->stock }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="desc" class="col-sm-3 col-form-label">Harga</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="price" name="price" 
            value="{{ $product->price }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="desc" class="col-sm-3 col-form-label">Diskon(%)</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="discount" name="discount" 
            value="{{ $product->discount }}">
          </div>
        </div>
    </div>

    <div class="col-md-6">
    <div class="form-group row">
      <label for="image" class="col-form-label col-sm-3 ">Image</label><br>
      <div class="col-sm-9">
      <img src="{{ $product->path }}" height="70" alt=""><br>
      <input type="hidden" value="{{ $product->path }}" name="path">
      <input type="hidden" value="{{ $product->name }}" name="name">
      <input type="file" class="form-control" id="image" name="file">                            
    </div>
    </div>
    @error('file')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror 
  </div>
</div>
 

  <div class="modal-footer">
  <a href="{{ route('adminproducts.index') }}" class="btn btn-secondary">Tutup</a>
  <button type="submit" class="btn btn-primary">Update Data</button>
  </div>
</form>
@endsection
