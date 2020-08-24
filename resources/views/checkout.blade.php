
@extends('layout')

@section('content')
<div class="container">
  <div class="row">
    
    <div class="col-md-8 col-sm-12">
      
      {{-- <div class="row">
        <div class="col-12 p-3">
          <div class="card">
            <h5 class="card-header card-header-yellow">Pembayaran</h5>
            <div class="card-body">
              <h5 class="card-title">Cara pembayaran</h5>
              <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur quo doloremque aperiam corporis esse, quam, nisi maxime exercitationem, minima earum saepe. Laborum consequuntur, natus aspernatur ab ratione cumque eaque.</p>
              <ul class="list-group">
                <li class="list-group-item">XXXX-XXXX-XXXX</li>
              </ul>
            </div>
          </div>
        </div>
      </div> --}}

      <div class="row">
        <div class="col-12 p-3">
          <div class="card">
            <h5 class="card-header card-header-yellow">Alamat Pengiriman</h5>
            <div class="card-body">
              <form action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Nama --}}
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="name">Nama Penerima</label>
                      <input type="text" class="form-control" id="name" name="name">
                    </div>
                  </div>
                </div>
                {{-- Kota atau kecamatan --}}
                <div class="row">
                  <div class="col-8">
                    <div class="form-group">
                      <label for="city">Kota atau Kecamatan</label>
                      <input type="text" class="form-control" id="city" name="city">
                    </div>
                  </div>
                  {{-- Kode Pos --}}
                  <div class="col-4">
                    <div class="form-group">
                      <label for="zip">Kode Pos</label>
                      <input type="number" class="form-control" id="zip" name="zip">
                    </div>
                  </div>
                </div>
                {{-- HP --}}
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="phone">Nomor Telepon</label>
                      <input type="tel" class="form-control" id="phone" name="phone">
                    </div>
                  </div>
                </div>
                {{-- Alamat --}}
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="address">Alamat</label>
                      <textarea class="form-control" id="address" rows="3" name="address"></textarea>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-block btn-primary">Lanjutkan ke Pembayaran</button>
              
              </form>
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
              @guest
                @if (session('cart'))
                  @foreach (session('cart') as $id => $details)
                    <?php $total += $details['price'] * $details['quantity'] ?>
                    <tr>
                      <td scope="row">{{ $details['product_name'] }}</td>
                      <th>Rp {{ $details['price'] }}</th>
                      <td>{{ $details['quantity'] }}</td>
                    </tr>
                  @endforeach
                @else
                  <script>window.location = "/";</script>
                @endif
              @endguest

              @auth
                @if (isset($products))
                  @foreach ($products as $id => $details)
                    <?php $total += \App\Product::where(['id' => $details->id])->pluck('price')->first() * $details->quantity ?>
                    <tr>
                      <td scope="row">{{ \App\Product::where(['id' => $details->id])->pluck('product_name')->first() }}</td>
                      <th>Rp {{ \App\Product::where(['id' => $details->id])->pluck('price')->first() }}</th>
                      <td>{{ $details->quantity }}</td>
                    </tr>
                  @endforeach
                @else
                  <script>window.location = "/";</script>
                @endif
              @endauth
              
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
            <h4 class="pb-2 text-center">Grand Total : Rp {{ $total }}</h4>
          </div>
        </div>
      </div>
    </div>
  </form>
  </div>
</div>
@endsection
