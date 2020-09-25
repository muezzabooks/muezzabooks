@extends('layout')

@section('content')
  <div class="container">

    <div class="row align-items-top p-5 mt-2" style="min-height: 500px;">
            
      <div class="col-lg-6 text-center">
        <img class="img-fluid" src="{{ $products->path }}" style="max-height: 300px"> 
      </div>
      
      <div class="col-lg-6">
        <h1 class="title pb-2"><strong>{{ $products->product_name }}</strong></h1>
        <h5 class="pb-2">Author : {{ $products->author }}</h5>

        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Deskripsi</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Spesifikasi</a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Ulasan</a>
          </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <p class="p-3">{{ $products->description }}</p>
          </div>
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <table>
              <tr>
                <td class="pl-3 pr-3 pt-3">Jumlah Halaman</td>
                <td class="pt-3">{{ $products->page }}</td>
              </tr>  
              <tr>
                <td class="pl-3 pr-3">Penerbit</td>
                <td>{{ $products->publisher }}</td>
              </tr>
              <tr>
                <td class="pl-3 pr-3">Cover</td>
                <td>{{ $products->cover }}</td>
              </tr>
              <tr>
                <td class="pl-3 pr-3">Bahasa</td>
                <td>{{ $products->language }}</td>
              </tr>
              <tr>
                <td class="pl-3 pr-3">Berat</td>
                <td>{{ $products->weight }} kg</td>
              </tr>
              <tr>
                <td class="pl-3 pr-3 pb-3">Ukuran</td>
                <td class="pb-3">{{ $products->long }} x {{ $products->wide }} cm</td>
              </tr>
            </table>
          </div>
          <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" style="">
            <p class="p-3">Review is not available</p>
          </div>
         <h5>Stok : {{ $products->stock }}</h5>
         <a href="{{ route('buy',['id' => $products->id]) }}" class="btn btn-warning mt-3">Beli Sekarang</a>
         <a href="{{ route('cart.store',['id' => $products->id]) }}" class="btn btn-outline-dark mt-3">Tambahkan ke keranjang</a>
        </div>
      </div>
    </div>
  </div>
@endsection
