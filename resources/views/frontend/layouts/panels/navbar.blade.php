<header class="">
    <style>
        header .navbar.navbar-expand-xl .navbar-nav .custom-nav::before {
            content: inherit;
        }
    </style>
    <div class="top-nav top-header sticky-header">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="navbar-top">
                        <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                            <span class="navbar-toggler-icon">
                                <i class="fa-solid fa-bars"></i>
                            </span>
                        </button>
                        <a href="{{ route('home') }}" class="web-logo nav-logo">
                            <img src="{{ asset(getenv('WEBSTIE_LOGO')) }}" class="img-fluid blur-up lazyload"
                                alt="">
                        </a>
                        <div class="header-nav-middle">
                            <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                                <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                    <div class="offcanvas-header navbar-shadow">
                                        <h5>Menu</h5>
                                        <button class="btn-close lead" type="button" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <ul class="navbar-nav">
                                            <li
                                                class="nav-item {{ Route::currentRouteName() === 'home' ? 'active' : '' }}">
                                                <a class="nav-link custom-nav " href="{{ route('home') }}">Home</a>
                                            </li>
                                            <li
                                                class="nav-item {{ Route::currentRouteName() === 'shop' ? 'active' : '' }}">
                                                <a class="nav-link custom-nav" href="{{ route('shop') }}">Shop</a>
                                            </li>
                                            @php
                                                $category = App\Models\Category::where('status', 1)->get();
                                            @endphp
                                            @foreach ($category as $cat)                                               
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                        data-bs-toggle="dropdown">{{ $cat->name }}</a>
                                                    <ul class="dropdown-menu">
                                                        @php
                                                            $subcategory = App\Models\SubCategory::where('cat_id',$cat->id)->where('status', 1)->get();
                                                        @endphp
                                                        @if (count($subcategory) > 0)                                                           
                                                            @foreach ($subcategory as $subcat)
                                                                <li>
                                                                    <form action="{{ route('shop') }}"
                                                                        id="shopForm{{ $subcat->id }}">
                                                                        <input type="hidden" name="subcategory"
                                                                            value="{{ $subcat->id }}">
                                                                        <a class="dropdown-item"
                                                                            id="categoryID{{ $subcat->id }}"
                                                                            href="javascript:void(0)">{{ $subcat->name }}</a>
                                                                    </form>
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <li>Comming Soon</li>
                                                        @endif
                                                    </ul>
                                                </li>
                                            @endforeach
                                            <li
                                                class="nav-item {{ Route::currentRouteName() === 'contact.us' ? 'active' : '' }}">
                                                <a class="nav-link custom-nav"
                                                    href="{{ route('contact.us') }}">Contact Us</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="rightside-box">
                            <div class="search-full">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i data-feather="search" class="font-light"></i>
                                    </span>
                                    <input type="text" class="form-control search-type" placeholder="Search here..">
                                    <span class="input-group-text close-search">
                                        <i data-feather="x" class="font-light"></i>
                                    </span>
                                </div>
                            </div>
                            <ul class="right-side-menu">
                                <li class="right-side">
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <div class="search-box">
                                                <i data-feather="search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="right-side">
                                    <a href="{{ route('wishlist') }}"
                                        class="btn p-0 position-relative header-wishlist">
                                        @php
                                            if (auth()->check()) {
                                                $wishlist_total = \App\Models\Wishlist::where('user_id', Auth()->user()->id)
                                                    ->whereHas('product', function ($query) {
                                                        $query->where('status', 1);
                                                    })
                                                    ->count();
                                            } else {
                                                $wishlist_total = 0;
                                            }
                                        @endphp
                                        <i data-feather="heart"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge"
                                            id="wishlist-total">{{ $wishlist_total }}</span>
                                    </a>
                                </li>
                                <li class="right-side">
                                    <div class="onhover-dropdown header-badge">
                                        <a href="{{ route('view.cart') }}"
                                            class="btn p-0 position-relative header-wishlist">
                                            <i data-feather="shopping-cart"></i>
                                            @php
                                                if (auth()->check()) {
                                                    $cart_total = \App\Models\Cart::where('user_id', Auth()->user()->id)
                                                        ->whereHas('product', function ($query) {
                                                            $query->where('status', 1);
                                                        })
                                                        ->count();
                                                } else {
                                                    $cart_total = 0;
                                                }
                                            @endphp
                                            <span class="position-absolute top-0 start-100 translate-middle badge"
                                                id="cart-total">{{ $cart_total }}</span>
                                        </a>
                                    </div>
                                </li>
                                <li class="right-side onhover-dropdown">
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                        <div class="delivery-detail">
                                            @if (auth()->check())
                                                <h6>Hello,</h6>
                                                <h5>{{ auth()->user()->name }}</h5>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="onhover-div onhover-div-login">
                                        <ul class="user-box-name">
                                            @if (auth()->check())
                                                <li class="product-box-contain">
                                                    <i></i>
                                                    <a href="{{ route('view.profile') }}">My Profile</a>
                                                </li>
                                                <li class="product-box-contain">
                                                    <a href="javascript:void(0)"
                                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        Log out
                                                    </a>
                                                </li>
                                            @else
                                                <li class="product-box-contain">
                                                    <i></i>
                                                    <a href="{{ route('login') }}">Log In</a>
                                                </li>
                                                <li class="product-box-contain">
                                                    <a href="{{ route('register') }}">Register</a>
                                                </li>
                                            @endif
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@foreach ($category as $cat)
    <script>
        $(document).ready(function() {
            $('#categoryID{{ $cat->id }}').on('click', function() {
                $('#shopForm{{ $cat->id }}').submit();
            });

        });
    </script>
@endforeach
