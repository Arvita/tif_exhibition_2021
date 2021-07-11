<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <title>{{ env('APP_NAME') }}</title>
    <meta content="{{ env('APP_DESC') }}" name="description">
    <meta content="tif, exhibition, jti, polije" name="keywords">
    
    @if (isset($id))
    <meta property="og:title" content="{{ $product->title }}">
	<meta property="og:description" content="{{ Str::limit($product->description, 75) }}">
	<meta property="og:image" content="{{ url(asset('img/products/'.$product->featured_picture)) }}">
	<meta property="og:url" content="{{ Request::url() }}">
    @else
    <meta property="og:title" content="{{ env('APP_NAME') }}">
	<meta property="og:description" content="{{ env('APP_DESC') }}">
	<meta property="og:image" content="{{ url(asset('img/favicon.png')) }}">
	<meta property="og:url" content="{{ env('APP_URL') }}">
    @endif

    <!-- Favicons -->
    <link href="{{ url(asset('img/favicon.png')) }}" rel="icon">
    <link href="{{ url(asset('img/apple-touch-icon.png')) }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Krub:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url(asset('vendor/bootstrap/css/bootstrap.min.css')) }}" rel="stylesheet">
    <link href="{{ url(asset('vendor/icofont/icofont.min.css')) }}" rel="stylesheet">
    <link href="{{ url(asset('vendor/boxicons/css/boxicons.min.css')) }}" rel="stylesheet">
    <link href="{{ url(asset('vendor/owl.carousel/assets/owl.carousel.min.css')) }}" rel="stylesheet">
    <link href="{{ url(asset('vendor/venobox/venobox.css')) }}" rel="stylesheet">
    <link href="{{ url(asset('vendor/aos/aos.css')) }}" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url(asset('plugins/select2/css/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ url(asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')) }}">

    <!-- Template Main CSS File -->
    <link href="{{ url(asset('css/style.css')) }}" rel="stylesheet">
    <link href="{{ url(asset('css/custom.css')) }}" rel="stylesheet">
    @stack('content-css')
    <!-- =======================================================
    * Template Name: Bikin - v2.2.0
    * Template URL: https://bootstrapmade.com/bikin-free-simple-landing-page-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            {{-- <h1 class="logo mr-auto"><a href="{{ url('/') }}">{{ env('APP_NAME') }}</a></h1> --}}
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="{{ url('/') }}" class="logo mr-auto"><img src="{{ url(asset('img/navbar-brand.svg')) }}" alt="" class="img-fluid"></a>

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <!-- <li class="active"><a href="{{ url('/') }}">Home</a></li> -->
                    <!-- <li class="drop-down"><a href="">Visitor</a>
                        <ul>
                            <li><a href="#">Buku tamu</a></li>
                            <li><a href="#">Visitor Statistik</a></li>
                        </ul>
                    </li> -->
                    @guest
                        {{-- No Button  --}}
                        <!-- <li class="active"><a href="{{ url('/') }}">Home</a></li> -->
                    @else
                    @if(Auth::user()->role == 2)
                    <li class="drop-down"><a href="#">{{ Auth::user()->username }}</a>
                        <ul>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="drop-down"><a href="#">{{ Auth::user()->username }}</a>
                        <ul>
                            <li><a href="{{ url('admin') }}">Halaman Admin</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @endguest
                </ul>
            </nav><!-- .nav-menu -->

            {{-- <a href="https://www.instagram.com/produktif_polije" target="_blank" class="get-started-btn scrollto btn-sm"><i class="icofont-instagram"></i> Follow Instagram</a> --}}

        </div>
    </header><!-- End Header -->

    <main id="main">
        @yield('content')
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3><img src="{{ url(asset('img/polije-jti.svg')) }}" alt="{{ env('APP_NAME') }}" class="img-fluid"></h3>
                        <p>
                            Gedung Jurusan Teknologi Informasi<br>
                            Politeknik Negeri Jember<br>
                            Jl. Mastrip PO.BOX 164 Jember, <br>Jawa Timur 68101 Indonesia<br><br>
                            <strong>Phone:</strong> (+62) 331-333532<br>
                            <strong>Email:</strong> jti1@polije.ac.id<br>
                        </p>
                    </div>

                    <div class="col-lg-1 col-md-6 footer-links"></div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4><i class="icofont-link"></i> Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://www.polije.ac.id">Polije</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="http://jti.polije.ac.id">JTI Polije</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://www.instagram.com/bempolije">BEM Polije</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="http://jti.polije.ac.id/hmjti">HMJTI Polije</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4><i class="icofont-globe"></i> Visitor Counter</h4>
                        <table class="table">
                        <tr><th width="35%"><i class="icofont-numbered"></i> Total</th><td width="2%">:</td><td>{{ visits('App\Models\Product')->count() }} kunjungan</td></tr>
                        <tr><th><i class="icofont-calendar"></i> Hari Ini</th><td>:</td><td>{{ visits('App\Models\Product')->period('day')->count() }} kunjungan</td></tr>
                        <tr><th><i class="icofont-calendar"></i> Minggu Ini</th><td>:</td><td>{{ visits('App\Models\Product')->period('week')->count() }} kunjungan</td></tr>
                        <tr><th><i class="icofont-calendar"></i> Bulan Ini</th><td>:</td><td>{{ visits('App\Models\Product')->period('month')->count() }} kunjungan</td></tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="mr-md-auto text-center text-md-left">
                <div class="copyright">
                    &copy; Copyright <strong><span>TIF Exhibition 2021</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bikin-free-simple-landing-page-template/ -->
                    {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
                </div>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a href="http://www.instagram.com/produktif_polije" class="instagram"><i class="bx bxl-instagram"></i></a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    {{-- <div id="preloader"></div> --}}

    <!-- Vendor JS Files -->
    <script src="{{ url(asset('vendor/jquery/jquery.min.js')) }}"></script>
    <script src="{{ url(asset('vendor/bootstrap/js/bootstrap.bundle.min.js')) }}"></script>
    <script src="{{ url(asset('vendor/jquery.easing/jquery.easing.min.js')) }}"></script>
    <script src="{{ url(asset('vendor/php-email-form/validate.js')) }}"></script>
    <script src="{{ url(asset('vendor/owl.carousel/owl.carousel.min.js')) }}"></script>
    <script src="{{ url(asset('vendor/isotope-layout/isotope.pkgd.min.js')) }}"></script>
    <script src="{{ url(asset('vendor/venobox/venobox.min.js')) }}"></script>
    <script src="{{ url(asset('vendor/aos/aos.js')) }}"></script>
    <!-- Select2 -->
    <script src="{{ url(asset('plugins/select2/js/select2.full.min.js')) }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ url(asset('js/main.js')) }}"></script>
    <script src="{{ url(asset('js/custom.js')) }}"></script>
    <!-- <script>
        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://tif-exhibition.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <script id="dsq-count-scr" src="//tif-exhibition.disqus.com/count.js" async></script> -->
    @stack('content-js')
</body>
</html>

