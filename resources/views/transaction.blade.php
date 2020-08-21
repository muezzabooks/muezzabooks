
@extends('layout')

@section('content')
<div class="container">
    <div class="row p-5">
        <div class="col-4">
            <img class="img-fluid" src="{{ ('../../assets/images/payment.svg') }}" >
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                  <h4 class="card-title">DETAIL TRANSAKSI</h4>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Status transaksi : {{ $transaction['status'] }}</li>
                </ul>
                <div class="card-body">
                  @foreach ($detail as $id => $d)
                    <p>
                      <strong>
                        Nama Buku : {{ \App\Product::where(['id' => $d['product_id']])->pluck('product_name')->first() }}
                      </strong>
                      <li class="list-group-item">Jumlah : {{ $d['quantity'] }}</li>
                      <li class="list-group-item">Harga : {{ $d['price'] }}</li>
                    </p>
                  @endforeach
                </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <strong> Alamat : {{ $address['city'] }}, {{ $address['address'] }} </strong>
                    </li>
                  </ul>
                <div class="card-body">
                  <a href="#" class="btn btn-primary">Lampirkan Bukti Pembayaran</a>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
