
@extends('layout')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-8 col-sm-12">
      <div class="p-3">
        <div class="card">
          <h5 class="card-header card-header-yellow">Shipping</h5>
          <div class="card-body">
            <h5 class="card-title">Shipping Destination</h5>
            <p class="card-text">Your address is empty</p>
            <a href="#" class="btn btn-primary">add address</a>
          </div>
          <h5 class="card-header card-header-yellow">Payment</h5>
          <div class="card-body">
            <h5 class="card-title">Payment Method</h5>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
              <label class="form-check-label" for="exampleRadios1">
              Gopay
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
              <label class="form-check-label" for="exampleRadios1">
              Ovo
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-12">
      <div class="p-3">
        <div class="card">
          <h5 class="card-header card-header-yellow">Order</h5>
          <div class="card-body">
            <h5 class="card-title">Judul Buku  2 Rp 290000</h5>
            <h5 class="card-title">Judul Buku  2 Rp 360000</h5>
            <div class="row">
              <div class="col-md-6">
                Total Harga <br>
                Biaya Kirim <br>
                Diskon <br>
              </div>
              <div class="col-md-6">
                Rp. 650000 <br>
                Rp. 10000 <br>
                Rp. 660000
              </div>
            </div>
            <h4>Grand Total : Rp 660000</h4>
            <a href="#" class="btn btn-block btn-primary">Pay</a>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
@endsection

