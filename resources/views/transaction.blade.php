
@extends('layout')

@section('content')
<div class="container page-wrap">
    <div class="row p-5">
        <div class="col-4 desktop">
            <img class="img-fluid" src="{{ ('../../assets/images/payment.svg') }}" >
        </div>
        <div class="col-lg-8 col-12">
          <div class="card">
                <div class="card-body">
                  <h4 class="card-title">DETAIL TRANSAKSI</h4>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Nama Penerima : {{ $address->name }}</li>
                  <li class="list-group-item">Status transaksi : {{ $transaction['status'] }}</li>
                  <li class="list-group-item">
                    <strong>
                      ID transaksi : {{ $transaction['code'] }}
                    </strong>
                  </li>
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
                <hr>
                <div class="card-body mt-0 pt-0">
                  <p>
                    <strong> Alamat </strong>
                  </p>
                  <li class="list-group-item">
                    {{ $address['address'] }}, {{ $address['city'] }}
                  </li>
                </div>
                
                @if ($transaction['status']==='waiting')
                  <form action="{{ route('transaction.insert.image',['id' => $transaction['id']]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <input type="hidden" name="id" value="{{ $transaction['id'] }}">
                      <label for="imageFile">
                        <strong>Upload Bukti Pembayaran</strong>
                      </label>
                      <input type="file" name="image" class="input-group pb-2" id="imageFile">
                      <br>
                      <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                  </form>
                @endif
                
                @if ($transaction['status']==='processing')
                  <div class="card-body bg-success pt-4">
                    <h4 class="text-center text-white">
                      Pesanan Anda Sedang Diproses
                    </h4>
                  </div>
                @endif
                
        </div>
    </div>
  </div>
</div>
@endsection
