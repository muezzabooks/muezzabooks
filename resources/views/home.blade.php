@extends('layout')

@section('content')

  <div class="masthead-content bg-warning">
    <div class="row">
      <div class="col-lg-6 order-lg-2 text-center">
        <div class="p-5">
          <img class="img-fluid" src="{{ ('assets/images/read.svg') }}"> 
        </div>
      </div>
      <div class="col-lg-6 order-lg-1">
        <div class="p-5">
          <h2 class="d-none d-lg-block display-4">BBA - Bahagia Bersama AlQuran</h2>
          <h2 class="d-sm-block d-md-none">BBA - Bahagia Bersama AlQuran</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
          <a href="#catalog" class="btn btn-outline-grey">Get The Books!</a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 pt-4 pb-0">
    <div class="row">
      <h3 class="text-secondary">CARI BERDASARKAN KATEGORI</h3>
      <a href="#" class="ml-auto text-decoration-none text-secondary">Lihat Semua <i class="fa fa-arrow-right text-warning"></i> </a>
    </div>
  </div>

  <hr>

  <div class="col-12 pt-2">
    <div class="row">
      <button class="btn btn-outline-secondary m-auto" style="width: 10rem">
        Bisnis & Ekonomi
      </button>

      <button class="btn btn-outline-secondary m-auto" style="width: 10rem">
        Pendidikan
      </button>

      <button class="btn btn-outline-secondary m-auto" style="width: 10rem">
        Agama
      </button>

      <button class="btn btn-outline-secondary m-auto" style="width: 10rem">
        Gaya Hidup
      </button>

      <button class="btn btn-outline-secondary m-auto" style="width: 10rem">
        Keluarga
      </button>

      <button class="btn btn-outline-secondary m-auto" style="width: 10rem">
        Resep & Makanan
      </button>
    </div>
  </div>

  <div class="col-12 pt-4">
    <div class="row">
      <h3 class="text-secondary">BEST SELLER</h3>
    </div>
  </div>

  <hr>

  <div class="col-12 pt-4">
    <div class="row justify-content-center">
      <?php $i = 0 ?>
      @foreach ($products as $no => $p)
        @if ($i === 4)
          </div>
          <div class="row justify-content-center">
          <?php $i = 0 ?>
        @endif
        <div class="card shadow-sm mb-4 mr-4" style="width: 15rem">
          <img class="card-img-top img-catalog" style="height: 15rem;" src="{{ $p->path }}" alt="Card image cap">
          <div class="card-body">
            <button class="mb-3 btn btn-sm btn-outline-secondary" disabled>Author</button>
            <h5 class="card-title text-uppercase" style="height: 2.5rem;">
              <a href="show/{{ $p->id }}" class="text-decoration-none text-dark">
                <strong>{{ $p->product_name }}</strong>
              </a>
            </h5>
            <p>
              Rp. @convert($p->price)
            </p>
            <a href="{{ route('buy',['id' => $p->id]) }}" class="btn btn-warning">BELI SEKARANG</a>
            <a href="{{ route('cart.store',['id' => $p->id]) }}" class="btn btn-light ml-2">
              <i class="fa fa-shopping-cart fa-lg"></i>
            </a>
          </div>
        </div>

        <?php $i++ ?>
      @endforeach
    </div>
  </div>

@endsection