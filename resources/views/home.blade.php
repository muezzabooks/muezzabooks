@extends('layout')

@section('content')

<header class="masthead ">
    <div class="masthead-content">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 order-lg-2 text-center">
            <div class="p-5">
              <img class="img-header" src="{{ ('assets/images/read.svg') }}"> 
            </div>
          </div>
          <div class="col-lg-6 order-lg-1">
            <div class="p-5">
              <h2 class="display-4">BBA - Bahagia Bersama AlQuran</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
              <a href="#catalog" class="btn btn-outline-grey">Get The Books!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section id="catalog">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-4">
          <div class="p-5">
            <img class="img-catalog" src="{{ ('assets/images/cover-book.jpg') }}" > 
          </div>
        </div>
        <div class="col-lg-8">
          <div class="p-5">
            <h4 class="display-4">Quranic Motivation</h4>
           <a href="detail" class="btn btn-outline-yellow">Warning</a>
          </div>
        </div>
      </div>
    </div>
    <hr>
  </section>


  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-4 order-lg-2">
          <div class="p-5">
            <img class="img-catalog" src="{{ ('assets/images/cover-book.jpg') }}" > 
          </div>
        </div>
        <div class="col-lg-8 order-lg-1">
          <div class="p-5">
            <h4 class="display-4">Bahagia Bersama AlQuran</h4>            
            <a href="detail" class="btn btn-outline-yellow">Warning</a>
          </div>
        </div>
      </div>
    </div>
    <hr>
  </section>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-4">
          <div class="p-5">
            <img class="img-catalog" src="{{ ('assets/images/cover-book.jpg') }}" > 
          </div>
        </div>
        <div class="col-lg-8">
          <div class="p-5">
            <h2 class="display-4">Quranic Motivation</h2>
           <a href="detail" class="btn btn-outline-yellow">Warning</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection