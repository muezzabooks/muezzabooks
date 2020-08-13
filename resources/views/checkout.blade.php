
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
            <table class="table table-sm">
              <tbody>
                <thead>
                  <tr>
                    <th>Nama Buku</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
              <?php $total=0 ?>
              @foreach (session('cart') as $id => $details)
                <?php $total += $details['price'] * $details['quantity'] ?>
                <tr>
                  <td scope="row">{{ $details['product_name'] }}</td>
                  <th>Rp {{ $details['price'] }}</th>
                  <td>{{ $details['quantity'] }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>

            <table class="table table-sm">
              <tbody>
                <tr>
                  <th scope="row">Total Harga</th>
                  <th colspan="2" class="text-center">Rp {{ $total }}</th>
                </tr>
                <tr>
                  <th scope="row">Biaya Kirim</th>
                  <th colspan="2" class="text-center">Mark</th>
                </tr>
                <tr>
                  <th scope="row">Diskon</th>
                  <th colspan="2" class="text-center">Mark</th>
                </tr>
              </tbody>
            </table>
            <h4 class="pb-2">Grand Total : Rp {{ $total }}</h4>
            <a href="#" class="btn btn-block btn-primary">Validasi Pembayaran</a>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
@endsection

