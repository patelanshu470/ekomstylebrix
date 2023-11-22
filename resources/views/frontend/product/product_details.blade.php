@extends('frontend.layouts.home_master')
@section('frontendContent')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/custom/product/product.css') }}">
    <style>
        @media (max-width: 768px) {
            .discount-res {
                font-size: xx-small;
            }
        }

        .opposing-items {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .option-selector__btns {
            display: flex;
            flex-wrap: wrap;
            margin: -10px -10px 0 0;
        }

        .opt-btn {
            position: absolute;
            z-index: -1;
            opacity: 0;
            width: auto;
        }

        .opt-label {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            min-width: 4.5em;
            min-height: 48px;
            margin: 10px 10px 0 0;
            padding: 11px 15px;
            border: 1.5px solid #dbdcdc;
            border-radius: 3px;
            background-color: #fff;
            color: #707173;
        }

        .opt-btn:checked+.opt-label {
            border-color: #707173;
            cursor: default;
        }

        @media only screen and (max-width: 360px) {
            .size-chart table {
                display: flex;
                overflow: auto;
                width: 100%;
            }

            .opt-btn {
                width: 90%;
            }

            .video-container {
                width: 100%;
                height: auto;
                background-color: #fff;
                overflow: hidden;
            }

            .detail-gallery .slick-slider video {
                /* width: 352px; */
                width: 100%;
            }
        }

        .size-chart-container {
            cursor: pointer;
        }
    </style>
    <style>
        .select-packege {
            list-style-type: none;
            padding: 0;
            display: flex;
            /* justify-content: space-between; */
        }

        .color-item {
            text-align: center;
            margin: 5px; /* Adjust the margin as needed */
        }

        .color-image-container {
            width: 60px; /* Adjust the width to control the size of the square container */
            height: 80px; /* Set the same height as the width to make it a square */
            overflow: hidden;
            /* border: 1px solid #ccc; */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .color-image-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .color-name {
            width: 65px;
            margin-top: 5px; /* Adjust the margin to separate the image and name */
        }
    </style>
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>{{ $data->name }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="#">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Product Left Sidebar Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                    <div class="row g-4">
                        <div class="col-xl-6 wow fadeInUp">
                            <div class="product-left-box">
                                <div class="row g-2">
                                    <div class="col-xxl-10 col-lg-12 col-md-10 order-xxl-2 order-lg-1 order-md-2">
                                        <div class="product-main-2 no-arrow">
                                            <div>
                                                <div class="slider-image">
                                                    <img src="{{ $data->thumbnail }}" id="img-1"
                                                        data-zoom-image="{{ $data->thumbnail }}"
                                                        class="img-fluid image_zoom_cls-0 blur-up lazyload" alt="">
                                                </div>
                                            </div>
                                            @foreach ($data->galleries as $img)
                                                <div>
                                                    <div class="slider-image">
                                                        <img src="{{ $img->image }}" id="img-1"
                                                            data-zoom-image="{{ $img->image }}"
                                                            class="img-fluid image_zoom_cls-0 blur-up lazyload"
                                                            alt="">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-lg-12 col-md-2 order-xxl-1 order-lg-2 order-md-1">
                                        <div class="left-slider-image-2 left-slider no-arrow slick-top">
                                            <div>
                                                <div class="sidebar-image">
                                                    <img src="{{ $data->thumbnail }}" class="img-fluid blur-up lazyload"
                                                        alt="">
                                                </div>
                                            </div>
                                            @foreach ($data->galleries as $img)
                                                <div>
                                                    <div class="sidebar-image">
                                                        <img src="{{ $img->image }}" class="img-fluid blur-up lazyload"
                                                            alt="">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="right-box-contain">
                                @if ($data->discount)
                                    <h6 class="offer-top">{{ $data->discount }}% off</h6>
                                @endif
                                <h2 class="name">{{ $data->name }}</h2>
                                <div class="price-rating">
                                    <h3 class="theme-color price">${{ $data->final_sell_price }}
                                        @if ($data->discount)
                                            <del class="text-content">${{ $data->sell_price }}</del>
                                            <span class="offer theme-color">{{ $data->discount }}% off</span>
                                        @endif
                                    </h3>
                                    <div class="product-rating custom-rate">
                                        <ul class="rating">
                                            @for ($i = 0; $i < $data->avg_rating; $i++)
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                            @endfor
                                            @for ($i = 0; $i < 5 - $data->avg_rating; $i++)
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                            @endfor
                                        </ul>
                                        <span class="review">{{ $data->total_raters }} Customer Review </span>
                                    </div>
                                </div>
                                <div class="procuct-contain">
                                    {{-- <p>
                                        <?php
                                        $description = strip_tags($data->description);
                                        $words = str_word_count($description, 2);
                                        $limit = 20;
                                        $first10Words = implode(' ', array_slice($words, 0, $limit));
                                        echo $first10Words . (count($words) > $limit ? '...' : '');
                                        ?>
                                    </p> --}}
                                </div>
                                <div class="product-packege">
                                    <div class="product-title">
                                        {{-- <h4>Colors</h4> --}}
                                    </div>
                                    <ul class="select-packege">
                                        @if (!$varient == null)
                                            @foreach ($varient as $var)
                                                @if (!$var == null)
                                                    <a href="{{ route('product.details', $var->slug) }}">
                                                        <li class="color-item">
                                                            <div class="color-image-container">
                                                                <img src="{{ $var->color_image }}" class="lazyload" alt="">
                                                            </div>
                                                            <div class="color-name">{{ $var->color }}</div>
                                                        </li>
                                                    </a>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="time deal-timer product-deal-timer mx-md-0 mx-auto" id="clockdiv-1"
                                    data-hours="1" data-minutes="2" data-seconds="3">
                                    <div class="product-title">
                                        <h4>Hurry up! Sales Ends In</h4>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="days d-block">
                                                    <h5>1</h5>
                                                </div>
                                                <h6>Days</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="hours d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Hours</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="minutes d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Min</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="seconds d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Sec</h6>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="option-selectors" data-disable-unavailable="true">
                                    <div class="option-selector option-selector--with-size-chart"
                                        data-selector-type="listed" data-option-index="0">
                                        <fieldset class="option-selector-fieldset" style="border: none">
                                            <div class="opposing-items">
                                                {{-- <legend class="label" style="width: 75%;">Size</legend> --}}
                                                <div class="product-title">
                                                    <h4>Size</h4>
                                                </div>
                                                {{-- <div class="size-chart-container">
                                                    <i class="fa-solid fa-ruler" style="color: #751d1c"></i>
                                                    <span class="size-chart-link__text underline"
                                                        onclick="openSizeModal()" style="color: #751d1c">Size Guide</span>
                                                    <div id="sizeModal" class="modal" style="z-index: 9999999999;">
                                                        <div class="modal-content">
                                                            <span class="close" onclick="closeSizeModal()"
                                                                style="margin-bottom: 10px;text-align: end;">&times;</span>
                                                            <div class="size-chart">
                                                                <div class="size-chart__inner rte">
                                                                    <p style="font-size: 13px;">Below is the standard body part
                                                                        measurement chart (in inches) that we
                                                                        refer to when creating our pieces.&nbsp;
                                                                    </p>
                                                                    <p style="font-size: 15px;"><b style="font-weight: revert;">Measurement Guidelines&nbsp;:</b></p>
                                                                    <ul style="margin-inline-start: 2em;margin: 1em;font-size: 100%;margin-left: 2rem;">
                                                                        <li style="list-style: disc outside;">Measurements should be taken
                                                                            directly on your body (in inches)
                                                                        </li>
                                                                        <li style="list-style: disc outside;">Measure around the fullest part of
                                                                            your bust with arms down by your
                                                                            side</li>
                                                                        <li style="list-style: disc outside;">Measure around the narrowest part of
                                                                            your waistline, above navel and
                                                                            below the ribcage</li>
                                                                        <li style="list-style: disc outside;">Measure around the fullest part of
                                                                            your hips</li>
                                                                    </ul>
                                                                    <table >
                                                                        <tbody>
                                                                            <tr>
                                                                                <td colspan="6"
                                                                                    style="text-align: center; width: 381.484px;">
                                                                                    Body Part Measurements for
                                                                                    uppers &amp; lowers (in
                                                                                    inches)</td>
                                                                            </tr>
                                                                            <tr style="text-align: center;">
                                                                                <td style="width: 86px;">Size
                                                                                </td>
                                                                                <td style="width: 72px;">XS</td>
                                                                                <td style="width: 53px;">S</td>
                                                                                <td style="width: 75px;">M</td>
                                                                                <td style="width: 51px;">L</td>
                                                                                <td style="width: 44.4844px;">XL
                                                                                </td>
                                                                            </tr>
                                                                            <tr style="text-align: center;">
                                                                                <td style="width: 86px;">
                                                                                    Bust&nbsp;</td>
                                                                                <td style="width: 72px;">32</td>
                                                                                <td style="width: 53px;">34</td>
                                                                                <td style="width: 75px;">36
                                                                                </td>
                                                                                <td style="width: 51px;">38
                                                                                </td>
                                                                                <td style="width: 44.4844px;">
                                                                                    41</td>
                                                                            </tr>
                                                                            <tr style="text-align: center;">
                                                                                <td style="width: 86px;">Waist
                                                                                </td>
                                                                                <td style="width: 72px;">26
                                                                                </td>
                                                                                <td style="width: 53px;">28
                                                                                </td>
                                                                                <td style="width: 75px;">30
                                                                                </td>
                                                                                <td style="width: 51px;">32
                                                                                </td>
                                                                                <td style="width: 44.4844px;">
                                                                                    35</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td
                                                                                    style="text-align: center; width: 86px;">
                                                                                    Hips</td>
                                                                                <td
                                                                                    style="text-align: center; width: 72px;">
                                                                                    36</td>
                                                                                <td
                                                                                    style="text-align: center; width: 53px;">
                                                                                    38</td>
                                                                                <td
                                                                                    style="text-align: center; width: 75px;">
                                                                                    40</td>
                                                                                <td
                                                                                    style="text-align: center; width: 51px;">
                                                                                    42</td>
                                                                                <td
                                                                                    style="text-align: center; width: 44.4844px;">
                                                                                    45</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <p>&nbsp;</p>
                                                                    <p>&nbsp;</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="option-selector__btns">
                                                {{-- @php
                                                    $sizeArray = json_decode($data->size);
                                                    $lastKey = count($sizeArray) - 1;
                                                @endphp --}}
                                                @foreach (json_decode($data->size) as $key => $selectedSize)
                                                <input class="opt-btn js-option" type="radio" name="size"
                                                    id="size-opt-{{ $key }}" value="{{ $selectedSize }}" required="" >
                                                <label class="opt-label" for="size-opt-{{ $key }}"><span
                                                        class="opt-label__text">{{ $selectedSize }}</span></label>
                                                @endforeach
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="note-box product-packege">
                                    <div class="cart_qty qty-box product-qty">
                                        <div class="input-group">
                                            <button type="button" class="qty-left-minus " data-type="minus"
                                                data-field="">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                            <input class="form-control input-number qty-input qty-val" type="text"
                                                readonly name="quantity" value="1">
                                            <button type="button" class="qty-right-plus " data-type="plus"
                                                data-field="">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button data-product_id="{{ $data->id }}"
                                        class="btn btn-md bg-dark cart-button text-white w-100 button-add-to-cart">Add To
                                        Cart</button>

                                    <div class="" style="background: linear-gradient(187.77deg, #fafafa 5.52%, #f8f8f8 94%);
                                    width: 15%;padding: 10px;border-radius: 10px;text-align: center;">
                                        <a href="javascript:void(0)" data-id="{{ $data->id }}" id="wishlistID" @if (array_key_exists($data->id, $wishlist)) data-wishlist_item_id="{{$wishlist[$data->id]}}" @endif
                                            class="notifi-wishlist-custom custom-list @if (array_key_exists($data->id, $wishlist)){{'active-wishlist wishlist-removed'}}@else{{'wishlist-class'}} @endif" data-bs-toggle="tooltip" data-bs-placement="top" title="@if (array_key_exists($data->id, $wishlist)){{'Removed To Wishlist'}}@else{{'Add To Wishlist'}} @endif">
                                            <i data-feather="heart" @if (array_key_exists($data->id, $wishlist))fill="currentColor"@else fill="none" @endif></i>
                                        </a>
                                    </div>

                                </div>
                                <div class="pickup-box">
                                    <div class="product-title">
                                        <h4>Store Information</h4>
                                    </div>
                                    <div class="product-info">
                                        <ul class="product-info-list product-info-list-2">
                                            <li>Size : <a href="javascript:void(0)">
                                            {{ implode(', ', json_decode($data->size)) }}
                                            </a></li>
                                            <li>Color : <a href="javascript:void(0)">{{ $data->color }}</a></li>
                                            {{-- <li>Category : <a
                                                    href="javascript:void(0)">{{ $data->cat_id ? $data->category->name : 'N/A' }}</a>
                                            </li>
                                            <li>Sub-Category : <a
                                                    href="javascript:void(0)">{{ $data->sub_cat_id ? $data->subCategory->name : 'N/A' }}</a>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="paymnet-option">
                                    <div class="product-title">
                                        <h4>Guaranteed Safe Checkout</h4>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/1.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/2.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/3.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/4.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/5.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="product-section-box">
                                <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                            data-bs-target="#description" type="button" role="tab"
                                            aria-controls="description" aria-selected="true">Description</button>
                                    </li>
                                    @if (count($data->review) > 0)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                                data-bs-target="#review" type="button" role="tab"
                                                aria-controls="review" aria-selected="false">Review</button>
                                        </li>
                                    @endif
                                </ul>
                                <div class="tab-content custom-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                                        aria-labelledby="description-tab">
                                        <div class="product-description">
                                            <div class="nav-desh">
                                                <p>
                                                    @php
                                                        echo $data->description;
                                                    @endphp
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="review" role="tabpanel"
                                        aria-labelledby="review-tab">
                                        <div class="review-box">
                                            <div class="row g-4">
                                                <div class="col-12">
                                                    <div class="review-title">
                                                        <h4 class="fw-500">Customer Reviews</h4>
                                                    </div>
                                                    <div class="review-people">
                                                        <ul class="review-list">
                                                            @foreach ($data->review as $review)
                                                                <li>
                                                                    <div class="people-box">
                                                                        <div>
                                                                            <div class="people-image">
                                                                                <img src="{{ $review->image }}"
                                                                                    class="img-fluid blur-up lazyload"
                                                                                    alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="people-comment">
                                                                            <a class="name"
                                                                                href="javascript:void(0)">{{ $review->user->name }}</a>
                                                                            <div class="date-time">
                                                                                <h6 class="text-content">
                                                                                    {{ $review->created_at }}</h6>
                                                                                <div class="product-rating">
                                                                                    <ul class="rating">
                                                                                        @for ($i = 0; $i < $review->rating; $i++)
                                                                                            <li>
                                                                                                <i data-feather="star"
                                                                                                    class="fill"></i>
                                                                                            </li>
                                                                                        @endfor
                                                                                        @for ($i = 0; $i < 5 - $review->rating; $i++)
                                                                                            <li>
                                                                                                <i data-feather="star"></i>
                                                                                            </li>
                                                                                        @endfor
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            <div class="reply">
                                                                                <p>
                                                                                    {{ $review->description }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                    <div class="right-sidebar-box">
                        <!-- Trending Product   -->
                        <div class="pt-25">
                            <div class="category-menu">
                                <h3>Trending Products</h3>
                                <ul class="product-list product-right-sidebar border-0 p-0">
                                    @foreach ($trending as $trend)
                                        <li>
                                            <div class="offer-product">
                                                <a href="{{ route('product.details', $trend->slug) }}"
                                                    class="offer-image">
                                                    <img src="{{ $trend->thumbnail }}" class="img-fluid blur-up lazyload"
                                                        alt="">
                                                </a>
                                                <div class="offer-detail">
                                                    <div>
                                                        <a href="{{ route('product.details', $trend->slug) }}">
                                                            <h6 class="name">{{ $trend->name }}</h6>
                                                        </a>
                                                        <h5 class="price"><span
                                                                class="theme-color">${{ $trend->final_sell_price }}</span>
                                                            @if ($trend->discount)
                                                                <del>${{ $trend->sell_price }}</del>
                                                            @endif
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Banner Section -->
                        <div class="ratio_156 pt-25">
                            @if ($productBanner)
                                <div class="home-contain">
                                    <img src="{{ $productBanner->banner }}" class="bg-img blur-up lazyload"
                                        alt="">
                                    <div class="home-detail p-top-left home-p-medium">
                                        <div>
                                            <h6 class="text-yellow home-banner">{{ $productBanner->special_text }}</h6>
                                            <h3 class="text-uppercase fw-normal"><span
                                                    class="theme-color fw-bold">{{ $productBanner->header_text }}</span>
                                            </h3>
                                            <h3 class="fw-light">{{ $productBanner->short_desc }}</h3>
                                            <button onclick="window.open('{{ $productBanner->link }}', '_blank');"
                                                class="btn btn-animation btn-md fw-bold mend-auto">Shop Now <i
                                                    class="fa-solid fa-arrow-right icon"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="home-contain">
                                    <img src="{{ asset('public/frontend/assets/images/vegetable/banner/8.jpg') }}"
                                        class="bg-img blur-up lazyload" alt="">
                                    <div class="home-detail p-top-left home-p-medium">
                                        <div>
                                            <h6 class="text-yellow home-banner">Seafood</h6>
                                            <h3 class="text-uppercase fw-normal"><span
                                                    class="theme-color fw-bold">Freshes</span> Products</h3>
                                            <h3 class="fw-light">every hour</h3>
                                            <button onclick="location.href = '{{ route('home') }}';"
                                                class="btn btn-animation btn-md fw-bold mend-auto">Shop Now <i
                                                    class="fa-solid fa-arrow-right icon"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Releted Product Section Start -->
    <section class="product-list-section section-b-space">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Related Products</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="slider-6_1 product-wrapper ratio_110">
                        @foreach ($related_products as $product)
                            {{-- <div>
                                <div class="product-box-3 h-100 wow fadeInUp shadow p-3 mb-5 bg-white">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="{{ route('product.details', $product->slug) }}">
                                                <img src="{{ $product->thumbnail }}" class="img-fluid blur-up lazyload"
                                                    alt="">
                                            </a>
                                            <ul class="product-option" style="justify-content:space-evenly;width:126px;">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="{{ route('product.details', $product->slug) }}">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
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
                                                <h5 class="name">{{ Str::limit($product->name, 20) }}</h5>
                                            </a>
                                            <div class="product-rating mt-2">
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
                                                @if ($product->discount)
                                                    <strong class="discount-res"
                                                        style="color: green;margin-left:4px;">({{ $product->discount }}%
                                                        off)</strong>
                                                @endif
                                            </div>
                                            <h6 class="unit">Size:{{ count(json_decode($product->size)) }}</h6>
                                            <h5 class="price"><span
                                                    class="theme-color">${{ $product->final_sell_price }}</span>
                                                @if ($product->discount)
                                                    <del>${{ $product->sell_price }}</del>
                                                @endif
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <a class="btn btn-add-cart addcart-button" style=""
                                                    href="{{ route('product.details', $product->slug) }}">Details
                                                    <span class="add-icon bg-light-gray">
                                                        <i data-feather="eye"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
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
                </div>
            </div>
        </div>
    </section>
@endsection
