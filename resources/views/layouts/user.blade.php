<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
  <title>Inventroy</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/morris/morris.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.circliful.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
  <!--[if lt IE 9]>
  <script src="assets/js/html5shiv.min.js"></script>
  <script src="assets/js/respond.min.js"></script>
 <![endif]-->
</head>

<body>
  <div class="main-wrapper">
    <div class="header">
      <div class="header-left">
        <a href="index.html" class="logo">
          <span>Inventroy</span>
        </a>
      </div>
      <div class="menubar">
        <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
      </div>

      <div class="searchbar">
        <form class="form-inline my-1 w-25 float-left">
          <input class="form-control mr-sm-2 search-input" type="search" placeholder="Search...">
        </form>
      </div>
      <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
      <ul class="nav user-menu float-right">
        <li class="nav-item dropdown has-arrow">
          <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
            <span class="user-img"><img class="rounded-circle" src="{{ asset('assets/img/user.jpg') }}" width="40"
                alt="Admin">
              <span class="status online"></span></span>
            <span>{{ auth()->user()->name }}</span>
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Logout</a>
            <form action="{{ route('logout') }}" id="logout-form" method="POST">
              @csrf</form>
          </div>
        </li>
      </ul>
      <div class="dropdown mobile-user-menu float-right">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
            class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="login.html">Logout</a>
        </div>
      </div>
    </div>
    <div class="sidebar" id="sidebar">
      <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
          <ul>
            <li class="menu-title">Main</li>
            <li class="">
              <a class="active" href="{{ route('user.dashboard') }}"><i class="fa fa-dashboard"></i>
                <span>Dashboard</span></a>
            </li>
            <li class="">
              <a class="active" href="{{ route('user.report') }}"><i class="fa fa-book"></i>
                <span>Report</span></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="page-wrapper">
      <div class="content">
        @yield('content')
      </div>
      <div class="notification-box">
        <div class="msg-sidebar notifications msg-noti">
          <div class="topnav-dropdown-header">
            <span>Messages</span>
          </div>
          <div class="drop-scroll msg-list-scroll" id="msg_list">
            <ul class="list-box">
              <li>
                <a href="chat.html">
                  <div class="list-item">
                    <div class="list-left">
                      <span class="avatar">R</span>
                    </div>
                    <div class="list-body">
                      <span class="message-author">Richard Miles </span>
                      <span class="message-time">12:28 AM</span>
                      <div class="clearfix"></div>
                      <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="chat.html">
                  <div class="list-item new-message">
                    <div class="list-left">
                      <span class="avatar">J</span>
                    </div>
                    <div class="list-body">
                      <span class="message-author">John Doe</span>
                      <span class="message-time">1 Aug</span>
                      <div class="clearfix"></div>
                      <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="chat.html">
                  <div class="list-item">
                    <div class="list-left">
                      <span class="avatar">T</span>
                    </div>
                    <div class="list-body">
                      <span class="message-author"> Tarah Shropshire </span>
                      <span class="message-time">12:28 AM</span>
                      <div class="clearfix"></div>
                      <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="chat.html">
                  <div class="list-item">
                    <div class="list-left">
                      <span class="avatar">M</span>
                    </div>
                    <div class="list-body">
                      <span class="message-author">Mike Litorus</span>
                      <span class="message-time">12:28 AM</span>
                      <div class="clearfix"></div>
                      <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="chat.html">
                  <div class="list-item">
                    <div class="list-left">
                      <span class="avatar">C</span>
                    </div>
                    <div class="list-body">
                      <span class="message-author"> Catherine Manseau </span>
                      <span class="message-time">12:28 AM</span>
                      <div class="clearfix"></div>
                      <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="chat.html">
                  <div class="list-item">
                    <div class="list-left">
                      <span class="avatar">D</span>
                    </div>
                    <div class="list-body">
                      <span class="message-author"> Domenic Houston </span>
                      <span class="message-time">12:28 AM</span>
                      <div class="clearfix"></div>
                      <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="chat.html">
                  <div class="list-item">
                    <div class="list-left">
                      <span class="avatar">B</span>
                    </div>
                    <div class="list-body">
                      <span class="message-author"> Buster Wigton </span>
                      <span class="message-time">12:28 AM</span>
                      <div class="clearfix"></div>
                      <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="chat.html">
                  <div class="list-item">
                    <div class="list-left">
                      <span class="avatar">R</span>
                    </div>
                    <div class="list-body">
                      <span class="message-author"> Rolland Webber </span>
                      <span class="message-time">12:28 AM</span>
                      <div class="clearfix"></div>
                      <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="chat.html">
                  <div class="list-item">
                    <div class="list-left">
                      <span class="avatar">C</span>
                    </div>
                    <div class="list-body">
                      <span class="message-author"> Claire Mapes </span>
                      <span class="message-time">12:28 AM</span>
                      <div class="clearfix"></div>
                      <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="chat.html">
                  <div class="list-item">
                    <div class="list-left">
                      <span class="avatar">M</span>
                    </div>
                    <div class="list-body">
                      <span class="message-author">Melita Faucher</span>
                      <span class="message-time">12:28 AM</span>
                      <div class="clearfix"></div>
                      <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="chat.html">
                  <div class="list-item">
                    <div class="list-left">
                      <span class="avatar">J</span>
                    </div>
                    <div class="list-body">
                      <span class="message-author">Jeffery Lalor</span>
                      <span class="message-time">12:28 AM</span>
                      <div class="clearfix"></div>
                      <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="chat.html">
                  <div class="list-item">
                    <div class="list-left">
                      <span class="avatar">L</span>
                    </div>
                    <div class="list-body">
                      <span class="message-author">Loren Gatlin</span>
                      <span class="message-time">12:28 AM</span>
                      <div class="clearfix"></div>
                      <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="chat.html">
                  <div class="list-item">
                    <div class="list-left">
                      <span class="avatar">T</span>
                    </div>
                    <div class="list-body">
                      <span class="message-author">Tarah Shropshire</span>
                      <span class="message-time">12:28 AM</span>
                      <div class="clearfix"></div>
                      <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
          <div class="topnav-dropdown-footer">
            <a href="chat.html">See all messages</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="sidebar-overlay" data-reff=""></div>
  <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
  <script src="{{ asset('assets/js/Chart.bundle.js') }}"></script>
  <script src="{{ asset('assets/js/chart.js') }}"></script>
  <script src="{{ asset('assets/plugins/morris/morris.js') }}"></script>
  <script src="{{ asset('assets/plugins/raphael/raphael-min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.circliful.min.js') }}"></script>
  <script src="{{ asset('assets/js/app.js') }}"></script>
  @include('partial.notify')
  @stack('page-script')
</body>

</html>
