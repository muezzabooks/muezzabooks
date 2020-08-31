@extends('layout')

@section('content')

<section>
  <hr>
  <div class="container">
    <div class="row align-items-center pb-5">
            
      <div class="col-lg-6 text-center pb-5">
          <img style="height: 100%; width: 200px" src="{{ $products->path }}" > 
      </div>
      
      <div class="col-lg-6">
         <h1 class="title pb-2"><strong>{{ $products->product_name }}</strong></h1>
         <h3 class="pb-2">Rp {{ $products->price }}</h3>
         <h5 class="pb-2">
           {{ $products->description }}
         </h5>
         <h5>Stock : {{ $products->stock }}</h5>
         <a href="#" class="btn btn-warning">Beli Sekarang</a>
         <a href="{{ route('cart.store',['id' => $products->id]) }}" class="btn btn-outline-dark">Tambahkan ke keranjang</a>
      </div>
    </div>
    {{-- end of row --}}
    <div class="row align-items-center pb-5">
      <div class="col-lg-12">
       
          <h5>
            <strong>Comments</strong>
          </h5>
          @auth
          <div class="form-group">
            <textarea type="text" name="content" class="form-control"></textarea>
        </div>

          @else
          <a class="" href="{{ route('login') }}">Log In</a> to comment this post!
        @endauth
       <hr>

       <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
       </p>
       by Rahma

      </div>
      
    </div>
  </div>
</section>  
@endsection