<!DOCTYPE html>
<html lang="en" style="min-height: 100%">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel</title>

	<link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link href="css/one-page-wonder.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <div class="container">
	  <a class="navbar-brand" href="{{ route('home') }}">
		<img class="img-nav" src="{{ ('assets/images/logo-muezza.png') }}" >
	 </a>
    </div>
  </nav>

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
  
  <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
</body>
</html>