<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Muezza Books | Admin</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" >

</head>

<body>
  <div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <img src="{{ ('/assets/images/logo-muezza.png') }}" class="d-inline-block align-top img-nav" alt="" loading="lazy">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item @yield('home')">
          <a class="nav-link" href="{{ route('admin.home') }}">Home </a>
        </li>
        <li class="nav-item @yield('product')">
          <a class="nav-link" href={{ route('adminproducts.index') }}>Product</a>
        </li>
        <li class="nav-item @yield('transaction')">
          <a class="nav-link" href="{{ route('transaction') }}">Transaction</a>
        </li>
      </ul>
          <form id="logout-btn" class="d-inline" method="POST" action="{{ route('logout') }}">
            @csrf
            <input type="submit" class="btn btn-danger" value="{{__('Logout')}}">
          </form>
    </div>
  </nav>
</div>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="p-3">
                  <h3>@yield('header')</h3>
                  <hr>

                  @yield('content')
                </div>
            </div>
        </div>
    </div>
</section>




  <!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  

  <!-- Menu Toggle Script -->
  <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
  <script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
  

@yield('script')

</body>

</html>