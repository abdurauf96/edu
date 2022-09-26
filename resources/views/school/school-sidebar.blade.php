<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a style="letter-spacing:0 " href="{{ route('school.dashboard') }}"> <img alt="image" src="/logo/dcschool.png" class="header-logo" /> <span
          class="logo-name">{{auth()->guard('user')->user()->school->company_name}}</span>
      </a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Main</li>
      <li class="dropdown">
        <a href="{{ route('school.dashboard') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
      </li>

    {{--      permission--}}
{{--      <li class="dropdown">--}}
{{--        <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-users-cog"></i><span>Adminstratsiya</span></a>--}}
{{--        <ul class="dropdown-menu">--}}
{{--          <li><a class="nav-link" href="{{ route('users.index') }}">Foydalanuvchilar</a></li>--}}
{{--        </ul>--}}
{{--      </li>--}}


      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-users-cog"></i><span>Profil</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('documents.index') }}">Darsliklar</a></li>
          <li><a class="nav-link" href="{{ route('school.contacts.index') }}">Adminga murojat</a></li>
          <li><a class="nav-link" href="{{ route('profile.index') }}">Markaz haqida</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a href="{{ route('courses.index') }}" class="nav-link"><i data-feather="monitor"></i><span>Kurslar</span></a>
      </li>

      <li class="dropdown">
        <a href="{{ route('teachers.index') }}" class="nav-link"><i class="fas fa-chalkboard-teacher"></i>
         <span>O'qituvchilar</span>
        </a>
      </li>
      <li class="dropdown">
        <a href="{{ route('groups.index', ['year'=>date('Y')]) }}" class="nav-link"><i class="fas fa-user-friends"></i> <span>Guruhlar</span>
        </a>
      </li>
      <li class="dropdown">
        <a href="{{ route('students.index') }}" class="nav-link"><i class="fas fa-users"></i> <span>O'quvchilar</span>
        </a>
      </li>

      <li class="dropdown">
        <a href="{{ route('classes.index') }}" class="nav-link">
          <i class="fas fa-school"></i> <span>Sinflar</span>
        </a>
      </li>
      <li class="dropdown">
        <a href="{{ route('sertificatedStudents') }}" class="nav-link">
          <i class="fas fa-school"></i> <span>Sertifikatlar</span>
        </a>
      </li>
    </ul>
  </aside>
