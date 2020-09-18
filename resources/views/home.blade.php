@extends('layout')

@section('content')

<header class="masthead desktop">
  <div class="masthead-content">
    <div class="container">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 order-lg-2 text-center">
          <div class="p-5">
            <img class="img-fluid img-header" src="{{ ('assets/images/read.svg') }}"> 
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div style="padding-top: 6em">
        <div class="col-12 order-lg-1">
            <h2 class="display-4 text-header">BBA - Bahagia Bersama AlQuran</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
            <a href="#catalog" class="btn btn-outline-grey">Get The Books!</a>
          </div>
      </div>
    </div>
  </div>
</header>

<header class="masthead mobile ">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 order-lg-1">
            <div class="p-3 text-center">
              <h2 class="display-4 text-header">BBA - Bahagia Bersama AlQuran</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
              <a href="#catalog" class="btn btn-outline-grey">Get The Books!</a>
            </div>
          </div>
        </div>
      </div>
  </header>

  {{-- <section>
    <div class="container">
      <div class="row">        
          @foreach ($products as $p)
          <div class="col-3 ml-3 mt-3">
          <div class="card">
            <div class="p-3 text-center">
            <img class="img-catalog-mobile card-img-top" style="width: 5rem;" src="{{ $p->path }}" >
          </div>
            <div class="card-body">
              <h5 class="card-title"><strong>{{ $p->product_name }}</strong></h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
          @endforeach
      </div>
    </div>
  </section> --}}

  <div class="mobile" id="catalog">
  @foreach ($products as $no => $p)
      <div class="masthead">
        <div class="pt-3 pb-3">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                <img class="img-catalog-mobile" src="{{ $p->path }}" >
              </div>
              <div class="col-8">
                <h1 class="text-home text-left p-3">{{ $p->product_name }}</h1>
                <div class="p-3">
                  <a href="show/{{ $p->id }}" class="btn btn-outline-yellow">Detail</a></div>
              </div>
            </div>           
          </div>
        </div>
      </div>
      </div>
    @endforeach
  </div>

  @foreach ($products as $no => $p)
  <div class="desktop">
  @if ($no % 2 == 0)
  <section id="catalog">
    <div class="container page-wrap">
      <div class="row align-items-center">
        <div class="col-lg-4 text-center">
          <div class="p-3">
            <img class="img-catalog" src="{{ $p->path }}" >
          </div>
        </div>
        <div class="col-lg-8">
          <div class="p-3 center-mobile">
            <h1 class="text-home">{{ $p->product_name }}</h1>
            <a href="show/{{ $p->id }}" class="btn btn-outline-yellow">Detail</a>
          </div>
        </div>
      </div>
    </div>
    <hr>
  </section>

  @else
  <section>
    <div class="container destop">
      <div class="row align-items-center">
        <div class="col-lg-4 order-lg-2 text-center">
          <div class="p-3">
            <img class="img-catalog" src="{{ $p->path }}" > 
          </div>
        </div>
        <div class="col-lg-8 order-lg-1">
          <div class="p-3 center-mobile">
            <h1 class="text-home">{{ $p->product_name }}</h1>     
            <a href="show/{{ $p->id }}" class="btn btn-outline-yellow">Detail</a>
          </div>
        </div>
      </div>
    </div>
    <hr>
  </section>
  @endif
</div>
  @endforeach

@endsection