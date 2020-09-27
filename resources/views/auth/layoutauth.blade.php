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


  <div class="container pt-5">
    @yield('content')
  </div>
  
  <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script type="text/javascript" src="{{ URL::asset('js/si_cepat_fare.js') }}"></script>
  @yield('script')
</body>
</html>