@extends('layout')

@section('content')

@foreach ($products as $a)
<section>
  <hr>
  <div class="container">
    <div class="row align-items-center pb-5">
            
      <div class="col-lg-6 text-center pb-5">
          <img style="height: 100%; width: 200px" src="{{ ('/assets/images/cover-book.jpg') }}" > 
      </div>
      
      <div class="col-lg-6">
         <h1 class="title pb-2"><strong>{{ $a->product_name }}</strong></h1>
         <h3 class="pb-2">Rp {{ $a->price }}</h3>
         <h5 class="pb-2">
           {{ $a->description }}
         </h5>
         <h5>Stock : {{ $a->stock }}</h5>
         <a href="#" class="btn btn-warning">Beli Sekarang</a>
         <a href="#" class="btn btn-outline-dark">Tambahkan ke keranjang</a>
      </div>
    </div>
    {{-- end of row --}}
    <div class="row align-items-center pb-5">
      <div class="col-lg-12">
        <h5>
          <strong>Username</strong>
        </h5>
        <p class="pb-2">
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugit quae accusamus repellat. Sequi porro ducimus et aliquam placeat sunt doloremque eos similique eligendi cumque facere, asperiores libero deleniti earum tempore.
        </p>
        {{-- -- --}}
        <h5>
          <strong>Username</strong>
        </h5>
        <p class="pb-2">
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugit quae accusamus repellat. Sequi porro ducimus et aliquam placeat sunt doloremque eos similique eligendi cumque facere, asperiores libero deleniti earum tempore.
        </p>
        {{-- -- --}}
        <h5>
          <strong>Username</strong>
        </h5>
        <p class="pb-2">
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugit quae accusamus repellat. Sequi porro ducimus et aliquam placeat sunt doloremque eos similique eligendi cumque facere, asperiores libero deleniti earum tempore.
        </p>
      </div>
      
    </div>
  </div>
</section>  
@endforeach
@endsection