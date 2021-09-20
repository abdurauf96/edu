<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Edu APP</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/fontawesome/css/all.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />


    <link href="/admin/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/my.css" rel="stylesheet" type="text/css" />

     <!-- Select2 -->
    <link rel="stylesheet" href="/admin/css/select2/select2.min.css">
     <!-- Theme style -->
     <link href="/admin/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    {{-- datatables --}}
    <link href="/admin/css/datatable/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('css')
  </head>
  <body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper" >

      <header class="main-header">
        <a href="{{ route('school.dashboard') }}" class="logo">
            <img src="/admin/images/logo.png" style="width:33px;" alt="">
            <b>Admin Panel</b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
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
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profil</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ route('school.logout') }}" class="btn btn-default btn-flat"   onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">Chiqish</a>
                        <form id="logout-form" action="{{ route('school.logout') }}" method="POST" style="display: none;">
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

      <!-- Left side column. contains the sidebar -->
     @include('school.sidebar')

      <!-- =============================================== -->

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <main class="py-4">
          @if (Session::has('flash_message'))
              <div class="container">
                  <div class=" col-lg-4 alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      {{ Session::get('flash_message') }}
                  </div>
              </div>
          @endif
        </main>
        <!-- Main content -->
        <section class="content">
             @yield('content')
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">

      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="/admin/js/jquery.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/admin/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- AdminLTE App -->
    <script src="/admin/js/app.min.js" type="text/javascript"></script>

    <script src="/admin/js/datatable/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="/admin/js/datatable/dataTables.bootstrap.min.js" type="text/javascript"></script>

    <!-- Select2 -->
    <script src="/admin/js/select2/select2.full.min.js"></script>
    <script type="text/javascript">
      $(function () {
          // Navigation active
          var url=window.location.pathname;

         $("a[href='"+ url +"']").parent().addClass('active');
         $("a[href='"+ url +"']").parent().parent().addClass('active');
         $("a[href='"+ url +"']").parent().parent().parent().addClass('active');

      });
  </script>
    @yield('js')

  </body>
</html>
