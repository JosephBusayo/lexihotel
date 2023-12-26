<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Lascurt Hotel || {{ $pageTitle ?? '' }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

  <!-- Bootstrap Css -->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
  <!-- Icons Css -->
  <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
  @stack('page-styles')
</head>

<body data-sidebar="dark">

  <!-- Begin page -->
  <div id="layout-wrapper">
    {{-- =========SIDEBAR=========== --}}
    @include('layouts.sidebar')

    {{-- ===========CONTENTS ======== --}}
    <!-- ==============Start right Content here================================= -->
    <div class="main-content">
      <!-- Start content -->
      <div class="page-content">
        @yield('content')
      </div>
      {{-- footer --}}
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              ©
              {{ date('Y') }}
              Lexispos
              <span class="d-none d-sm-inline-block">
                - Crafted with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </div>
        </div>
      </footer>
      <!-- ============================================================== -->
      <!-- End Right content here -->
      <!-- ============================================================== -->

    </div>
  </div>
  <!-- JAVASCRIPT -->
  <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
  <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
  <script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

  <!--Morris Chart-->
  <script src="{{ asset('assets/libs/morris.js') }}/morris.min.js')}}"></script>
  <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
  <script src="{{ asset('assets/js/app.js') }}"></script>
  @include('partial.notify')
  @stack('page-scripts')

</body>

</html>
