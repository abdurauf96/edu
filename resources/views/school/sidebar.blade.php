<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/admin/images/admin.png" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
          <p>{{ Auth()->user()->name }}</p>

          <a href="#"><i class="fa fa-circle text-success"></i> Online </a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu ">
        @if(Auth::check() && Auth::user()->hasRole('admin'))
          @foreach($laravelAdminMenus->menus as $section)
          <li class="treeview">
            <a href="#">
              <i class="fa fa-edit"></i> <span>{{ $section->section }}</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            @if($section->items)
            <ul class="treeview-menu" >
              @foreach($section->items as $menu)
              <li><a class="menu-url" href="{{ url($menu->url) }}"><i class="fa fa-circle-o"></i> {{ $menu->title }}</a></li>
              @endforeach
            </ul>
            @endif
          </li>
          @endforeach
        @endif
        <li class="treeview">
          <a href="{{ route('courses.index') }}">
            <i class="fa fa-desktop"></i> <span>Kurslar</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ route('teachers.index') }}">
            <i class="fa fa-graduation-cap"></i> <span>O'qituvchilar</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ route('groups.index') }}">
            <i class="fa fa-group"></i> <span>Guruhlar</span>
          </a>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-user"></i> <span>O'quvchilar</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu" >
                <li class="treeview">
                    <a href="{{ route('students.index') }}">
                        <i class="fa fa-user"></i> <span>Joriy o'quvchilar</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="{{ route('waiting-students.index') }}">
                        <i class="fa fa-user"></i> <span>Navbat kutayotganlar</span>
                    </a>
                </li>
                <li class="treeview">
                  <a href="{{ route('botStudents') }}">
                      <i class="fa fa-user"></i> <span>Ariza qoldirganlar</span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ route('studentQrcodes') }}">
                      <i class="fa fa-user"></i> <span>QR kodlar</span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="{{ route('changeStudentGroup') }}">
                      <i class="fa fa-user"></i> <span>O'quvchilarni ko'chirish</span>
                  </a>
                </li>
            </ul>
        </li>

        <li class="treeview">
          <a href="{{ route('events') }}">
            <i class="fa fa-clock-o"></i> <span>Monitoring</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ route('staffs.index') }}">
            <i class="fa fa-group"></i> <span>Xodimlar</span>
          </a>
        </li>
       @if(Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('cashier')) )
        <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i> <span>Buxgalteriya</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu" >

            <li class="treeview">
              <a href="{{ route('payments.index') }}">
                <i class="fa fa-money"></i> <span>To'lovlar</span>
              </a>
            </li>

             <li class="treeview">
               <a href="{{ route('cashierTable') }}">
                 <i class="fa fa-money"></i> <span>Ko'rish</span>
               </a>
             </li>
              @if(Auth::user()->hasRole('admin'))
              <li class="treeview">
                  <a href="{{ route('paymentStatistics') }}">
                      <i class="fa fa-money"></i> <span>Statistika</span>
                  </a>
              </li>
              @endif
          </ul>
        </li>
        @endif
        <li class="treeview">
          <a href="{{ route('schoolReception') }}">
            <i class="fa fa-check-circle"></i> <span>Reception</span>
          </a>
        </li>
      </ul>
  </aside>