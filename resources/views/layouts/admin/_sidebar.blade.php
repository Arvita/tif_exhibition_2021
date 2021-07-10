<aside class="main-sidebar sidebar-dark-info elevation-1">
    <a href="{{ url('/admin') }}" class="brand-link navbar-white text-center p-2 font-weight-bold">
        <img src="{{ url(asset('img/navbar-brand.svg')) }}" alt="{{ env('APP_NAME') }}" height="40">
    </a>

    <div class="sidebar os-theme-light os-host-overflow">
        <div class="user-panel mt-2 pb-2 mb-2 d-flex">
            <div class="image">
                @if (substr(Auth::user()->avatar, 0, 4) == 'http')
                    <img src="{{ Auth::user()->avatar }}" class="img-circle" alt=" ">
                @else
                    <img src="{{ url(asset('img/users/'.Auth::user()->avatar)) }}" class="img-circle" alt=" ">
                @endif
            </div>
            <div class="info">
                <span class="text-light">{{ Auth::user()->username }}</span>
            </div>
            <div class="info ml-auto">
                <a class="small btn btn-link btn-xs" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    <i class="icon-logout"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/admin') }}" class="nav-link{{ $data['npage'] == 0 ? ' active' : '' }}">
                        <i class="nav-icon icofont-speed-meter"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header font-weight-bold text-muted">DATA MASTER</li>
                <li class="nav-item">
                    <a href="{{ url('/admin/product') }}" class="nav-link{{ $data['npage'] == 1 ? ' active' : '' }}">
                        <i class="nav-icon icofont-cubes"></i>
                        <p>Data Produk</p>
                    </a>
                </li>

                @if(Auth::user()->role == 0)
                <li class="nav-header font-weight-bold text-muted">KONFIGURASI</li>
                <li class="nav-item has-treeview{{ $data['npage'] == 9 ? ' menu-open' : '' }}">
                    <a href="#" class="nav-link{{ $data['npage'] == 9 ? ' active' : '' }}">
                        <i class="nav-icon icofont-ui-settings"></i>
                        <p>Konfigurasi<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/admin/user') }}" class="nav-link{{ $data['npage'] == 9 ? ' active' : '' }}">
                                <i class="nav-icon icofont-user-alt-4"></i>
                                <p>Data Pengguna</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>