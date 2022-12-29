<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title', 'Admin Dashboard') - EDUAPP</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/admin/assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="/admin/assets/css/style.css">
  <link rel="stylesheet" href="/admin/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="/admin/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='/admin/assets/img/favicon.ico' />
  @yield('css')
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  <div class="loader"></div>
  <div id="adminApp">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>

          </ul>
        </div>
        <ul class="navbar-nav navbar-right">

          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="/admin/assets/img/user.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">{{ auth()->user()->name }}</div>
              <a href="#" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
               <i class="fas fa-sign-out-alt"></i>
                Chiqish
              </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
               </form>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
              <a href="#"> <img alt="image" src="/admin/assets/img/logo.png" class="header-logo" /> <span
                  class="logo-name">{{ auth()->user()->name}}</span>
              </a>
            </div>
            <ul class="sidebar-menu">

              <li class="dropdown">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i data-feather="home"></i><span>Dashboard</span></a>
              </li>
              <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-users-cog"></i><span>Ma'muriyat</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.users.index') }}">Foydalanuvchilar</a></li>
{{--                    <li><a class="nav-link" href="{{ route('roles.index') }}">Ro'llar</a></li>--}}
                </ul>
              </li>
              <li class="dropdown">
                <a href="{{ route('admin.schools') }}" class="nav-link"><i class="material-icons">location_city</i><span>O'quv markazlar</span></a>
              </li>
               
              <li class="dropdown">
                  <a href="{{ route('admin.students') }}" class="nav-link"><i class="material-icons">location_city</i><span>O'quvchilar</span></a>
              </li>
              <li class="dropdown">
                  <a href="{{ route('admin.districts.index') }}" class="nav-link"><i class="material-icons">location_city</i><span>Tumanlar</span></a>
              </li>
            </ul>
          </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
            @yield('content')
        </section>
        <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          <a href="#">Digital City</a></a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  {{-- <script src="/js/app.js"></script> --}}
  <script src="/admin/assets/js/app.min.js"></script>

  <!-- Page Specific JS File -->
  {{-- <script src="/admin/assets/js/page/index.js"></script> --}}
  <!-- Template JS File -->
  <script src="/admin/assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="/admin/assets/js/custom.js"></script>
  @yield('js')
  <script>
      var url=window.location.href;
      a=document.querySelectorAll("[href='"+url+"']")[0];
      a.parentElement.classList.add('active');
      a.parentElement.parentElement.style.display="block";

  </script>

  @stack('js')
  @livewireScripts
</body>
</html>
