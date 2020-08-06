@extends('layout')

@section('content')
<section>
    <hr>
    <div class="container">
      <div class="row align-items-center pb-5">
        
        <div class="col-lg-6 text-center pb-5">
            <img style="height: 100%; width: 200px" src="{{ ('assets/images/cover-book.jpg') }}" > 
        </div>
        
        <div class="col-lg-6">
           <h1 class="title pb-2"><strong>Quranic Motivation</strong></h1>
           <h3 class="pb-2">Rp 90.000</h3>
           <h5 class="pb-2">
             Lorem ipsum dolor sit amet consectetur adipisicing elit. 
             Nisi quam, ab dolorum recusandae voluptates mollitia dicta sunt ipsam dolore hic natus velit nihil explicabo 
             impedit aliquam consectetur minima, beatae alias. Lorem ipsum dolor sit amet consectetur adipisicing elit. 
             Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. 
           </h5>
           <h5>Jumlah Halaman : 90 Halaman</h5>
           <h5 class="pb-2">Kategori : lorem ipsum</h5>
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
@endsection