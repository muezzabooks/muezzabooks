
@extends('layout')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-8 col-sm-12">

      <div class="row">
        <div class="col-12 p-3">
          <div class="card">
            <h5 class="card-header card-header-yellow">Alamat Pengiriman</h5>
            <div class="card-body">
              <form>

                {{-- Nama --}}
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="name">Nama Penerima</label>
                      <input type="email" class="form-control" id="name">
                    </div>
                  </div>
                </div>
                {{-- Kota atau kecamatan --}}
                <div class="row">
                  <div class="col-8">
                    <div class="form-group">
                      <label for="city">Kota atau Kecamatan</label>
                      <input type="email" class="form-control" id="city">
                    </div>
                  </div>
                  {{-- Kode Pos --}}
                  <div class="col-4">
                    <div class="form-group">
                      <label for="zip">Kode Pos</label>
                      <input type="email" class="form-control" id="zip">
                    </div>
                  </div>
                </div>
                {{-- Alamat --}}
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="address">Alamat</label>
                      <textarea class="form-control" id="address" rows="3"></textarea>
                    </div>
                  </div>
                </div>
                
              </form>

              {{-- <form class="form-horizontal">
                <fieldset>
             
                  <!-- full-name input-->
                  <div class="control-group">
                    <label class="control-label">Nama Penerima</label>
                    <div class="controls">
                      <input id="full-name" name="full-name" type="text" placeholder=""
                      class="input-xlarge">
                      <p class="help-block"></p>
                    </div>
                  </div>
                  <!--city input-->
                  <div class="control-group">
                    <label class="control-label">Kota atau Kecamatan</label>
                    <div class="controls">
                      <input id="address-line1" name="address-line1" type="text" placeholder=""
                      class="input-xlarge">
                      <p class="help-block"></p>
                    </div>
                  </div>
                  <!-- address-line2 input-->
                  <div class="control-group">
                    <label class="control-label">Alamat</label>
                    <div class="controls">
                      <input id="address-line2" name="address-line2" type="text" placeholder=""
                      class="input-xlarge">
                      <p class="help-block"></p>
                    </div>
                  </div>
                  <!-- postal-code input-->
                  <div class="control-group">
                      <label class="control-label">Kode Pos</label>
                      <div class="controls">
                          <input id="postal-code" name="postal-code" type="text" placeholder=""
                          class="input-xlarge">
                          <p class="help-block"></p>
                      </div>
                  </div>
                </fieldset>
              </form> --}}
            </div>
          </div>
        </div>
      </div>

      <div class="row">
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
            <a href="#" class="btn btn-block btn-primary disabled">Validasi Pembayaran</a>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
@endsection

