<!DOCTYPE html>
<html lang="en" style="min-height: 100%">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel</title>

	<link rel="stylesheet" href="{{ mix('css/app.css') }}">
	<link href="css/one-page-wonder.min.css" rel="stylesheet">
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <div class="container">
	  <a class="navbar-brand" href="{{ route('home') }}">
		<img class="img-nav" src="{{ ('assets/images/logo-muezza.png') }}" >
	 </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          @guest

            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
              </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Log In</a>
            </li>
            @else
              <li>
                <form id="logout-btn" class="d-inline" method="POST" action="{{ route('logout') }}">
                  @csrf
                  <input type="submit" class="btn btn-danger" value="{{__('Logout')}}">
                </form>
              </li>
          @endguest
          
          
        </ul>
      </div>
    </div>
  </nav>


		@yield('content')


	

	 <!-- Footer -->
	 <footer class="py-5 bg-warning">
		<div class="container">
		  <p class="m-0 text-center text-black large">Copyright &copy; Your Website 2020</p>
		</div>
		<!-- /.container -->
	  </footer>
  
  <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
</body>
</html>