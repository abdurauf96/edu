
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>EDU APP</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    {{-- <link href="/admin/fontawesome/css/all.css" rel="stylesheet" type="text/css" /> --}}
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />


    <link href="/admin/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/my.css" rel="stylesheet" type="text/css" />


     <!-- Theme style -->
     <link href="/admin/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('css')
  </head>
  <body class="skin-blue sidebar-collapse sidebar-open">
    <!-- Site wrapper -->
    <div class="wrapper" id="app">

      <header class="main-header">

        <a href="/dashboard" class="logo">
          <img src="/admin/images/logo.png" style="width:33px;" alt="">
          <b>Dashboard</b>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="/admin/images/logo.png" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">Raqamli shahar</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="/admin/images/logo.png" class="img-circle" alt="User Image" />
                    <p>
                      Raqamli shahar
                      <small>2021</small>
                    </p>
                  </li>
                  <!-- Menu Body -->

                  <!-- Menu Footer-->
                  <li class="user-footer">

                    <div class="pull-right">
                      <a href="{{ route('logout') }}" class="btn btn-default btn-flat"   onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">Chiqish</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>


      <!-- =============================================== -->

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
             @yield('content')
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

    </div><!-- ./wrapper -->
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"> </script>

    <script src="{{ asset('/js/app.js') }}"  ></script>


    @yield('js')

  </body>
</html>
