
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
                  <li class="list-group-item">Nama Penerima : {{ $address->name }}</li>
                  <li class="list-group-item">Status transaksi : {{ $transaction['status'] }}</li>
                </ul>
                <div class="card-body pb-0">
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

                  <form action="{{ route('transaction.insert.image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="card-body">
                  <input type="hidden" name="id" value="{{ $transaction['id'] }}">
                  <input type="file" name="image" class="form-control"><br>
                  <button class="btn btn-primary" type="submit">Submit</button>
                </div>
              </form>

              </div>
        </div>
    </div>
  </div>
</div>
@endsection
