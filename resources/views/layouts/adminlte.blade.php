<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ env('APP_DESC') }}">
    <meta name="author" content="{{ env('WEB_AUTHOR') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="32x32" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('plugins/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/assets/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/assets/owl.theme.default.min.css') }}">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
    <!-- Leaflet -->
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('src/extra-markers/css/leaflet.extra-markers.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/fullscreen/leaflet.fullscreen.css') }}" />
    <link rel="stylesheet" href="{{ asset('src/locate/L.Control.Locate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('src/geocoder/esri-leaflet-geocoder.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container-fluid">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <img src="{{ asset('img/navbar-brand.svg') }}" alt="{{ config('app.name') }}" class="brand-image">
                </a>
                
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    @guest
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        </ul>
                    @else
                        {{-- <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#">{{ __('Post') }}</a>
                            </li>
                        </ul> --}}
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ url('admin') }}">{{ __('Halaman Admin') }}</a></li>
                                    <li class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>                                    
                                </ul>
                            </li>
                        </ul>
                    @endguest
                </div>
            </div>
        </nav>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    @include('layouts._alert')
                </div>
            </div>
            <div class="content">
                @yield('content')
            </div>
        </div>
        <footer class="main-footer">
            {{-- <div class="float-right d-none d-sm-inline"></div> --}}
            <strong>Copyright &copy; 2020 SIG Daerah Rawan Longsor</strong>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('plugins/owl-carousel/owl.carousel.min.js') }}"></script>  
    <!-- Ekko Lightbox -->
    <script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <!-- Leaflet JS-->
    <script src="{{ asset('leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('src/fullscreen/Leaflet.fullscreen.min.js') }}"></script>
    <script src="{{ asset('src/extra-markers/js/leaflet.extra-markers.min.js') }}"></script>
    <script src="{{ asset('src/locate/L.Control.Locate.min.js') }}" ></script>
    <script src="{{ asset('src/geocoder/esri-leaflet.js') }}"></script>
    <script src="{{ asset('src/geocoder/esri-leaflet-geocoder.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('js/admin.dashboard.js') }}"></script>
</body>
</html>