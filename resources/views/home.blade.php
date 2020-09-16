@extends('layout')

@section('content')

<header class="masthead ">
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