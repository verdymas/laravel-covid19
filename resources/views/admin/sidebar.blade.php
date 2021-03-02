<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div id="user-panel-container">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex" id="user-panel">
                <div class="image">
                    <?php
                    if (auth()->guard('admin')->user()->img_adm != '') {
                        $pp_adm = auth()->guard('admin')->user()->img_adm;
                    } else {
                        $pp_adm = 'default-photo.png';
                    }
                    ?>
                    <img src="{{ asset('adminlte/avatar/' . $pp_adm) }}" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="{{-- route('account.index') --}}"
                       class="d-block">{{ auth()->guard('admin')->user()->nm_adm }}</a>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}"
                       class="nav-link {{ request()->routeIs('admin.home*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->is('*/data/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('*/data/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('kartu-keluarga.index') }}"
                               class="nav-link {{ request()->routeIs('kartu-keluarga*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kartu Keluarga</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('warga.index') }}"
                               class="nav-link {{ request()->routeIs('warga*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Warga</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('satgas.index') }}"
                               class="nav-link {{ request()->routeIs('satgas*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Satgas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('bantuan.index') }}"
                       class="nav-link {{ request()->routeIs('bantuan*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Bantuan
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
                    <a href="{{ route('admin.logout') }}" class="nav-link">
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
