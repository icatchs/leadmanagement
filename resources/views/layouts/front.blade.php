<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ url('assets/images/ficon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}" />
   <!--  <link rel="stylesheet" href="{{ URL::asset('assets/images/favicon.ico') }}" /> -->

  </head>
  <body>
    <div class="container-scroller">
  
    @include('partials.front.navbar')
      <!-- partial -->
      <div class="container-fluid">

          @yield('content')
         
    
      </div>  
    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>