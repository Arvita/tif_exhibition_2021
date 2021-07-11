@extends('layouts.main')

@section('content')
<section id="sosmed" class="sosmed">
    <div class="container justify-content-center filter" data-aos="fade-up">
        <h2>Follow kami di <i class="icofont-instagram instagram p-1"></i> Instagram (<a href="https://www.instagram.com/produktif_polije" target="_blank" class="text-light">&#64;produktif_polije</a>)</h2>
    </div>
</section>

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container justify-content-center filter" data-aos="fade-up">
        <h2 class="mb-3 text-center">Pilih semester atau masukkan kategori pencarian yang akan anda lihat</h2>
        <form action="#hero" method="get" class="border-0">
            <div class="row">
                <div class="col-lg-6 col-md-12 filter">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Semester</span>
                        </div>
                        <select id="semester" name="semester" class="form-control select2nosearch">
                            <option value="*" {{ (Request::input('semester') == "*") ? ' selected' : '' }}>{{ 'Semua' }}</option>
                            <option value="2" {{ (Request::input('semester') == 2) ? ' selected' : '' }}>{{ 2 }}</option>
                            <option value="4" {{ (Request::input('semester') == 4) ? ' selected' : '' }}>{{ 4 }}</option>
                            <option value="6" {{ (Request::input('semester') == 6) ? ' selected' : '' }}>{{ 6 }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 filter">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Category</span>
                        </div>
                        <select id="category" name="category" class="form-control select2">
                            <option value="*" {{ (Request::input('category') == "*") ? ' selected' : '' }}>{{ 'Semua' }}</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ (Request::input('category') == $category->id) ? ' selected' : '' }}>{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 filter mt-3">
                    <div class="input-group input-group-lg">
                        <input id="search" name="search" type="text" class="form-control" value="{{ (Request::input('search') != null) ? Request::input('search') : old('search') }}">
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-primary btn-flat"><i class="icofont-ui-search"></i> Cari</button>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div>

</section><!-- End Hero -->

<section id="products" class="products">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2 class="m-0">Produk Pameran Mahasiswa</h2>
        </div>

        <div class="row">
            @if (count($products) > 0)
            @foreach ($products as $product)
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="icon-box p-0">
                    <img src="{{ ($product->featured_picture != null) ? url(asset('img/products/'.$product->featured_picture)) : 'https://placehold.it/400x200' }}" alt=" " class="img-fluid">
                    <div class="row">
                        <div class="col-lg-12 px-5 pt-5">
                            <h4 class="title"><a href="{{ url('product/'.Crypt::encrypt($product->id).'/'.Str::slug($product->title, '-')) }}">{{ $product->title }}</a></h4>
                            <p class="description">{!! Str::limit($product->description, 100) !!}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 px-5 py-3">
                            <p><i class="icofont-users"></i> {{ $product->group_leader }}</p>
                            <p><i class="icofont-tags"></i> {{ $product->platform }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-lg-12">
                <div class="alert alert-primary text-center" role="alert">
                    <i class="icofont-warning h1"></i>
                    <h3>Data yang anda cari tidak ditemukan!</h3>
                </div>
            </div>
            @endif
        </div>
        <div class="row justify-content-center mt-5">
            {!! $products->render() !!}
        </div>

    </div>
</section>
@endsection