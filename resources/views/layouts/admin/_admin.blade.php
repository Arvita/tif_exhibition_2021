<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- Tell the browser to be responsive to screen width --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ env('APP_DESC') }}">
    <meta name="author" content="{{ env('WEB_AUTHOR') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $data['title'] }} | {{ env('APP_NAME') }}</title>
    <link rel="icon" href="{{ url(asset('img\favicon.png')) }}" sizes="32x32" />
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ url(asset('plugins/fontawesome-free/css/all.min.css')) }}">
    {{-- Ionicons --}}
    <link rel="stylesheet" href="{{ url(asset('plugins/Ionicons/css/ionicons.min.css')) }}">
    {{-- Simple Line Icon --}}
    <link rel="stylesheet" href="{{ url(asset('plugins/simple-line-icons/css/simple-line-icons.css')) }}">
    {{-- Icofont --}}
    <link rel="stylesheet" href="{{ url(asset('vendor/icofont/icofont.min.css')) }}">
    {{-- Theme style --}}
    <link rel="stylesheet" href="{{ url(asset('dist/css/adminlte.min.css')) }}">
    {{-- overlayScrollbars --}}
    <link rel="stylesheet" href="{{ url(asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')) }}">
    {{-- Google Font: Source Sans Pro --}}
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{-- DataTables --}}
    <link rel="stylesheet" href="{{ url(asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ url(asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')) }}">
    {{-- Select2 --}}
    <link rel="stylesheet" href="{{ url(asset('plugins/select2/css/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ url(asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')) }}">
    {{-- Dropzone --}}
    <link rel="stylesheet" href="{{ url(asset('plugins/dropzone/dropzone.css')) }}">
    {{-- summernote --}}
    <link rel="stylesheet" href="{{ url(asset('plugins/summernote/summernote-bs4.css')) }}">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ url(asset('css/custom.css')) }}" />
    {{-- jQuery --}}
    <script src="{{ url(asset('plugins/jquery/jquery.min.js')) }}"></script>
    @stack('content-css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        {{-- Navbar --}}
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            {{-- Left navbar links --}}
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/') }}" class="nav-link">Halaman Utama</a>
                </li>
            </ul>
        </nav>
        {{-- /.navbar --}}
        
        @include('layouts.admin._sidebar')
        
        {{-- Content Wrapper. Contains page content --}}
        <div class="content-wrapper">
            @include('layouts.admin._breadcrumb')
            <div class="content">
                @include('layouts._alert')
            </div>
            @yield('content')
        </div>
        {{-- /.content-wrapper --}}

        <footer class="main-footer small">
            <strong>Copyright &copy; 2021 <a href="{{ env('APP_URL') }}" class="text-dark">{{ env('APP_NAME') }}</a>.</strong>
            <div class="float-right d-none d-sm-inline-block">
                Develop By <a href="https://djuliar.github.com" target="_blank" class="text-dark">Djuliar</a> | <b>Version</b> 1.0.0 
            </div>
        </footer>
    </div>
    {{-- ./wrapper --}}

    {{-- jQuery UI 1.11.4 --}}
    <script src="{{ url(asset('plugins/jquery-ui/jquery-ui.min.js')) }}"></script>
    {{-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip --}}
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    {{-- Bootstrap 4 --}}
    <script src="{{ url(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')) }}"></script>
    {{-- overlayScrollbars --}}
    <script src="{{ url(asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')) }}"></script>
    {{-- DataTables --}}
    <script src="{{ url(asset('plugins/datatables/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ url(asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')) }}"></script>
    <script src="{{ url(asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ url(asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')) }}"></script>
    {{-- Select2 --}}
    <script src="{{ url(asset('plugins/select2/js/select2.full.min.js')) }}"></script>
    {{-- Dropzone --}}
    <script src="{{ url(asset('plugins/dropzone/dropzone.js')) }}"></script>
    {{-- Summernote --}}
    <script src="{{ url(asset('plugins/summernote/summernote-bs4.min.js')) }}"></script>
    {{-- AdminLTE App --}}
    <script src="{{ url(asset('dist/js/adminlte.js')) }}"></script>
    {{-- Custom JS --}}
    <script src="{{ url(asset('js/admin.js')) }}"></script>
    @stack('content-js')
</body>
</html>