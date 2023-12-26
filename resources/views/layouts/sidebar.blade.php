<header id="page-topbar">
  <div class="navbar-header">
    <div class="d-flex">
      <!-- LOGO -->
      <div class="navbar-brand-box">
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light" style="font-size: 1.2rem; color: #fff">
          LASCURT HOTEL
        </a>
      </div>

      <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
        <i class="mdi mdi-menu"></i>
      </button>

    </div>

    <div class="d-flex">
      <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
          data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="rounded-circle header-profile-user" src="{{ getImage(auth()->user()->image) }}"
            alt="{{ auth()->user()->unsername ?? 'User' }}" />
        </button>
        <div class="dropdown-menu dropdown-menu-end">
          <!-- item-->
          <a class="dropdown-item d-flex" href="#"><i
              class="mdi mdi-account-circle font-size-17 text-muted align-middle me-1"></i>
            <div>
              <small> {{ auth()->user()->name }}</small><br>
              <small class="d-block text-center font-weight-bold">{{ auth()->user()->getRoleNames()[0] }}</small>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          {{-- <a class="dropdown-item" href="#"><i
              class="mdi mdi-account-circle font-size-17 text-muted align-middle me-1"></i>
            Profile</a> --}}
          <a class="dropdown-item d-flex align-items-center" href="#"><i
              class="mdi mdi-cog font-size-17 text-muted align-middle me-1"></i>
            Settings<span class="badge bg-success ms-auto">11</span></a>
          <a class="dropdown-item" href="#"><i
              class="mdi mdi-lock-open-outline font-size-17 text-muted align-middle me-1"></i>
            Lock screen</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" href="javascript:void(0)"
            onClick="event.preventDefault(); document.getElementById('logout-form').submit()"><i
              class="mdi mdi-power font-size-17 text-muted align-middle me-1 text-danger"></i>
            Logout</a>
          <form action="{{ route('logout') }}" id="logout-form" method="POST">
            @csrf</form>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- ========== Left Sidebar Start ========== -->
<!-- <div class="vertical-menu">
  <div data-simplebar class="h-100">
    <div id="sidebar-menu">
      <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Main</li>

        <li class="{{ str_contains($page, 'admin.dashboard') ? 'mm-active' : '' }}">
          <a href="{{ route('admin.dashboard') }}"
            class="waves-effect {{ str_contains($page, 'admin.dashboard') ? 'active' : '' }}">
            <i class="mdi mdi-view-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="menu-title">Rooms Management</li>


        <li class="{{ str_contains($page, 'admin.room-management') ? 'mm-active' : '' }}">
          <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="mdi mdi-hospital-building"></i>
            <span>Rooms Management</span>
          </a>
          <ul class="sub-menu {{ str_contains($page, 'admin.room-management') ? 'mm-show' : '' }}"
            aria-expanded="false">
            @can('building-read')
              <li><a href="{{ route('admin.building.index') }}"
                  class="{{ str_contains($page, 'admin.room-management.building') ? 'active' : '' }}">Buildings</a></li>
            @endcan
            @can('floor-read')
              <li><a href="{{ route('admin.floor.index') }}"
                  class="{{ str_contains($page, 'admin.room-management.floor') ? 'active' : '' }}">Floors</a></li>
            @endcan
            @can('category-read')
              <li><a href="{{ route('admin.category.index') }}"
                  class="{{ str_contains($page, 'admin.room-management.category') ? 'active' : '' }}">Categories</a></li>
            @endcan
            @can('amenity-read')
              <li><a href="{{ route('admin.amenity.index') }}"
                  class="{{ str_contains($page, 'admin.room-management.amenity') ? 'active' : '' }}">Amenities</a></li>
            @endcan
            @can('room-read')
              <li><a class="{{ str_contains($page, 'admin.room-management.rooms') ? 'active' : '' }}"
                  href="{{ route('admin.room.index') }}">Rooms</a></li>
            @endcan
          </ul>
        </li>

        <li class="menu-title">Bookings</li>
        @can('frontdesk-read')
          <li class="{{ str_contains($page, 'admin.frontdesk') ? 'mm-active' : '' }}">
            <a href="{{ route('admin.frontdesk') }}"
              class="waves-effect {{ str_contains($page, 'admin.frontdesk') ? 'active' : '' }}">
              <i class="mdi mdi-format-list-bulleted-type"></i>
              <span>Frontdesk</span>
            </a>
          </li>
        @endcan

        <li class="{{ str_contains($page, 'admin.reservation') ? 'mm-active' : '' }}">
          <a href="{{ route('admin.booking.reservation') }}"
            class="waves-effect {{ str_contains($page, 'admin.reservation') ? 'active' : '' }}">
            <i class="mdi mdi-format-list-bulleted-type"></i>
            <span>Reservation</span>
          </a>
        </li>

        @can('booking')
          <li class="{{ str_contains($page, 'admin.booking.list') ? 'mm-active' : '' }}">
            <a href="{{ route('admin.booking.list') }}"
              class="waves-effect {{ str_contains($page, 'admin.booking.list') ? 'active' : '' }}">
              <i class="mdi mdi-format-list-bulleted-type"></i>
              <span>Bookings</span>
            </a>
          </li>
        @endcan
        <li class="menu-title">Reports</li>
        <li class="{{ str_contains($page, 'admin.report') ? 'mm-active' : '' }}">
          <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="mdi mdi-account"></i>
            <span>Reports</span>
          </a>
          <ul class="sub-menu {{ str_contains($page, 'admin.admin.report') ? 'mm-show' : '' }}" aria-expanded="false">
            @can('discount-report')
              <li><a href="{{ route('admin.report.discount') }}"
                  class="{{ str_contains($page, 'admin.report.discount') ? 'active' : '' }}">Discount Report</a>
              </li>
            @endcan
            @can('debt-report')
              <li>
                <a href="{{ route('admin.report.debt') }}"
                  class="{{ str_contains($page, 'admin.report.debt') ? 'active' : '' }}">Debt Report</a>
              </li>
            @endcan
            @can('cancel-report')
              <li>
                <a href="{{ route('admin.report.cancel') }}"
                  class="{{ str_contains($page, 'admin.report.cancel') ? 'active' : '' }}">Cancel Report</a>
              </li>
            @endcan
            @can('reserve-report')
              <li>
                <a href="{{ route('admin.report.reserve') }}"
                  class="{{ str_contains($page, 'admin.report.reserve') ? 'active' : '' }}">Reserve Report</a>
              </li>
            @endcan
            @can('vacant-report')
              <li>
                <a href="{{ route('admin.report.vacant') }}"
                  class="{{ str_contains($page, 'admin.report.vacant') ? 'active' : '' }}">Vacant Report</a>
              </li>
            @endcan

            <li>
              <a href="{{ route('admin.report.general') }}"
                class="{{ str_contains($page, 'admin.report.general') ? 'active' : '' }}">General Report</a>
            </li>

          </ul>
        </li>

        <li class="{{ str_contains($page, 'admin.customer.index') ? 'mm-active' : '' }}">
          <a href="{{ route('admin.customer.index') }}"
            class="waves-effect {{ str_contains($page, 'admin.system.index') ? 'active' : '' }}">
            <i class="mdi mdi-format-list-bulleted-type"></i>
            <span>Customers Record</span>
          </a>
        </li>

        <li class="menu-title">Users Management</li>
        <li class="{{ str_contains($page, 'admin.users-management') ? 'mm-active' : '' }}">
          <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="mdi mdi-account"></i>
            <span>Users Management</span>
          </a>
          <ul class="sub-menu {{ str_contains($page, 'admin.user-management') ? 'mm-show' : '' }}"
            aria-expanded="false">
            @can('roles-read')
              <li><a href="{{ route('admin.role.index') }}"
                  class="{{ str_contains($page, 'admin.users-management.roles') ? 'active' : '' }}">Roles &
                  Permissions</a></li>
            @endcan
            @can('user-create')
              <li><a href="{{ route('admin.user.create') }}"
                  class="{{ str_contains($page, 'admin.users-management.create-user') ? 'active' : '' }}">Create
                  User</a>
              </li>
            @endcan
            @can('user-read')
              <li><a href="{{ route('admin.user.index') }}"
                  class="{{ str_contains($page, 'admin.users-management.users') ? 'active' : '' }}">Users</a></li>
            @endcan
          </ul>
        </li>
        @can('system-read')
          <li class="{{ str_contains($page, 'admin.system.index') ? 'mm-active' : '' }}">
            <a href="{{ route('admin.system.index') }}"
              class="waves-effect {{ str_contains($page, 'admin.system.index') ? 'active' : '' }}">
              <i class="mdi mdi-format-list-bulleted-type"></i>
              <span>System Config</span>
            </a>

          </li>
        @endcan

        @can('system-read')
          <li class="{{ str_contains($page, 'admin.end-business.index') ? 'mm-active' : '' }}">
            <a href="{{ route('admin.end-business.index') }}"
              class="waves-effect {{ str_contains($page, 'admin.end-business.index') ? 'active' : '' }}">
              <i class="mdi mdi-format-list-bulleted-type"></i>
              <span>End Busness Day</span>
            </a>

          </li>
        @endcan
      </ul>
    </div>
  </div> -->
</div>
