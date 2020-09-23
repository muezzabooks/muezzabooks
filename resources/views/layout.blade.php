<!DOCTYPE html>
<html lang="en" style="min-height: 100%">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Muezza Books</title>

	<link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link href="css/one-page-wonder.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-light navbar-custom shadow-sm">
    <div class="container">
      <a class="navbar-brand order-first" href="{{ route('home') }}">
        <img class="img-nav" src="{{ ('/assets/images/logo-muezza.png') }}" >
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      {{-- VISIBLE ONLY ON SM --}}
      <div class="d-none d-sm-block d-md-none d-flex flex-row w-auto order-first ml-5">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('cart') }}">
              <i class="fa fa-shopping-cart fa-lg"></i>
            </a>
          </li>
        </ul>
      </div>
      
      <div class="collapse navbar-collapse order-last" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          {{-- VISIBLE ONLY ON MD --}}
          <div class="d-none d-md-block d-sm-none">
            <li class="d-flex nav-item mr-4">
              <a class="nav-link" href="{{ route('cart') }}">
                <i class="fa fa-shopping-cart fa-lg"></i>
              </a>
            </li>
          </div>
          
          @guest
          <li class="nav-item" style="margin-right: 1em">
            <a class="nav-link btn btn-sm btn-outline-yellow" href="{{ route('transaction.check') }}">Cek Transaksi</a>
          </li> 
            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link btn" href="{{ route('register') }}">Sign Up</a>
              </li>
            @endif
            <li class="nav-item">
              <a class="nav-link btn" href="{{ route('login') }}">Log In</a>
            </li>
            @else
              <li class="nav-item">
                <a href="{{ route('mytransaction',auth()->user()->id) }}" style="margin-right: 1em" class="desktop btn-outline-yellow btn">My Transaction</a>
                <a href="{{ route('mytransaction',auth()->user()->id) }}" style="margin-bottom: 1em" class="mobile btn-outline-yellow btn btn-block">My Transaction</a>
              </li>
              <li class="nav-item">
                
              </li>
          @endguest

          @auth
          {{-- VISIBLE ONLY ON SM --}}
          <li class="nav-item">
            <div class="d-sm-block d-md-none">
              <form id="logout-btn" class="mobile d-inline" method="POST" action="{{ route('logout') }}">
                @csrf
                <input type="submit" class="w-100 btn btn-outline-danger" value="{{__('Logout')}}">
              </form>
            </div>
          </li>
          {{-- VISIBLE ONLY ON MD --}}
          <div class="d-none d-md-block d-sm-none">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user fa-lg"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a href="{{ route('logout') }}" class="dropdown-item text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" class="d-inline" method="POST" action="{{ route('logout') }}">
                  @csrf
                </form>
              </div>
            </li>
          </div>
          @endauth
          
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    @yield('content')
  </div>
	

	 <!-- Footer -->
   <footer class="py-3 btn-yellow footer">
      <div class="container-fluid">
        <p class="m-0 text-center text-black large">Copyright &copy; Your Website 2020</p>
      </div>
      <!-- /.container -->
    </footer>
  
  <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script type="text/javascript" src="{{ URL::asset('js/si_cepat_fare.js') }}"></script>
  @yield('script')
</body>
</html>