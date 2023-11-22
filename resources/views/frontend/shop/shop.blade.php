@extends('frontend.layouts.home_master')
@section('frontendContent')
    <style>
        .product-box-3 .product-header .product-image .product-option li+li:after {
            margin-left: -9px;
        }

        .no_image_div {
            width: 50% !important;
            height: 484px !important;
            object-fit: contain;
            margin-left: 177px;
        }
        .img-fluid{
            height: 327px;
            object-fit: contain;
        }
        .product-box-5 .product-image{
            text-align: center;
        }
        .product-header {
            height: 67%;
        }
        .product-box-5 .product-image img{
            height: 327px;
            object-fit: contain;
        }

        @media (max-width: 400px) {
            .product-box-5 .product-image img{
                height: 152px;
                object-fit: contain;
            }
            .img-fluid{
                height: 152px;
                object-fit: contain;
            }
            .product-header{
                height: 45%;
            }

        }
        @media (max-width: 768px) {
            .no_image_div {
                width: 60% !important;
                height: 484px !important;
                object-fit: contain;
                margin-left: 57px;
            }
            .discount-res{
                font-size: xx-small;
            }
        }
    </style>
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Shop</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="#">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Shop</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="slider-1 slider-animate product-wrapper no-arrow">
                        @if ($shopBanner1)
                            <div>
                                <a href="{{ $shopBanner1->link }}" target="_blank">
                                    <div class="banner-contain-2 hover-effect">
                                        <img src="{{ $shopBanner1->banner }}"
                                            class="bg-img rounded-3 blur-up lazyload" alt="">
                                        <div
                                            class="banner-detail p-center-right position-relative shop-banner ms-auto banner-small">
                                            <div>
                                                <h2>{{ $shopBanner1->special_text }}</h2>
                                                <h3>{{ $shopBanner1->header_text }}</h3>
                                                <h4>{{ $shopBanner1->short_desc }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @else
                            <div>
                                <div class="banner-contain-2 hover-effect">
                                    <img src="{{ asset('public/shop_banner1.jpg') }}"
                                        class="bg-img rounded-3 blur-up lazyload" alt="">
                                    <div
                                        class="banner-detail p-center-right position-relative shop-banner ms-auto banner-small">
                                        <div>
                                            <h2>Some special text</h2>
                                            <h3>Some heading text</h3>
                                            <h4>Short description</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($shopBanner2)
                            <div>
                                <a href="{{ $shopBanner2->link }}" target="_blank">

                                    <div class="banner-contain-2 hover-effect">
                                        <img src="{{ $shopBanner2->banner }}"
                                            class="bg-img rounded-3 blur-up lazyload" alt="">
                                        <div
                                            class="banner-detail p-center-right position-relative shop-banner ms-auto banner-small">
                                            <div>
                                                <h2>{{ $shopBanner2->special_text }}</h2>
                                                <h3>{{ $shopBanner2->header_text }}</h3>
                                                <h4>{{ $shopBanner2->short_desc }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @else
                            <div>
                                <div class="banner-contain-2 hover-effect">
                                    <img src="{{ asset('public/shop_banner2.jpg') }}"
                                        class="bg-img rounded-3 blur-up lazyload" alt="">
                                    <div
                                        class="banner-detail p-center-right position-relative shop-banner ms-auto banner-small">
                                        <div>
                                            <h2>Some special text</h2>
                                            <h3>Some heading text</h3>
                                            <h4>Short description</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($shopBanner3)
                            <div>
                                <a href="{{ $shopBanner3->link }}" target="_blank">
                                    <div class="banner-contain-2 hover-effect">
                                        <img src="{{ $shopBanner3->banner }}"
                                            class="bg-img rounded-3 blur-up lazyload" alt="">
                                        <div
                                            class="banner-detail p-center-right position-relative shop-banner ms-auto banner-small">
                                            <div>
                                                <h2>{{ $shopBanner3->special_text }}</h2>
                                                <h3>{{ $shopBanner3->header_text }}</h3>
                                                <h4>{{ $shopBanner3->short_desc }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @else
                            <div>
                                <div class="banner-contain-2 hover-effect">
                                    <img src="{{ asset('public/shop_banner3.jpg') }}"
                                        class="bg-img rounded-3 blur-up lazyload" alt="">
                                    <div
                                        class="banner-detail p-center-right position-relative shop-banner ms-auto banner-small">
                                        <div>
                                            <h2>Some special text</h2>
                                            <h3>Some heading text</h3>
                                            <h4>Short description</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section Start -->
    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-custome-3">
                    <div class="left-box wow fadeInUp">
                        <div class="shop-left-sidebar">
                            <div class="back-button">
                                <h3><i class="fa-solid fa-arrow-left"></i> Back</h3>
                            </div>
                            <div class="filter-category">
                                <div class="filter-title">
                                    <h3>Filters</h3>
                                    <a href="{{ route('shop') }}">Clear All</a>
                                </div>
                            </div>
                            <form action="{{ route('shop') }}">
                                <div class="accordion custome-accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <span>Categories</span>
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne">
                                            <div class="accordion-body">
                                                <div class="form-floating theme-form-floating-2">
                                                    @foreach ($category as $cat)
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            {{-- <input class="checkbox_animated" type="radio" name="category" value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'checked' : '' }} id="category_{{ $cat->id }}"> --}}
                                                            <i class="fa-solid fa-circle" style="font-size: 8px;"></i>
                                                            <label class="form-check-label" for="category_{{ $cat->id }}">
                                                                <span class="name" style="font-size: 18px;">{{ $cat->name }}</span>
                                                                <span class="number"></span>
                                                            </label>

                                                            <!-- Subcategories -->
                                                            @php
                                                                $subcategories = App\Models\SubCategory::where('cat_id',$cat->id)->where('status', 1)->get();
                                                            @endphp
                                                            @if ($subcategories->count() > 0)
                                                                <div class="subcategory-list" style="padding-left: 32px;">
                                                                    @foreach ($subcategories as $subcat)
                                                                        <div class="form-check ps-0 m-0 subcategory-list-box">
                                                                            <input class="checkbox_animated" type="radio" name="subcategory" value="{{ $subcat->id }}" {{ request('subcategory') == $subcat->id ? 'checked' : '' }} id="subcategory_{{ $subcat->id }}">
                                                                            <label class="form-check-label" for="subcategory_{{ $subcat->id }}">
                                                                                <span class="name" style="font-size: 16px;">{{ $subcat->name }}</span>
                                                                                <span class="number"></span>
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                <span>Price</span>
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse show"
                                            aria-labelledby="headingThree">
                                            <div class="accordion-body">
                                                <div class="range-slider">
                                                    <input type="hidden" name="price" class="js-range-slider"
                                                        value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSix">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                aria-expanded="false" aria-controls="collapseSix">
                                                <span>Rating</span>
                                            </button>
                                        </h2>
                                        <div id="collapseSix" class="accordion-collapse collapse show"
                                            aria-labelledby="headingSix">
                                            <div class="accordion-body">
                                                <ul class="category-list custom-padding">
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input class="checkbox_animated rating-checkbox"
                                                                type="checkbox" name="min_avg_rating" value="5"
                                                                {{ request('min_avg_rating') == '5' ? 'checked' : '' }}>
                                                            <div class="form-check-label">
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                </ul>
                                                                <span class="text-content">(5 Star)</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input class="checkbox_animated rating-checkbox"
                                                                type="checkbox" value="4" name="min_avg_rating"
                                                                {{ request('min_avg_rating') == '4' ? 'checked' : '' }}>
                                                            <div class="form-check-label">
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                </ul>
                                                                <span class="text-content">(4 Star)</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input class="checkbox_animated rating-checkbox"
                                                                type="checkbox" name="min_avg_rating" value="3"
                                                                {{ request('min_avg_rating') == '3' ? 'checked' : '' }}>
                                                            <div class="form-check-label">
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                </ul>
                                                                <span class="text-content">(3 Star)</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input class="checkbox_animated rating-checkbox"
                                                                type="checkbox" name="min_avg_rating" value="2"
                                                                {{ request('min_avg_rating') == '2' ? 'checked' : '' }}>
                                                            <div class="form-check-label">
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                </ul>
                                                                <span class="text-content">(2 Star)</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input class="checkbox_animated rating-checkbox"
                                                                type="checkbox" name="min_avg_rating" value="1"
                                                                {{ request('min_avg_rating') == '1' ? 'checked' : '' }}>
                                                            <div class="form-check-label">
                                                                <ul class="rating">
                                                                    <li>
                                                                        <i data-feather="star" class="fill"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                    <li>
                                                                        <i data-feather="star"></i>
                                                                    </li>
                                                                </ul>
                                                                <span class="text-content">(1 Star)</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- discount  --}}
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                aria-expanded="false" aria-controls="collapseFour">
                                                <span>Discount</span>
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse show"
                                            aria-labelledby="headingFour">
                                            <div class="accordion-body">
                                                <ul class="category-list custom-padding">
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input class="checkbox_animated" type="radio"
                                                                {{ request('discount') === '5' ? 'checked' : '' }}
                                                                name="discount" value="5" id="flexRadioDefault1">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                <span class="name">upto 5%</span>
                                                                <span class="number"></span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input class="checkbox_animated" type="radio"
                                                                {{ request('discount') === '10' ? 'checked' : '' }}
                                                                name="discount" value="10" id="flexRadioDefault2">
                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                <span class="name">5% - 10%</span>
                                                                <span class="number"></span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input class="checkbox_animated" type="radio"
                                                                {{ request('discount') === '15' ? 'checked' : '' }}
                                                                name="discount" value="15" id="flexRadioDefault3">
                                                            <label class="form-check-label" for="flexRadioDefault3">
                                                                <span class="name">10% - 15%</span>
                                                                <span class="number"></span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input class="checkbox_animated" type="radio"
                                                                {{ request('discount') === '25' ? 'checked' : '' }}
                                                                name="discount" value="25" id="flexRadioDefault4">
                                                            <label class="form-check-label" for="flexRadioDefault4">
                                                                <span class="name">15% - 25%</span>
                                                                <span class="number"></span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input class="checkbox_animated" type="radio"
                                                                {{ request('discount') === '25+' ? 'checked' : '' }}
                                                                name="discount" value="25+" id="flexRadioDefault5">
                                                            <label class="form-check-label" for="flexRadioDefault5">
                                                                <span class="name">More than 25%</span>
                                                                <span class="number"></span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter">
                                        <button class="btn btn-animation " type="submit">
                                            <svg style="margin-right: 5px;" xmlns="http://www.w3.org/2000/svg"
                                                width="18" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-zap">
                                                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                            </svg>
                                            Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if (count($products) > 0)
                    <div class="col-custome-9">
                        <div class="show-button">
                            <div class="filter-button-group mt-0">
                                <div class="filter-button d-inline-block d-lg-none">
                                    <a><i class="fa-solid fa-filter"></i> Filter Menu</a>
                                </div>
                            </div>
                            <div class="top-filter-menu">
                                <div class="category-dropdown">
                                    <h5 class="text-content">Sort By :</h5>
                                    <div class="dropdown">
                                        <form action="{{ route('shop') }}" id="sort_by_form_submit">
                                            <select name="sort" id="sort_data" class="form-select sort-option">
                                                <option value=" ">Select filter</option>
                                                <option value="low_to_high"
                                                    {{ request('sort') === 'low_to_high' ? 'selected' : '' }}>Low - High
                                                    Price</option>
                                                <option value="high_to_low"
                                                    {{ request('sort') === 'high_to_low' ? 'selected' : '' }}>High - Low
                                                    Price</option>
                                                <option value="off" {{ request('sort') === 'off' ? 'selected' : '' }}>%
                                                    Off - High To Low</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section ratio_110">
                            {{-- @foreach ($products as $product)
                                <div>
                                    <div class="product-box-5 h-100 wow fadeInUp shadow p-3 mb-5 bg-white">
                                        <div class="product-header" style="">
                                            <div class="product-image" style="">
                                                <a href="{{ route('product.details', $product->slug) }}">
                                                    <img src="{{ $product->thumbnail }}"
                                                        class="img-fluid blur-up lazyload" alt="" style="">
                                                </a>
                                                <ul class="product-option"
                                                    style="justify-content:space-evenly;width:126px;">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                        <a href="{{ route('product.details', $product->slug) }}">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Wishlist">
                                                        <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                            class="notifi-wishlist-custom custom-list wishlist-class">
                                                            <i data-feather="heart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-footer">
                                            <div class="product-detail">
                                                <span class="span-name">
                                                    @if ($product->cat_id)
                                                        {{ $product->category->name }}
                                                    @endif
                                                </span>
                                                <a href="{{ route('product.details', $product->slug) }}">
                                                    <h5 class="name">{{ $product->name }}</h5>
                                                </a>
                                                <div class="product-rating mt-2 mb-1" style="justify-content: center;">
                                                    <ul class="rating">
                                                        @for ($i = 0; $i < $product->avg_rating; $i++)
                                                            <li>
                                                                <i data-feather="star" class="fill"></i>
                                                            </li>
                                                        @endfor
                                                        @for ($i = 0; $i < 5 - $product->avg_rating; $i++)
                                                            <li>
                                                                <i data-feather="star"></i>
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                    <span>({{ $product->total_raters }})</span>
                                                </div>
                                                <h6 class="unit"></h6>
                                                <h5 class="price"><span
                                                        class="theme-color">${{ $product->final_sell_price }}</span>
                                                    @if ($product->discount)
                                                        <del>${{ $product->sell_price }}</del>
                                                    @endif
                                                </h5>
                                                <div class="add-to-cart-box bg-gray">
                                                    <a class="btn btn-add-cart addcart-button"
                                                        href="{{ route('product.details', $product->slug) }}">Details
                                                        <span class="add-icon bg-light-gray">
                                                            <i data-feather="eye"></i>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach --}}
                            @foreach ($products as $product)
                            <div >
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
                                        <div class="product-rating mt-2 mb-1" style="justify-content: center;">
                                            <ul class="rating">
                                                @for ($i = 0; $i < $product->avg_rating; $i++)
                                                    <li>
                                                        <i data-feather="star" class="fill"></i>
                                                    </li>
                                                @endfor
                                                @for ($i = 0; $i < 5 - $product->avg_rating; $i++)
                                                    <li>
                                                        <i data-feather="star"></i>
                                                    </li>
                                                @endfor
                                            </ul>
                                            <span>({{ $product->total_raters }})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <nav class="custome-pagination">
                            <ul class="pagination justify-content-center">
                                <!-- Previous Page Link -->
                                @if ($products->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link" href="javascript:void(0)" tabindex="-1"
                                            aria-disabled="true">
                                            <i class="fa-solid fa-angles-left"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->previousPageUrl() }}" tabindex="-1">
                                            <i class="fa-solid fa-angles-left"></i>
                                        </a>
                                    </li>
                                @endif
                                <!-- Pagination Links -->
                                @foreach ($products->links()->elements as $element)
                                    @if (is_string($element))
                                        <li class="page-item disabled">
                                            <a class="page-link" href="javascript:void(0)">{{ $element }}</a>
                                        </li>
                                    @endif
                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $products->currentPage())
                                                <li class="page-item active">
                                                    <a class="page-link"
                                                        href="javascript:void(0)">{{ $page }}</a>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                <!-- Next Page Link -->
                                @if ($products->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->nextPageUrl() }}">
                                            <i class="fa-solid fa-angles-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a class="page-link" href="javascript:void(0)">
                                            <i class="fa-solid fa-angles-right"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                @else
                    {{-- attention:  --}}
                    <img class="no_image_div" style="" src="{{ asset('public/empty-cart.png') }}" />
                @endif
            </div>
        </div>
    </section>

    <!-- Shop Section End-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('public/frontend/custom/shop/shop.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('select.sort-option').on('change', function() {
                $('#sort_data').val($(this).val());
                $('#sort_by_form_submit').submit();
            });
            var sortOption = "{{ request('sort') }}";
            if (sortOption) {
                $('select.sort-option').val(sortOption);
            }
        });
    </script>
@endsection
