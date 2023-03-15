<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('school.dashboard') }}"> <img alt="image" src="/admin/assets/img/logo.png" class="header-logo" /> <span
          class="logo-name">{{auth()->guard('user')->user()->school->company_name}}</span>
      </a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Main</li>
      <li class="dropdown active">
        <a href="{{ route('school.dashboard') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
      </li>
        @role('admin')
        <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-users-cog"></i><span>Adminstratsiya</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('users.index') }}">Foydalanuvchilar</a></li>
          <li><a class="nav-link" href="{{ route('logins.index') }}">Kirishlar tarixi</a></li>
{{--          <li><a class="nav-link" href="{{ route('roles.index') }}">Ro'llar</a></li>--}}
        </ul>
      </li>
        @endrole

        @role('admin|hr')
        <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-users-cog"></i><span>HR</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('events') }}">Monitoring</a></li>
                <li><a class="nav-link" href="{{ route('staffs.index') }}">Xodimlar</a></li>
                <li><a class="nav-link" href="{{ route('organizations.index') }}">Tashkilotlar</a></li>
            </ul>
        </li>
        @endrole

        @role('admin|manager')
       <li class="dropdown">
         <a href="{{ route('courses.index') }}" class="nav-link"><i data-feather="monitor"></i><span>Kurslar</span></a>
       </li>
       <li class="dropdown">
        <a href="{{ route('teachers.index') }}" class="nav-link"><i class="fas fa-chalkboard-teacher"></i>
         <span>O'qituvchilar</span>
        </a>
       </li>
       <li class="dropdown">
        <a href="{{ route('groups.index') }}" class="nav-link"><i class="fas fa-user-friends"></i> <span>Guruhlar</span>
        </a>
       </li>
        <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-users"></i><span>O'quvchilar</span></a>
            <ul class="dropdown-menu" >
                <li>
                    <a class="nav-link" href="{{ route('students.index')  }}">
                        O'quvchilar
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('waiting-students.index') }}">
                        Navbat kutayotganlar
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('waitingStudents.archive') }}">
                        Navbat arxivi
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('botStudents') }}">
                        Bot orqali ariza qoldirganlar
                    </a>
                </li>

                <li>
                    <a class="nav-link" href="{{ route('appeals.index') }}">
                        Ariza qoldirganlar
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('students.statistics') }}">
                        Statistika
                    </a>
                </li>

            </ul>
        </li>
        {{--xisobotlar--}}
        <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-money-check-alt"></i><span>Xisobotlar</span></a>
            <ul class="dropdown-menu" >
                <li>
                    <a href="{{ route('reports.students') }}">
                        O'quvchilar
                    </a>
                </li>
                <li>
                    <a href="{{ route('reports.groups') }}">
                        Guruhlar
                    </a>
                </li>
                <li>
                    <a href="{{ route('reports.courses') }}">
                        Kurs samaradorligi
                    </a>
                </li>
                <li>
                    <a href="{{ route('reports.teachers') }}">
                        O'qituvchi samaradorligi
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="{{ route('todayGroups') }}" class="nav-link">
                <i data-feather="monitor"></i> <span>Bugungi darslar</span>
            </a>
        </li>
        <li class="dropdown">
            <a href="{{ route('school.groups.selectManagers') }}" class="nav-link">
                <i class="fas fa-school"></i> <span>Guruhlarni tanlash</span>
            </a>
        </li>
        @endrole

        @role('cashier|admin|manager')
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-money-check-alt"></i><span>Buxgalteriya</span></a>
        <ul class="dropdown-menu" >
          <li>
            <a href="{{ route('payments.index') }}">
              To'lovlar
            </a>
          </li>
            <li>
                <a href="{{ route('payments.statistics') }}">
                    Qarzdorlik statistikasi
                </a>
            </li>
            <li>
                <a href="{{ route('payments.results') }}">
                    To'lovlar grafigi
                </a>
            </li>
            <li>
                <a href="{{ route('payments.debtors') }}">
                    Qarzdorlar
                </a>
            </li>
            @role('cashier|admin')
            <li>
                <a href="{{ route('payment-activities') }}">
                    Oylik to'lovlar yechilishi
                </a>
            </li>
            @endrole
        </ul>
      </li>
        @endrole
    </ul>
  </aside>
