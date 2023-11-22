<footer class="section-t-space footer-section-2 footer-color-3">
    <div class="container-fluid-lg">
        <div class="main-footer">
            <div class="row g-md-4 gy-sm-5">
                <div class="col-xxl-3 col-xl-4 col-sm-6">
                    {{-- <a href="index.html" class="foot-logo theme-logo">
                        <img src="{{ asset('resources/assets/assets/images/logo/4.png') }}"
                            class="img-fluid blur-up lazyload" alt="">
                    </a> --}}
                    <p class="information-text information-text-2">We are here to provide you with best products we
                        have,on time.</p>
                    @php
                        $social = App\Models\WebsiteDetails::get()->first();
                    @endphp
                    @if ($social)
                        <ul class="social-icon">
                            @if ($social->fb_url)
                                <li class="light-bg">
                                    <a href="{{$social->fb_url}}" class="footer-link-color">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                            @endif
                            @if ($social->twitter_url)
                                <li class="light-bg">
                                    <a href="{{$social->twitter_url}}" class="footer-link-color">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                            @endif
                            @if ($social->insta_url)
                                <li class="light-bg">
                                    <a href="{{$social->insta_url}}" class="footer-link-color">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                            @endif
                            @if ($social->pinterest_url)
                                <li class="light-bg">
                                    <a href="{{$social->pinterest_url}}" class="footer-link-color">
                                        <i class="fab fa-pinterest-p"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif

                </div>

                <div class="col-xxl-2 col-xl-4 col-sm-6">
                    <div class="footer-title">
                        <h4 class="text-white">About Stylebrix</h4>
                    </div>
                    <ul class="footer-list footer-contact footer-list-light">
                        <li>
                            <a href="{{ route('about.us') }}" class="light-text">About Us</a>
                        </li>
                        <li>
                            <a href="{{ route('contact.us') }}" class="light-text">Contact Us</a>
                        </li>
                        <li>
                            <a href="{{ route('terms') }}" class="light-text">Terms & Coditions</a>
                        </li>

                    </ul>
                </div>
                {{-- attention:  --}}
                <div class="col-xxl-2 col-xl-4 col-sm-6">
                    <div class="footer-title">
                        <h4 class="text-white">Useful Link</h4>
                    </div>
                    <ul class="footer-list footer-list-light footer-contact">
                        <li>
                            <a href="{{route('view.profile')}}" class="light-text">Your Order</a>
                        </li>
                        <li>
                            <a href="{{route('view.profile')}}" class="light-text">Your Account</a>
                        </li>
                        <li>
                            <a href="{{route('wishlist')}}" class="light-text">Your Wishlist</a>
                        </li>
                        <li>
                            <a href="{{route('faq')}}" class="light-text">FAQs</a>
                        </li>
                    </ul>
                </div>
                @php
                    $category = App\Models\Category::where('status', 1)
                        ->limit(5)
                        ->get();
                @endphp
                <div class="col-xxl-2 col-xl-4 col-sm-6">
                    <div class="footer-title">
                        <h4 class="text-white">Categories</h4>
                    </div>
                    <ul class="footer-list footer-list-light footer-contact">
                        @foreach ($category as $cat)
                            <li>
                                <form action="{{ route('shop') }}" id="footerForm{{ $cat->id }}">
                                    <input type="hidden" name="category" value="{{ $cat->id }}">
                                    <a class="light-text" id="footerCat{{ $cat->id }}"
                                        href="javascript:void(0)">{{ $cat->name }}</a>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @php
                    $website = App\Models\WebsiteDetails::get()->first();
                @endphp
                @if ($website)
                    <div class="col-xxl-3 col-xl-4 col-sm-6">
                        <div class="footer-title">
                            <h4 class="text-white">Store infomation</h4>
                        </div>
                        <ul class="footer-address footer-contact">
                            <li>
                                <a href="javascript:void(0)" class="light-text">
                                    <div class="inform-box flex-start-box">
                                        <i data-feather="map-pin"></i>
                                        <p>{{ $website->location }}</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="light-text">
                                    <div class="inform-box">
                                        <i data-feather="mail"></i>
                                        <p>Email : {{ $website->email }}</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="sub-footer sub-footer-lite section-b-space section-t-space">
            <div class="left-footer">
                <p class="light-text">2023-2024 Copyright {{ getenv('WEBSITE_NAME') }}</p>
            </div>
            <ul class="payment-box">
                <li>
                    <img src="{{ asset('public/frontend/assets/images/icon/paymant/visa.png') }}"
                        class="blur-up lazyload" alt="">
                </li>
                <li>
                    <img src="{{ asset('public/frontend/assets/images/icon/paymant/discover.png') }}" alt=""
                        class="blur-up lazyload">
                </li>
                <li>
                    <img src="{{ asset('public/frontend/assets/images/icon/paymant/american.png') }}" alt=""
                        class="blur-up lazyload">
                </li>
                <li>
                    <img src="{{ asset('public/frontend/assets/images/icon/paymant/master-card.png') }}" alt=""
                        class="blur-up lazyload">
                </li>
                <li>
                    <img src="{{ asset('public/frontend/assets/images/icon/paymant/giro-pay.png') }}" alt=""
                        class="blur-up lazyload">
                </li>
            </ul>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@foreach ($category as $cat)
    <script>
        $(document).ready(function() {
            $('#footerCat{{ $cat->id }}').on('click', function() {
                $('#footerForm{{ $cat->id }}').submit();
            });

        });
    </script>
@endforeach
