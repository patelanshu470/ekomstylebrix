@extends('frontend.layouts.home_master')
@section('frontendContent')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/custom/home/home.css') }}">
    <style>
        .category-box::after {
            background-image: url('{{ asset('public/back4.png') }}') !important;
        }
    </style>

    <section class="home-section-2 home-section-bg pt-0 overflow-hidden">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="slider-animate">
                        <div>
                            <div class="home-contain rounded-0 p-0">
                                @if ($bannerOne)
                                    <img src="{{ $bannerOne->banner }}"
                                        class="img-fluid bg-img blur-up lazyload" alt="">
                                    <div class="home-detail home-big-space p-center-left home-overlay position-relative">
                                        <div class="container-fluid-lg">
                                            <div>
                                                <h6 class="ls-expanded text-uppercase text-danger">
                                                    {{ $bannerOne->special_text }}
                                                </h6>
                                                <h1 class="heding-2">{{ $bannerOne->header_text }}</h1>
                                                <h5 class="text-content">{{ $bannerOne->short_desc }}
                                                </h5>
                                                <button onclick="window.open('{{ $bannerOne->link }}', '_blank');"
                                                    class="btn theme-bg-color btn-md text-white fw-bold mt-md-4 mt-2 mend-auto">
                                                    Shop Now <i class="fa-solid fa-arrow-right icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <img src="{{ asset('public/frontend/assets/images/fashion/home-banner/1.jpg') }}"
                                        class="img-fluid bg-img blur-up lazyload" alt="">
                                    <div class="home-detail home-big-space p-center-left home-overlay position-relative">
                                        <div class="container-fluid-lg">
                                            <div>
                                                <h6 class="ls-expanded text-uppercase text-danger">Weekend Special offer
                                                </h6>
                                                <h1 class="heding-2">Premium Quality</h1>
                                                <h5 class="text-content">Fresh & Top Quality Dry Fruits are available here!
                                                </h5>
                                                <button onclick="location.href = '{{ route('home') }}';"
                                                    class="btn theme-bg-color btn-md text-white fw-bold mt-md-4 mt-2 mend-auto">Shop
                                                    Now <i class="fa-solid fa-arrow-right icon"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="slider-9">
                        @foreach ($category as $cat)
                            <div>
                                <form action="{{ route('shop') }}" id="shopFormHome{{ $cat->id }}">
                                    <a href="javascript:void(0)" class="category-box category-dark wow fadeInUp"
                                        id="categoryIDHome{{ $cat->id }}">
                                        <input type="hidden" name="category" value="{{ $cat->id }}"
                                            id="category_input">
                                        <div>
                                            <img src="{{ $cat->image }}"
                                                class="blur-up lazyload" alt="">
                                            <h5>{{ $cat->name }}</h5>
                                        </div>
                                    </a>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- new arrival  --}}
    <section class="product-section product-section-3">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-6">
                    <div class="title">
                        <h2>New Arrivals</h2>
                    </div>
                </div>
                <div class="col-6">
                    <div class="title view-all">
                        <button onclick="location.href = '{{ route('shop') }}';" style="border-radius:25px;"
                            class="btn theme-bg-color btn-md text-white fw-bold " tabindex="0">View all<i
                                class="fa-solid fa-arrow-right icon"></i></button>
                    </div>
                </div>
            </div>
            <div class="row g-sm-4 g-3 section-b-space">
                <div class="col-xxl-12 ratio_110">
                    <div class="slider-6 img-slider">
                        @foreach ($recently as $product)
                            <div>
                                <div class="product-box-5 wow fadeInUp">
                                    <div class="product-image">
                                        <a href="{{ route('product.details', $product->slug) }}">
                                            <img src="{{ $product->thumbnail }}"
                                                class="img-fluid blur-up lazyload bg-img" alt="">
                                        </a>
                                        <ul class="product-option" style="justify-content:space-evenly;width:126px;">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <a href="{{ route('product.details', $product->slug) }}">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>
                                            <li >
                                                <a href="javascript:void(0)" data-id="{{ $product->id }}" id="wishlistID" @if (array_key_exists($product->id, $wishlist)) data-wishlist_item_id="{{$wishlist[$product->id]}}" @endif
                                                    class="notifi-wishlist-custom custom-list @if (array_key_exists($product->id, $wishlist)){{'active-wishlist wishlist-removed'}}@else{{'wishlist-class'}} @endif" data-bs-toggle="tooltip" data-bs-placement="top" title="@if (array_key_exists($product->id, $wishlist)){{'Removed To Wishlist'}}@else{{'Add To Wishlist'}} @endif">
                                                    <i data-feather="heart" @if (array_key_exists($product->id, $wishlist))fill="currentColor"@else fill="none" @endif></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-detail">
                                        <a href="#">
                                            <h5 class="name">{{ $product->name }}</h5>
                                        </a>
                                        <h5 class="sold text-content">
                                            <span class="theme-color price">${{ $product->final_sell_price }}</span>
                                            @if ($product->discount)
                                                <del>${{ $product->sell_price }}</del>
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Top selling items -->
    @if (count($top_selling) > 0)
        <section class="product-section product-section-3">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-6">
                        <div class="title">
                            <h2>Top Selling Items</h2>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="title view-all">
                            <button onclick="location.href = '{{ route('shop') }}';" style="border-radius:25px;"
                                class="btn theme-bg-color btn-md text-white fw-bold " tabindex="0">View all<i
                                    class="fa-solid fa-arrow-right icon"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row g-sm-4 g-3">
                    <div class="col-xxl-12 ratio_110">
                        <div class="slider-6 img-slider">
                            @foreach ($top_selling as $product)
                                <div>
                                    <div class="product-box-5 wow fadeInUp">
                                        <div class="product-image">
                                            <a href="{{ route('product.details', $product->slug) }}">
                                                <img src="{{ $product->thumbnail }}"
                                                    class="img-fluid blur-up lazyload bg-img" alt="">
                                            </a>
                                            <ul class="product-option" style="justify-content:space-evenly;width:126px;">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="{{ route('product.details', $product->slug) }}">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>
                                                <li >
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}" id="wishlistID" @if (array_key_exists($product->id, $wishlist)) data-wishlist_item_id="{{$wishlist[$product->id]}}" @endif
                                                        class="notifi-wishlist-custom custom-list @if (array_key_exists($product->id, $wishlist)){{'active-wishlist wishlist-removed'}}@else{{'wishlist-class'}} @endif" data-bs-toggle="tooltip" data-bs-placement="top" title="@if (array_key_exists($product->id, $wishlist)){{'Removed To Wishlist'}}@else{{'Add To Wishlist'}} @endif">
                                                        <i data-feather="heart" @if (array_key_exists($product->id, $wishlist))fill="currentColor"@else fill="none" @endif></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product-detail">
                                            <a href="#">
                                                <h5 class="name">{{ $product->name }}</h5>
                                            </a>
                                            <h5 class="sold text-content">
                                                <span class="theme-color price">${{ $product->final_sell_price }}</span>
                                                @if ($product->discount)
                                                    <del>${{ $product->sell_price }}</del>
                                                @endif
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section>
        <div class="container-fluid-lg">
            <div class="row g-md-4 g-3">
                <div class="col-xxl-8 col-xl-12 col-md-7">
                    @if ($bannerTwo)
                        <div class="banner-contain hover-effect">
                            <img src="{{ $bannerTwo->banner }}"
                                class="bg-img blur-up lazyload" alt="">
                            <div class="banner-details p-center-left p-4">
                                <div>
                                    <h2 class="text-kaushan fw-normal theme-color">{{ $bannerTwo->special_text }}</h2>
                                    <h3 class="mt-2 mb-3">{{ $bannerTwo->header_text }}</h3>
                                    <p class="text-content banner-text">{{ $bannerTwo->short_desc }}</p>
                                    <button onclick="window.open('{{ $bannerTwo->link }}', '_blank');"
                                        class="btn btn-animation btn-sm mend-auto">Shop Now <i
                                            class="fa-solid fa-arrow-right icon"></i></button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="banner-contain hover-effect">
                            <img src="{{ asset('public/frontend/assets/images/fashion/banner/1.jpg') }}"
                                class="bg-img blur-up lazyload" alt="">
                            <div class="banner-details p-center-left p-4">
                                <div>
                                    <h2 class="text-kaushan fw-normal theme-color">Get Ready To</h2>
                                    <h3 class="mt-2 mb-3">TAKE ON THE DAY!</h3>
                                    <p class="text-content banner-text">In publishing and graphic design, Lorem
                                        ipsum is a placeholder text commonly used to demonstrate.</p>
                                    <button onclick="location.href = '{{ route('home') }}';"
                                        class="btn btn-animation btn-sm mend-auto">Shop Now <i
                                            class="fa-solid fa-arrow-right icon"></i></button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-xxl-4 col-xl-12 col-md-5">
                    @if ($bannerThree)
                        <a href="{{ $bannerThree->link }}" target="_blank" class="banner-contain hover-effect h-100">
                            <img src="{{ $bannerThree->banner }}"
                                class="bg-img blur-up lazyload" alt="">
                            <div class="banner-details p-center-left p-4 h-100">
                                <div>
                                    <h2 class="text-kaushan fw-normal text-danger">{{ $bannerThree->special_text }}</h2>
                                    <h3 class="mt-2 mb-2 theme-color">{{ $bannerThree->header_text }}</h3>
                                    <h3 class="fw-normal product-name text-title">{{ $bannerThree->short_desc }}</h3>
                                </div>
                            </div>
                        </a>
                    @else
                        <a href="#" class="banner-contain hover-effect h-100">
                            <img src="{{ asset('public/frontend/assets/images/fashion/banner/2.jpg') }}"
                                class="bg-img blur-up lazyload" alt="">
                            <div class="banner-details p-center-left p-4 h-100">
                                <div>
                                    <h2 class="text-kaushan fw-normal text-danger">20% Off</h2>
                                    <h3 class="mt-2 mb-2 theme-color">SUMMRY</h3>
                                    <h3 class="fw-normal product-name text-title">Product</h3>
                                </div>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="top-selling-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-3 col-lg-4 d-lg-block d-none">
                    @if ($bannerFour)
                        <div class="ratio_156">
                            <div class="banner-contain-2 hover-effect">
                                <img src="{{ $bannerFour->banner }}"
                                    class="bg-img blur-up lazyload" alt="">
                                <div class="banner-detail-2 p-bottom-center text-center home-p-medium">
                                    <div>
                                        <h2 class="text-qwitcher">{{ $bannerFour->special_text }}</h2>
                                        <h3>{{ $bannerFour->header_text }}</h3>
                                        <button onclick="window.open('{{ $bannerFour->link }}', '_blank');"
                                            class="btn btn-md">Shop
                                            Now <i class="fa-solid fa-arrow-right icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="ratio_156">
                            <div class="banner-contain-2 hover-effect">
                                <img src="{{ asset('public/frontend/assets/images/fashion/banner/3.jpg') }}"
                                    class="bg-img blur-up lazyload" alt="">
                                <div class="banner-detail-2 p-bottom-center text-center home-p-medium">
                                    <div>
                                        <h2 class="text-qwitcher">Passion Meet</h2>
                                        <h3>PERFECTION</h3>
                                        <button onclick="location.href = '{{ route('home') }}';" class="btn btn-md">Shop
                                            Now <i class="fa-solid fa-arrow-right icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-xxl-9 col-lg-8">
                    <div class="slider-3_3 product-wrapper">
                        @if (count($top_selling) > 0)
                            <div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="top-selling-box">
                                            <div class="top-selling-title">
                                                <h3>Top Selling</h3>
                                            </div>
                                            @foreach ($top_selling as $key => $recent)
                                                @if ($key < 5)
                                                    <div class="top-selling-contain wow fadeInUp">
                                                        <a href="{{ route('product.details', $recent->slug) }}"
                                                            class="top-selling-image">
                                                            <img src="{{ $recent->thumbnail }}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>
                                                        <div class="top-selling-detail">
                                                            <a href="{{ route('product.details', $recent->slug) }}">
                                                                <h5>{{ $recent->name }}</h5>
                                                            </a>
                                                            <div class="product-rating">
                                                                <ul class="rating">
                                                                    @for ($i = 0; $i < $recent->avg_rating; $i++)
                                                                        <li>
                                                                            <i data-feather="star" class="fill"></i>
                                                                        </li>
                                                                    @endfor
                                                                    @for ($i = 0; $i < 5 - $recent->avg_rating; $i++)
                                                                        <li>
                                                                            <i data-feather="star"></i>
                                                                        </li>
                                                                    @endfor
                                                                </ul>
                                                                <span>({{ $recent->total_raters }})</span>
                                                            </div>
                                                            <h6>${{ $recent->final_sell_price }}</h6>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div>
                            <div class="row">
                                <div class="col-12">
                                    {{-- attention:  --}}
                                    <div class="top-selling-box">
                                        <div class="top-selling-title">
                                            <h3>Top-Rated Products</h3>
                                        </div>
                                        @foreach ($top_rated as $top)
                                            <div class="top-selling-contain wow fadeInUp">
                                                <a href="{{ route('product.details', $top->slug) }}"
                                                    class="top-selling-image">
                                                    <img src="{{ $top->thumbnail }}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <div class="top-selling-detail">
                                                    <a href="{{ route('product.details', $top->slug) }}">
                                                        <h5>{{ $top->name }}</h5>
                                                    </a>
                                                    <div class="product-rating">
                                                        <ul class="rating">
                                                            <ul class="rating">
                                                                @for ($i = 0; $i < $top->avg_rating; $i++)
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                @endfor
                                                                @for ($i = 0; $i < 5 - $top->avg_rating; $i++)
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                @endfor
                                                            </ul>
                                                        </ul>
                                                        <span>({{ $top->total_raters }})</span>
                                                    </div>
                                                    <h6>$ {{ $top->final_sell_price }}</h6>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- recently added  --}}
                        <div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="top-selling-box">
                                        <div class="top-selling-title">
                                            <h3>Recently added</h3>
                                        </div>
                                        @foreach ($recently as $key => $recent)
                                            @if ($key < 5)
                                                <div class="top-selling-contain wow fadeInUp">
                                                    <a href="{{ route('product.details', $recent->slug) }}"
                                                        class="top-selling-image">
                                                        <img src="{{ $recent->thumbnail }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>
                                                    <div class="top-selling-detail">
                                                        <a href="{{ route('product.details', $recent->slug) }}">
                                                            <h5>{{ $recent->name }}</h5>
                                                        </a>
                                                        <div class="product-rating">
                                                            <ul class="rating">
                                                                @for ($i = 0; $i < $recent->avg_rating; $i++)
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                @endfor
                                                                @for ($i = 0; $i < 5 - $recent->avg_rating; $i++)
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                @endfor
                                                            </ul>
                                                            <span>({{ $recent->total_raters }})</span>
                                                        </div>
                                                        <h6>${{ $recent->final_sell_price }}</h6>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- : Coupon --}}
    @if ($featureCoupon)
        <section class="section-t-space">
            <div class="container-fluid-lg">
                <div class="banner-contain">
                    <img src="{{ $featureCoupon->image }}"
                        class="bg-img blur-up lazyload" alt="">
                    <div class="banner-details p-center p-4 text-white text-center">
                        <div>
                            <h3 class="lh-base fw-bold offer-text" style="background: rgb(0 0 0 / 23%)">
                                {{ $featureCoupon->header_text }}</h3>
                            <h6 class="coupon-code coupon-code-white">Use Code : {{ $featureCoupon->coupon_code }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    {{-- all items --}}
    <section class="product-section product-section-3">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-6">
                    <div class="title">
                        <h2>All Items</h2>
                    </div>
                </div>
                <div class="col-6">
                    <div class="title view-all">
                        <button onclick="location.href = '{{ route('shop') }}';" style="border-radius:25px;"
                            class="btn theme-bg-color btn-md text-white fw-bold " tabindex="0">View all<i
                                class="fa-solid fa-arrow-right icon"></i></button>
                    </div>
                </div>
            </div>
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-12 ratio_110">
                    <div class="slider-6 img-slider">
                        @foreach ($all_products as $product)
                            <div>
                                <div class="product-box-5 wow fadeInUp">
                                    <div class="product-image">
                                        <a href="{{ route('product.details', $product->slug) }}">
                                            <img src="{{ $product->thumbnail }}"
                                                class="img-fluid blur-up lazyload bg-img" alt="">
                                        </a>
                                        <ul class="product-option" style="justify-content:space-evenly;width:126px;">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <a href="{{ route('product.details', $product->slug) }}">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>
                                            <li >
                                                <a href="javascript:void(0)" data-id="{{ $product->id }}" id="wishlistID" @if (array_key_exists($product->id, $wishlist)) data-wishlist_item_id="{{$wishlist[$product->id]}}" @endif
                                                    class="notifi-wishlist-custom custom-list @if (array_key_exists($product->id, $wishlist)){{'active-wishlist wishlist-removed'}}@else{{'wishlist-class'}} @endif" data-bs-toggle="tooltip" data-bs-placement="top" title="@if (array_key_exists($product->id, $wishlist)){{'Removed To Wishlist'}}@else{{'Add To Wishlist'}} @endif">
                                                    <i data-feather="heart" @if (array_key_exists($product->id, $wishlist))fill="currentColor"@else fill="none" @endif></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-detail">
                                        <a href="#">
                                            <h5 class="name">{{ $product->name }}</h5>
                                        </a>
                                        <h5 class="sold text-content">
                                            <span class="theme-color price">${{ $product->final_sell_price }}</span>
                                            @if ($product->discount)
                                                <del>${{ $product->sell_price }}</del>
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @foreach ($category as $cat)
        <script>
            $(document).ready(function() {
                $('#categoryIDHome{{ $cat->id }}').on('click', function() {
                    $('#shopFormHome{{ $cat->id }}').submit();
                });
            });
        </script>
    @endforeach
@endsection
