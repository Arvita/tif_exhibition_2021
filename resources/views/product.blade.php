@extends('layouts.main')
@section('content')
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container d-flex">
        <div class="mr-auto">
            <ol>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>{{ $product->title }}</li>
            </ol>
        </div>
        <div class="ml-auto mt-3">
            <a href="{{ url('product/'.(strval(Request::segment(2)) - 1)) }}" class="text-dark"><i class="icofont-rounded-left p-2 border"></i></a>
            <a href="{{ url('product/'.(strval(Request::segment(2)) + 1)) }}" class="text-dark"><i class="icofont-rounded-right p-2 border"></i></a>
        </div>
    </div>
</section>

<section id="portfolio-details" class="portfolio-details">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-lg-8">
                <h3 class="font-weight-bold">{{ $product->title }}</h3>
                <hr>
                <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{ $product->link_video }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="mb-5"></iframe>
                <p>{!! $product->description !!}</p>
                <section id="portfolio" class="portfolio">
                    <div class="row portfolio-container">
                        @foreach ($galleries as $gallery)
                        <div class="col-lg-5 col-md-6 portfolio-item filter-app">
                            <div class="portfolio-wrap">
                                <img src="{{ url(asset('img/screenshots/'.$gallery->picture)) }}" class="img-fluid" alt="{{ $gallery->title }}">
                                <div class="portfolio-info">
                                    <h4>{{ $gallery->title }}</h4>
                                    <p>{{ $gallery->description }}</p>
                                    <div class="portfolio-links">
                                        <a href="{{ url(asset('img/screenshots/'.$gallery->picture)) }}" data-gall="portfolioGallery" class="venobox" title="{{ $gallery->title }}"><i class="bx bx-play"></i></a>
                                        {{-- <a href="{{ $gallery->url }}" title="More Details"><i class="bx bx-link"></i></a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
            </div>
            <div class="col-lg-4 portfolio-info">
                <h3>Informasi Produk</h3>
                <ul>
                    <li><strong>Platform</strong> : {{ $product->platform }}</li>
                    <li><strong>Kategori</strong> : {{ $product->category }}</li>
                    <li><strong>Nama Kelompok</strong> : {{ $product->group_name }}</li>
                    <li><strong>Ketua</strong> : {{ $product->group_leader }} ({{ $product->group_leader_nim }})</li>
                    <li><strong>Anggota</strong> : {{ $product->group_member }}</li>
                    <li><strong>Semester / Golongan</strong> : {{ $product->semester }} / {{ $product->group_class }}</li>
                </ul>
                <ul>
                    <li><a href="{{ 'https://api.whatsapp.com/send?phone='.$product->group_phone }}" class="btn btn-success btn-lg btn-block" target="_blank"><i class="icofont-whatsapp"></i> Hubungi Pengembang</a></li>
                    <li><a href="{{ 'mailto:'.$product->group_email }}" class="btn btn-primary btn-lg btn-block" target="_blank"><i class="icofont-envelope"></i> Email Pengembang</a></li>
                    @if ($product->link_web)
                        <li><a href="{{ $product->link_web }}" class="btn btn-danger btn-lg btn-block" target="_blank"><i class="icofont-globe"></i> Lihat Website</a></li>
                    @endif
                    @if ($product->link_mobile)
                        <li><a href="{{ $product->link_mobile }}" class="btn btn-dark btn-lg btn-block" target="_blank"><i class="icofont-brand-android-robot"></i> Download App</a></li>
                    @endif
                    @if ($product->link_desktop)
                        <li><a href="{{ $product->link_desktop }}" class="btn btn-secondary btn-lg btn-block" target="_blank"><i class="icofont-brand-windows"></i> Download Desktop App</a></li>
                    @endif
                </ul>
                <h3 class="text-center mt-5">Vote produk ini dengan Like <i class="icofont-heart text-danger"></i></h3>
                <iframe id="instagram-embed-0" class="instagram-media instagram-media-rendered border" src="{{ $product->link_ig_poster }}embed/captioned/" height="969" frameborder="0" scrolling="no" allowfullscreen="allowfullscreen" data-instgrm-payload-id="instagram-media-payload-0" style="margin-left: 25px;"></iframe>
                <script async="" src="//www.instagram.com/embed.js"></script>
            </div>
            
            <div class="col-lg-12">
                <p class="font-weight-bold">
                    Share : <a href="https://facebook.com/sharer/sharer.php?u={{ Request::url() }}" class="btn btn-primary btn-sm" target="_blank"><i class="icofont-facebook"></i></a> 
                    <a href="https://twitter.com/share?url={{ Request::url() }}" class="btn btn-info btn-sm" target="_blank"><i class="icofont-twitter"></i></a>
                    <a href="whatsapp://send?text={{ Request::url() }}" class="btn btn-success btn-sm" target="_blank"><i class="icofont-whatsapp"></i></a>
                </p>
                <hr>
            </div>

            <div class="col-lg-12">
                <h6 class="font-weight-bold"><i class="icofont-listing-box"></i> Produk Lainnya</h6>
                <hr>
                @foreach ($others as $other)
                <div class="col-lg-12 border mb-3">
                    <div class="row">
                        <div class="col-2 p-0">
                            <img src="{{ ($other->featured_picture != null) ? url(asset('img/products/'.$other->featured_picture)) : 'https://placehold.it/250x120' }}" alt="" class="img-fluid">
                        </div>
                        <div class="col-10 pt-2">
                            <h6 class="title font-weight-bold"><a href="{{ url('product/'.$other->id.'/'.Str::slug($other->title, '-')) }}" class="text-dark">{{ $other->title }}</a></h6>
                            <p class="mb-0 small"><i class="icofont-tags"></i> {{ $other->platform }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="col-lg-12 mt-3">
                <h6 class="font-weight-bold"><i class="icofont-comment"></i> Komentar</h6>
                <hr>
                <div id="disqus_thread"></div>
            </div>
        </div>

    </div>
</section>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    var disqus_config = function () {
    this.page.url = "{{ Request::url() }}";  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = "{{ 'product_'.$id }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
</script>
@endsection