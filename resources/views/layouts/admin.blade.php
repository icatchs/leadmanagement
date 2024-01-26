<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ url('assets/images/ficon.png') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/vendors/css/vendor.bundle.base.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="{{ URL::asset('assets/css/dashboard.css') }}" />
    

  </head>
  <body>
    <div class="container-scroller">
  
    @include('partials.back.navbar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        @include('partials.back.sidebar')
        <div class="main-panel">
          <div class="content-wrapper">
         
            @yield('content')
          </div>
          @include('partials.back.footer')
        </div>
      </div>  
    </div>
 
    <!-- <script type="text/javascript" src="{{ URL::asset('assets/vendors/js/vendor.bundle.base.js') }}"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/off-canvas.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/hoverable-collapse.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/misc.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/todolist.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/dashboard.js') }}"></script>
    
   
  

  </body>
</html>