@extends('layout')

@section('content')
<section>
    <hr>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-3">
          <div class="p-5">
            <img class="img-detail" src="{{ ('assets/images/cover-book.jpg') }}" > 
          </div>
        </div>
        <div class="col-lg-5 detail">
            <h2 class="title-detail">Quranic Motivation</h2>
           <h5>Jumlah Halaman: 90 Halaman</h5>
           <h5>Harga : Rp 90.000</h5>

        </div>
        <div class="col-lg-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a><br>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
          </div>
      </div>
    </div>
  </section>
@endsection