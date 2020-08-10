

@extends('layout')
@section('content')
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="p-3">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <?php $total=0 ?>

                  @if (session('cart'))
                    @foreach (session('cart') as $id => $details)

                    <?php $total += $details['price'] * $details['quantity'] ?>

                    <div class="card-body">
                      <div class="row">
                        
                        <div class="col-md-2 text-center">
                          <img src="{{ ('assets/images/cover-book.jpg') }}" class="img-fluid pb-3" style="max-height: 200px">
                        </div>
                        <div class="col-md-8">
                          <h4>{{ $details['product_name'] }}</h4>
                          <form>
                            <div class="form-group">
                              <input type="number" class="form-control" id="number" value="{{ $details['quantity'] }}">
                            </div>
                          </form>
                          <p>Total Harga : {{ $details['price'] }}</p>
                        </div>
                        <div class="col-md-2 d-flex">
                          <a href="3" class="btn btn-danger mt-auto">Hapus</a>
                        </div>
                      </div>
                    </div>
                    <hr>

                    @endforeach
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Subtotal : {{ $total }}</h5>
                        <a href="checkout" class="btn btn-yellow btn-block">Go to Payment</a>
                      </div>
                    </div>
                  </div>
                  @endif
              </div>
            </div>
          </div>
          <div class="col-12">
                <h1>Keranjang belanja anda kosong !</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

