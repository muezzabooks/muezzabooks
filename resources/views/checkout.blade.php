
@extends('layout')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-8 col-sm-12">

      <div class="row">
        <div class="col-12 p-3">
          <div class="card">
            <h5 class="card-header card-header-yellow">Shipping</h5>
            <div class="card-body">
              <h5 class="card-title">Shipping Destination</h5>
              <p class="card-text">Your address is empty</p>
              <a href="#" class="btn btn-primary">add address</a>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 p-3">
          <div class="card">
            <h5 class="card-header card-header-yellow">Payment</h5>
            <div class="card-body">
              <h5 class="card-title">Cara pembayaran</h5>
              <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur quo doloremque aperiam corporis esse, quam, nisi maxime exercitationem, minima earum saepe. Laborum consequuntur, natus aspernatur ab ratione cumque eaque.</p>
              <ul class="list-group">
                <li class="list-group-item">XXXX-XXXX-XXXX</li>
              </ul>
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
            <ul class="list-group">
              <li class="list-group-item">Judul Buku 1 Rp 29000</li>
              <li class="list-group-item">Judul Buku 2 Rp 36000</li>
            </ul>
            <div class="row">
              <div class="col-md-6">
                Total Harga <br>
                Biaya Kirim <br>
                Diskon <br>
              </div>
              <div class="col-md-6">
                Rp. 65000 <br>
                Rp. 1000 <br>
                Rp. 66000
              </div>
            </div>
            <h4>Grand Total : Rp 66000</h4>
            <a href="#" class="btn btn-block btn-primary">Pay</a>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
@endsection

