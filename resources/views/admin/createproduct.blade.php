@extends('admin.adminlayout')
@section('produk','active')
@section('header','Products')

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Produk</h1>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">

<form action="{{ route('adminproducts.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="row">
    <div class="col-md-6">
      <div class="form-group row">
        <label for="title" class="col-form-label col-sm-3">Judul Buku</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="title" name="product_name" 
                value="{{ old('product_name', $post->product_name ?? null) }}" required>                                                  
        </div>
      </div>

      <div class="form-group row">
        <label for="author" class="col-form-label col-sm-3">Author</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="author" name="author"
                value="{{ old('author', $post->author ?? null) }}" required>                                                  
        </div>
    </div>

      <div class="form-group row">
        <label for="desc" class="col-form-label col-md-3">Deskripsi</label>
        <div class="col-sm-9">
        <textarea class="form-control" id="desc" name="description" required>{{ old('description', $post->description ?? null) }}</textarea>                          
        </div>
    </div>

    
    <div class="form-group row">
      <label for="title" class="col-form-label col-md-3">Cover</label>
      <div class="col-md-9">
      <select name="cover" id="" style="width: 100%">
        <option value="soft" {{ (Request::old("cover") == "soft" ? "selected":"") }}>Soft Cover</option>
        <option value="hard" {{ (Request::old("cover") == "hard" ? "selected":"") }}>Hard Cover</option>
      </select>                                                  
      </div>
    </div>

      
    <div class="form-group row">
        <label for="title" class="col-form-label col-md-3">Bahasa</label>
        <div class="col-md-9">
        <select name="language" id="" style="width: 100%">
          <option value="indonesia" {{ (Request::old("language") == "indonesia" ? "selected":"") }}>Bahasa Indonesia</option>
          <option value="inggris" {{ (Request::old("language") == "inggris" ? "selected":"") }}>Bahasa Inggris</option>
        </select>                                                
      </div>
    </div>
    <div class="form-group row">
            <label for="publisher" class="col-form-label col-md-3">Penerbit</label>
            <div class="col-md-9">
            <input type="text" class="form-control" id="publisher" name="publisher" 
               value="{{ old('publisher', $post->publisher ?? null) }}" required>                                                  
          </div>
    </div>
  </div>

    <div class="col-md-6">
      <div class="form-group row">
        <label for="page" class="col-form-label col-md-3">Jumlah Halaman</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="page" name="page" 
           value="{{ old('page', $post->page ?? null) }}" required>                                                  
        </div>
      </div>

      <div class="form-group row">
        <label for="weight" class="col-form-label col-md-3">Ukuran (Panjang (cm) x Lebar(cm))</label>
        <div class="col-md-4">
        <input type="text" class="form-control" id="long" name="long"
         value="{{ old('long', $post->long ?? null) }}" required>                                                  
        </div>
        <div class="col-md-1">x</div>
        <div class="col-md-4">
          <input type="text" class="form-control" id="wide" name="wide"
           value="{{ old('wide', $post->wide ?? null) }}" required>                                                  
          </div>
      </div>

    <div class="form-group row">
      <label for="desc" class="col-sm-3 col-form-label">Berat</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="weight" name="weight" 
        value="{{ old('weight', $post->weight ?? null) }}" required>
      </div>
    </div>
    
      <div class="form-group row">
        <label for="stock" class="col-form-label col-sm-3">Stok</label>
        <div class="col-md-9">
        <input type="number" class="form-control" id="stock" name="stock"
          value="{{ old('stock', $post->stock ?? null) }}" required>                           
      </div>
      </div>

      
        <div class="form-group row">
          <label for="price" class="col-form-label col-sm-3">Harga</label>
          <div class="col-md-9">
          <input type="number" class="form-control" id="price" name="price"
           value="{{ old('price', $post->price ?? null) }}" required>                           
        </div> 
        </div>
  
      
        <div class="form-group row">
        <label for="discount" class="col-form-label col-sm-3">Discount(%)</label>
        <div class="col-md-9">
        <input type="number" class="form-control" id="discount" name="discount" 
        value="{{ old('discount', $post->discount ?? null) }}" >                                                  
        </div>
        </div>
    </div>
<div class="col-md-6">
    <div class="form-group row">
      <label for="image" class="col-form-label col-sm-3 ">Image</label><br>
      <div class="col-sm-9"> 
        <input type="file" class="form-control" id="image" onchange="readURL(this);" style="display:none;" name="file"> 
        <label for="image" class="btn btn-block btn-primary">Pilih Gambar</label> 
        <img id="blah" src="#" alt="your image" height="70" />                
    </div>
    </div>
    @error('file')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror 
  </div>
</div>
 

  <div class="modal-footer">
  <a href="{{ route('adminproducts.index') }}" class="btn btn-secondary">Tutup</a>
  <button type="submit" class="btn btn-primary">Simpan Data</button>
  </div>
</form>
    </div>
  </div>
</div>


@endsection


@section('script')
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
  
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
  
            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
  
@endsection
