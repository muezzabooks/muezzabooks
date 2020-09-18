@extends('layout')

@section('content')

  <header class="masthead ">
    <div class="masthead-content">
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
  </header>

  <div class="col-12 pt-4">
    <div class="row">
      <?php $i = 0 ?>
      @foreach ($products as $no => $p)
        @if ($i === 4)
          </div>
          <div class="row">
          <?php $i = 0 ?>
        @endif
        <div class="card shadow-sm m-3 mt-3">
          <img class="card-img-top img-catalog" src="{{ $p->path }}" alt="Card image cap">
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
  

  {{-- @foreach ($products as $no => $p)
  @if ($no % 2 == 0)
  <section id="catalog">
    <div class="container page-wrap">
      <div class="row align-items-center">
        <div class="col-lg-4">
          <div class="p-5">
            <img class="img-catalog" src="{{ $p->path }}" >
          </div>
        </div>
        <div class="col-lg-8">
          <div class="p-5">
            <h1>{{ $p->product_name }}</h1>
            <a href="show/{{ $p->id }}" class="btn btn-outline-yellow">Detail</a>
          </div>
        </div>
      </div>
    </div>
    <hr>
  </section>

  @else
  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-4 order-lg-2">
          <div class="p-5">
            <img class="img-catalog" src="{{ $p->path }}" > 
          </div>
        </div>
        <div class="col-lg-8 order-lg-1">
          <div class="p-5">
            <h1>{{ $p->product_name }}</h1>     
            <a href="show/{{ $p->id }}" class="btn btn-outline-yellow">Detail</a>
          </div>
        </div>
      </div>
    </div>
    <hr>
  </section>
  @endif
  @endforeach --}}

@endsection