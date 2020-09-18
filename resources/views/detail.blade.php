@extends('layout')

@section('content')

<section>
  <hr>
  <div class="container full-height mobile">
    
    <div class="row align-items-center pb-5">
            
      <div class="col-lg-6">
        <h3 class="title pb-2"><strong>{{ $products->product_name }}</strong></h3>
      </div>
      
      <div class="col-lg-6 pb-5">
        <div class="text-center p-3">
          <img style="height: 100%; width: 200px" src="{{ $products->path }}" > 
        </div>
                 
         <h3 class="pb-2">Rp {{ $products->price }}</h3>
         <h5 class="pb-2"> Deskripsi : 
           {{ $products->description }}
         </h5>
         <h5>Stock : {{ $products->stock }}</h5>
         <a href="{{ route('buy',['id' => $products->id]) }}" class="btn btn-warning btn-block">Beli Sekarang</a>
         <a href="{{ route('cart.store',['id' => $products->id]) }}" class="btn btn-outline-dark btn-block">Tambahkan ke keranjang</a>
      </div>
    </div>
  </div>
    <div class="container full-height desktop">

    <div class="row align-items-center pb-5">
            
      <div class="col-lg-6 text-center pb-5">
          <img style="height: 100%; width: 200px" src="{{ $products->path }}" > 
      </div>
      
      <div class="col-lg-6">
         <h1 class="title pb-2"><strong>{{ $products->product_name }}</strong></h1>
         <h3 class="pb-2">Rp {{ $products->price }}</h3>
         <h5 class="pb-2"> Deskripsi : 
           {{ $products->description }}
         </h5>
         <h5>Stock : {{ $products->stock }}</h5>
         <a href="{{ route('buy',['id' => $products->id]) }}" class="btn btn-warning">Beli Sekarang</a>
         <a href="{{ route('cart.store',['id' => $products->id]) }}" class="btn btn-outline-dark">Tambahkan ke keranjang</a>
      </div>
    </div>
  </div>
</section>  
@endsection
