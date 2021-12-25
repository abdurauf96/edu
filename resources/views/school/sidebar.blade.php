<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('school.dashboard') }}"> <img alt="image" src="/admin/assets/img/logo.png" class="header-logo" /> <span
          class="logo-name">{{auth()->user()->school->company_name}}</span>
      </a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Main</li>
      <li class="dropdown active">
        <a href="{{ route('school.dashboard') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
      </li>

      @if(Auth::check() && Auth::user()->hasRole('admin'))
      @foreach($laravelAdminMenus->menus as $section)
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i
            data-feather="briefcase"></i><span>{{ $section->section }}</span></a>
        @if($section->items)
        <ul class="dropdown-menu">
          @foreach($section->items as $menu)
          <li><a class="nav-link" href="{{ url($menu->url) }}">{{ $menu->title }}</a></li>
          @endforeach
        @endif
        </ul>
      </li>
      @endforeach
      @endif
      <li class="dropdown">
        <a href="{{ route('courses.index') }}" class="nav-link"><i data-feather="monitor"></i><span>Kurslar</span></a>
      </li>

      <li class="dropdown">
        <a href="{{ route('teachers.index') }}" class="nav-link"><i data-feather="monitor"></i>
         <span>O'qituvchilar</span>
        </a>
      </li>
      <li class="dropdown">
        <a href="{{ route('groups.index') }}" class="nav-link"><i data-feather="monitor"></i> <span>Guruhlar</span>
        </a>
      </li>

      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i
          data-feather="briefcase"></i><span>O'quvchilar</span></a>

          <ul class="dropdown-menu" >
              <li>
                  <a class="nav-link" href="{{ route('students.index') }}">
                       Joriy o'quvchilar
                  </a>
              </li>
              <li>
                  <a class="nav-link" href="{{ route('waiting-students.index') }}">
                     Navbat kutayotganlar
                  </a>
              </li>
              <li>
                <a class="nav-link" href="{{ route('botStudents') }}">
                    Ariza qoldirganlar
                </a>
              </li>
              <li>
                <a class="nav-link" href="{{ route('studentQrcodes') }}">
                    QR kodlar
                </a>
              </li>
              <li>
                <a class="nav-link" href="{{ route('changeStudentGroup') }}">
                    O'quvchilarni ko'chirish
                </a>
              </li>
          </ul>
      </li>

      <li class="dropdown">
        <a href="{{ route('events') }}" class="nav-link">
          <i data-feather="monitor"></i> <span>Monitoring</span>
        </a>
      </li>
      <li class="dropdown">
        <a href="{{ route('staffs.index') }}" class="nav-link">
          <i data-feather="monitor"></i><span>Xodimlar</span>
        </a>
      </li>
     @if(Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('cashier')) )
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i
          data-feather="briefcase"></i><span>Buxgalteriya</span></a>

        <ul class="dropdown-menu" >

          <li>
            <a href="{{ route('payments.index') }}">
              To'lovlar
            </a>
          </li>

           <li>
             <a href="{{ route('cashierTable') }}">
               Ko'rish
             </a>
           </li>
            @if(Auth::user()->hasRole('admin'))
            <li>
                <a href="{{ route('paymentStatistics') }}">
                    Statistika
                </a>
            </li>
            @endif
        </ul>
      </li>
      @endif

    </ul>
  </aside>