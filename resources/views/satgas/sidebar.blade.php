<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('satgas.home') }}" class="brand-link">
    <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div id="user-panel-container">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" id="user-panel">
        <div class="image">
          <?php 
          if (auth()->guard('satgas')->user()->img_adm != '') {
            $pp_adm = auth()->guard('satgas')->user()->img_adm;
          } else {
            $pp_adm = 'default-photo.png';
          }
          ?>
          <img src="{{ asset('adminlte/avatar/' . $pp_adm) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{-- route('account.index') --}}" class="d-block">{{ auth()->guard('satgas')->user()->nm_adm }}</a>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ route('satgas.home') }}"
            class="nav-link {{ request()->routeIs('satgas.home*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('kesehatan.index') }}"
            class="nav-link {{ request()->routeIs('kesehatan*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-book-medical"></i>
            <p>
              Kesehatan
            </p>
          </a>
        </li>
        <div class="divider"></div>
        <li class="nav-item">
          <a href="{{-- route('account.index') --}}"
            class="nav-link {{-- request()->routeIs('account.index*') ? 'active' : '' --}}">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Account
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('satgas.logout') }}" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>