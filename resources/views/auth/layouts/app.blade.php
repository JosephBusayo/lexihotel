<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Web Application Powered By LexisPOS">
  <meta name="keywords" content="Web Application Powered By LexisPOS">
  <title>Authentication</title>
  <link rel="apple-touch-icon" href="{{ asset('assets-old/images/favicon/apple-touch-icon-152x152.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets-old/images/favicon/favicon-32x32.png') }}">
  <!--vendor css ends-->
  <!--page level css starts-->
  <link rel="stylesheet" type="text/css"
    href="{{ asset('assets-old/css/themes/vertical-modern-menu-template/materialize.css') }}">
  <link rel="stylesheet" type="text/css"
    href="{{ asset('assets-old/css/themes/vertical-modern-menu-template/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets-old/css/pages/login.css') }}">
  <!--page level css ends-->
  <!--custom style starts-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets-old/css/custom/custom.css') }}">
  <!--custom css ends-->
</head>

<body
  class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 1-column login-bg blank-page"
  data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
  <div class="row">
    <div class="col s6 offset-s3">
      <div class="card-alert card gradient-45deg-green-teal hide" id="log">
        <div class="card-content white-text">
          <p></p>
        </div>
        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col s12">
      <div class="container">
        <div id="login-page" class="row">
          <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
            @yield('content')
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min') }}'"></script>
  @include('partial.notify')
</body>

</html>
