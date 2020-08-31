
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
              @guest
              <form action="{{ route('transaction.storeGuest') }}" method="POST" enctype="multipart/form-data">
              @endguest

              @auth
              <form action="{{ route('transaction.storeAuth') }}" method="POST" enctype="multipart/form-data">
              @endauth
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
                      <label for="city">Kota</label>
                      <select class="js-example-basic-single" name="city" id="city" class="form-control" style="width: 100%; height: calc(1.6em + 0.75rem + 2px);">
                      </select>
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
                    <?php $total += \App\Product::where(['id' => $details->product_id])->pluck('price')->first() * $details->quantity ?>
                    <tr>
                      <td scope="row">{{ \App\Product::where(['id' => $details->product_id])->pluck('product_name')->first() }}</td>
                      <th>Rp {{ \App\Product::where(['id' => $details->product_id])->pluck('price')->first() }}</th>
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
                  <th colspan="2" class="text-center">Rp <span id="ongkos"></span> </th>
                </tr>
                <tr>
                  <th scope="row">Diskon</th>
                  <th colspan="2" class="text-center">Mark</th>
                </tr>
              </tbody>
            </table>
            <h4 class="pb-2 text-center" id="total">Grand Total : Rp <span id="gtotal">{{ $total }}</span></h4>
          </div>
        </div>
      </div>
    </div>
  </form>
  </div>
</div>
@endsection

@section('script')
<script>

  $(document).ready(function(){

    $('.js-example-basic-single').select2({
      data: data
    });
    
    $('.js-example-basic').select2({
      data: origin
    });

  });
  

  document.getElementById("destination").onchange = function(){
    var finalResult = [];
    function convertSiCepatFareTableToJSON(resultFromSiCepat) {
      

      // Remove <div> that wrap <table> tag
      var tableString = resultFromSiCepat.replace(/(?:^<div[^>]*>)|(?:<\/div>$)/g, '')
      var tableDOM = $(tableString)[0];

      // first row needs to be headers
      var headers = [];
      for (var i = 0; i < tableDOM.rows[0].cells.length; i++) {
        headers[i] = tableDOM.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi, '');
      }

      // go through cells
      for (var i = 1; i < tableDOM.rows.length; i++) {
        var tableRow = tableDOM.rows[i];
        var rowData = {};

        for (var j = 0; j < tableRow.cells.length; j++) {

          // remove any div and its content
          filteredContent = tableRow.cells[j].innerHTML.replace(/<div.*<\/div>/g, '')
          rowData[headers[j]] = filteredContent;
        }

        finalResult.push(rowData);
      }

      return finalResult;

    }

    var kab = $('#destination').val(); 
    var berat = $('#berat').val(); 

    var params = {
      origin_code: 'BDO',
      destination_code: kab,
      weight: 1
    };

    console.log(params);

    var headers = {
      "authority": 'www.sicepat.com',
      "accept": 'application/json, text/javascript, */*; q=0.01',
      "x-requested-with": 'XMLHttpRequest',
      "content-type": 'application/x-www-form-urlencoded; charset=UTF-8',
    }

    $.ajax({
      url: 'https://cors-anywhere.herokuapp.com/https://www.sicepat.com/deliveryFee/fare',
      method: 'POST',
      data: params,
      datatype: 'json',
      headers: headers,
      beforeSend: function () {
        console.log('Please Wait..')
      },
      success: function (data) {
        // Final JSON data you can manipulate as your desire.
        console.log(convertSiCepatFareTableToJSON(data.html))
        // var json_data = convertSiCepatFareTableToJSON(data.html)
        

            console.log(finalResult);
            var arrlength = finalResult.length;

            if(arrlength == 4){
              document.getElementById("ongkos").textContent = finalResult[3].tarif;
              var tarif = finalResult[3].tarif;
              var sub = parseInt("{{ $total }}");
              var intTarif = parseInt(tarif);
              var total = intTarif + sub;
              // console.log(total);
              document.getElementById("gtotal").textContent = total;


            }
            else if(arrlength == 5){
              document.getElementById("ongkos").textContent = finalResult[4].tarif;
              var tarif = finalResult[4].tarif;
              var sub = parseInt("{{ $total }}");
              var intTarif = parseInt(tarif);
              var total = intTarif + sub;
              // console.log(total);
              document.getElementById("gtotal").textContent = total;

            }

            
           
            // hasil.innerHTML = stringresult;
        
      },
      error: function (xhr) {
        console.log(xhr.status + " - " + xhr.statusText)
      },
    })

  }

</script>
@endsection