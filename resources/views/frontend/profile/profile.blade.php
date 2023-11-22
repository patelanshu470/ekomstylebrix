@extends('frontend.layouts.home_master')
@section('frontendContent')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/custom/profile/profile.css') }}">
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>My-Profile</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="#">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">My-Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="user-dashboard-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-3 col-lg-4">
                    <div class="dashboard-left-sidebar">
                        <div class="close-button d-flex d-lg-none">
                            <button class="close-sidebar">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="profile-box">
                            <div class="cover-image">
                                <img src="{{ asset('public/profile_background.jpg') }}" class="img-fluid blur-up lazyload"
                                    alt="">
                            </div>
                            <div class="profile-contain">
                                <div class="profile-image">
                                    <div class="position-relative">
                                        <img src="{{ auth()->user()->profile_image ? auth()->user()->profile_image : asset('public/no-image.png') }}"
                                            class="blur-up lazyload update_img" alt="">
                                    </div>
                                </div>
                                <div class="profile-name">
                                    <h3>{{ auth()->user()->name }}</h3>
                                    <h6 class="text-content">{{ auth()->user()->email }}</h6>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-dashboard-tab" data-bs-toggle="pill"
                                    href="#pills-dashboard" data-bs-target="#pills-dashboard" type="button" role="tab"
                                    aria-controls="pills-dashboard" aria-selected="true"><i data-feather="home"></i>
                                    DashBoard</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-order-tab" data-bs-toggle="pill" href="#pills-order"
                                    data-bs-target="#pills-order" type="button" role="tab" aria-controls="pills-order"
                                    aria-selected="false"><i data-feather="shopping-bag"></i>Order</button>
                            </li>
                            {{-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-wishlist-tab" data-bs-toggle="pill"
                                    href="#pills-wishlist" data-bs-target="#pills-wishlist" type="button" role="tab"
                                    aria-controls="pills-wishlist" aria-selected="false"><i data-feather="heart"></i>
                                    Wishlist</button>
                            </li> --}}
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-address-tab" data-bs-toggle="pill" href="#pills-address"
                                    data-bs-target="#pills-address" type="button" role="tab"
                                    aria-controls="pills-address" aria-selected="false"><i data-feather="map-pin"></i>
                                    Address</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false"><i data-feather="user"></i>
                                    Profile</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
                        Menu</button>
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel"
                                aria-labelledby="pills-dashboard-tab">
                                <div class="dashboard-home">
                                    <div class="title">
                                        <h2>My Dashboard</h2>
                                    </div>
                                    <div class="dashboard-user-name">
                                        <h6 class="text-content">Hello, <b
                                                class="text-title">{{ auth()->user()->name }}</b></h6>
                                        <p class="text-content">From your My Account Dashboard you have the ability to
                                            view a snapshot of your recent account activity and update your account
                                            information. Select a link below to view or edit information.</p>
                                    </div>
                                    <div class="total-box">
                                        <div class="row g-sm-4 g-3">
                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="totle-contain">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/order.svg"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/order.svg"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="totle-detail">
                                                        @php
                                                            $totalOrders = App\Models\Order::where([['user_id', '=', Auth()->user()->id], ['payment_status', '=', 'succeeded'], ['order_status', '=', 'delivered']])
                                                                ->get()
                                                                ->count();
                                                            $pendingOrders = App\Models\Order::where([['user_id', '=', Auth()->user()->id], ['payment_status', '=', 'succeeded'], ['order_status', '<>', 'delivered']])
                                                                ->get()
                                                                ->count();
                                                            $pendingWishlist =App\Models\Wishlist::where('user_id', Auth()->user()->id)
                                                            ->whereHas('product', function ($query) {
                                                                $query->where('status', 1);
                                                            })
                                                            ->count();
                                                        @endphp
                                                        <h5>Total Order</h5>
                                                        <h3>{{ $totalOrders }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="totle-contain">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/pending.svg"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/pending.svg"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="totle-detail">
                                                        <h5>Total Pending Order</h5>
                                                        <h3>{{ $pendingOrders }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="totle-contain">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/wishlist.svg"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/wishlist.svg"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="totle-detail">
                                                        <h5>Total Wishlist</h5>
                                                        <h3>{{ $pendingWishlist }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dashboard-title">
                                        <h3>Account Information</h3>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="dashboard-contant-title">
                                                <h4>Default-Address<a href="javascript:void(0)"></a></h4>
                                            </div>
                                            <div class="row g-4">
                                                <div class="col-xxl-12">
                                                    @php
                                                        $default_address = App\Models\Address::where([['user_id', '=', auth()->user()->id], ['default', '=', '1']])
                                                            ->get()
                                                            ->first();
                                                    @endphp
                                                    @if ($default_address)
                                                        <div class="dashboard-detail">
                                                            <h6 class="text-content"><strong>Type: </strong>
                                                                {{ $default_address->address_type }}</h6>
                                                            <h6 class="text-content"><strong>Address: </strong>
                                                                {{ $default_address->address }}</h6>
                                                            <h6 class="text-content"><strong>Land-mark: </strong>
                                                                {{ $default_address->landmark }}</h6>
                                                            <h6 class="text-content"><strong>Pin-Code: </strong>
                                                                {{ $default_address->pincode }}</h6>
                                                            <h6 class="text-content"><strong>Country: </strong>
                                                                {{ $default_address->country }}</h6>
                                                            <h6 class="text-content"><strong>State: </strong>
                                                                {{ $default_address->state }}</h6>
                                                            <h6 class="text-content"><strong>City: </strong>
                                                                {{ $default_address->city }}</h6>
                                                            <h6 class="text-content"><strong>Contact-Number: </strong>
                                                                {{ $default_address->contact_number }}</h6>
                                                        </div>
                                                    @else
                                                        <div class="dashboard-detail">
                                                            <h6 class="text-content">Default Billing Address</h6>
                                                            <h6 class="text-content">You have not set a default billing
                                                                address.</h6>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="pills-wishlist" role="tabpanel"
                                aria-labelledby="pills-wishlist-tab">
                                <div class="dashboard-wishlist">
                                    <div class="title">
                                        <h2>My Wishlist History</h2>
                                    </div>
                                    <div class="row g-sm-4 g-3">
                                        @foreach ($wishlists as $wishlist)
                                            <div class="col-xxl-3 col-lg-3 col-md-4 col-6 product-box-contain">
                                                <div class="product-box-3 h-100" style="background: white;">
                                                    <div class="product-header">
                                                        <div class="product-image">
                                                            <a
                                                                href="{{ route('product.details', $wishlist->product->slug) }}">
                                                                <img src="{{ $wishlist->product->thumbnail }}"
                                                                    class="img-fluid blur-up lazyload" alt="">
                                                            </a>
                                                            <div class="product-header-top">
                                                                <button
                                                                    class="btn wishlist-button close_button removeWishList"
                                                                    data-wishlistid="{{ $wishlist->id }}">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-footer">
                                                        <div class="product-detail">
                                                            <span class="span-name">{{ $wishlist->product->name }}</span>
                                                            <a href="#">
                                                            </a>
                                                            <h6 class="unit mt-1">Size: {{ $wishlist->product->size }}
                                                            </h6>
                                                            <h5 class="price">
                                                                <span
                                                                    class="theme-color">${{ $wishlist->product->final_sell_price }}</span>
                                                                @if ($wishlist->product->discount)
                                                                    <del>${{ $wishlist->product->sell_price }}</del>
                                                                @endif
                                                            </h5>
                                                            <div class="add-to-cart-box bg-white mt-2">
                                                                <div class="add-to-cart-box bg-white">
                                                                    <a class="btn btn-add-cart addcart-button button-add-to-cart"
                                                                        style="background: #f8f8f8"
                                                                        data-product_id="{{ $wishlist->product_id }}"
                                                                        href="#">Add to Cart
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="pills-order" role="tabpanel"
                                aria-labelledby="pills-order-tab">
                                <div class="dashboard-order">
                                    <div class="title">
                                        <h2>My Orders History</h2>
                                    </div>
                                    <div class="order-contain">
                                        @foreach ($all_orders as $order)
                                            <div class="order-box dashboard-bg-box"
                                                style="width: -webkit-fill-available;">
                                                <div class="order-container">
                                                    <div class="order-icon">
                                                        <i data-feather="box"></i>
                                                    </div>
                                                    <div class="order-detail">
                                                        <h4><a
                                                                href="{{ route('order.tracking', $order->unique_no) }}">#{{ $order->unique_no }}</a>
                                                            <span>{{ $order->order_status }}</span>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="product-order-detail">
                                                    <a href="{{ route('order.tracking', $order->unique_no) }}">
                                                        <div class="order-wrap">
                                                            <ul class="product-size">
                                                                <li>
                                                                    <div class="size-box">
                                                                        <h6 class="text-content">Grand-Total : </h6>
                                                                        <h5>${{ $order->grand_total }}</h5>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="size-box">
                                                                        @php
                                                                            $item = null;
                                                                            $item = App\Models\OrderedProduct::where('order_id', $order->id)->get();
                                                                        @endphp
                                                                        <h6 class="text-content">Items
                                                                            :{{ count($item) }}
                                                                        </h6>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="size-box">
                                                                        <h6 class="text-content">Shipping-Name:</h6>
                                                                        <h5>{{ $order->shipping_name }}</h5>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="size-box">
                                                                        <h6 class="text-content">Ordered on : </h6>
                                                                        <h5>{{ $order->created_at }}</h5>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="pills-address" role="tabpanel"
                                aria-labelledby="pills-address-tab">
                                <div class="dashboard-address">
                                    <div class="title title-flex">
                                        <div>
                                            <h2>My Address Book</h2>
                                        </div>
                                        <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3"
                                            data-bs-toggle="modal" data-bs-target="#add-address"><i data-feather="plus"
                                                class="me-2"></i> Add New Address</button>
                                    </div>
                                    @if (count($address) > 0)
                                        <div class="row g-sm-4 g-3">
                                            {{-- @php
                                                dd($address)
                                            @endphp --}}
                                            @foreach ($address as $add)
                                                <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                                    <div class="address-box">
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" disabled
                                                                    name="jack" id="flexRadioDefault2" {{ $add->default == '1' ? 'checked' : ' ' }} >
                                                            </div>
                                                            <div class="label">
                                                                <label>{{ $add->address_type }}</label>
                                                            </div>
                                                            <div class="table-responsive address-table">
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td colspan="2">{{ $add->user->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Address :</td>
                                                                            <td>
                                                                                <p>{{ $add->address }},{{ $add->city }}
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>State :</td>
                                                                            <td>
                                                                                <p>{{ $add->state }}</p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Country :</td>
                                                                            <td>
                                                                                <p>{{ $add->country }}</p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Pin Code :</td>
                                                                            <td>{{ $add->pincode }} </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Phone :</td>
                                                                            <td>{{ $add->contact_number }} </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="button-group">
                                                            <button class="btn btn-sm add-button w-100"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#edit-address{{ $add->id }}"><i
                                                                    data-feather="edit"></i>
                                                                Edit</button>
                                                            <button class="btn btn-sm add-button w-100"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#removeAddress{{ $add->id }}"><i
                                                                    data-feather="trash-2"></i>
                                                                Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- delete model  --}}
                                                <div class="modal fade theme-modal remove-profile remove-address-class"
                                                    id="removeAddress{{ $add->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div
                                                        class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-block text-center">
                                                                <h5 class="modal-title w-100" id="exampleModalLabel22">Are
                                                                    You Sure ?</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="remove-box">
                                                                    <p>Deleted data cannot be recover.</p>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-animation btn-md fw-bold"
                                                                    data-bs-dismiss="modal">No</button>
                                                                <a href="{{ route('delete.address', $add->id) }}"
                                                                    class="btn theme-bg-color btn-md fw-bold text-light">Yes</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- end  --}}
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="image" style="display: flex;justify-content: center;">
                                            <img style="width:100% !important;height:500px !important;object-fit: cover;"
                                                src="{{ asset('public/no-address.png') }}" />
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="dashboard-profile">
                                    <div class="title">
                                        <h2>My Profile</h2>
                                    </div>
                                    <div class="profile-detail dashboard-bg-box">
                                        <div class="dashboard-title">
                                            <h3>Profile Name</h3>
                                        </div>
                                        <div class="profile-name-detail">
                                            <div class="d-sm-flex align-items-center d-block">
                                                <h3>{{ auth()->user()->name }}</h3>
                                            </div>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#userProfileEdit">Edit</a>
                                        </div>
                                        <div class="location-profile">
                                            <ul>
                                                @if($default_address)
                                                <li>
                                                    <div class="location-box">
                                                        <i data-feather="map-pin"></i>
                                                        <h6>{{ $default_address->city }},{{ $default_address->country }}
                                                        </h6>
                                                    </div>
                                                </li>
                                                @endif
                                                <li>
                                                    <div class="location-box">
                                                        <i data-feather="mail"></i>
                                                        <h6>{{ auth()->user()->email }}</h6>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="profile-description">
                                            <p>All of your personal information is safe with us.We only ask for necessary
                                                details .</p>
                                        </div>
                                    </div>
                                    <div class="profile-about dashboard-bg-box">
                                        <div class="row">
                                            <div class="col-xxl-7">
                                                <div class="dashboard-title mb-3">
                                                    <h3>Profile About</h3>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Phone Number :</td>
                                                                <td>
                                                                    <a
                                                                        href="javascript:void(0)">{{ auth()->user()->mobile }}</a>
                                                                </td>
                                                            </tr>
                                                            @if($default_address)
                                                            <tr>
                                                                <td>Address :</td>
                                                                <td>{{ $default_address->address }},{{ $default_address->city }},{{ $default_address->state }},{{ $default_address->country }},{{ $default_address->pincode }}
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="dashboard-title mb-3">
                                                    <h3>Login Details</h3>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Email :</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">{{ auth()->user()->email }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Password :</td>
                                                                <td>
                                                                    <a href="javascript:void(0)">●●●●●●
                                                                        <span data-bs-toggle="modal"
                                                                            data-bs-target="#passwordChange">Edit</span></a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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
        </div>
    </section>
    <!-- Password Model-->
    <div class="modal fade theme-modal" id="passwordChange" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <form action="{{ route('change.password') }}" method="post" id="changePassword">
            @csrf
            <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-4">
                            <div class="col-xxl-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="password" class="form-control" id="old_password" name="old_password">
                                </div>
                                <span>Old Password</span><br>
                                <span style="color:red;" id="oldPassword-error"></span>
                            </div>
                            <div class="col-xxl-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="password" class="form-control" id="new_password" name="new_password">
                                </div>
                                <span>New Password</span><br>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-animation btn-md fw-bold"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="passwordSubmutBtn"
                            class="btn theme-bg-color btn-md fw-bold text-light">Update
                            Password</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Password Model End -->
    <!-- Profile Edit Model-->
    <div class="modal fade theme-modal " id="userProfileEdit" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body ">
                    <form action="{{ route('update.profile') }}" id="updateProfile" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <div class="accordion-body">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <div class="payment-method">
                                            <div class="row" style="justify-content: center">
                                                <div class="form-group col-sm-12 col-12"
                                                    style="margin-bottom: -57px;margin-top:-22px;">
                                                    <div class="avatar-upload">
                                                        <div class="avatar-edit">
                                                            <input type='file' id="imageUpload" class="file-input"
                                                                name="profile_image" accept=".png, .jpg, .jpeg" />
                                                            <label for="imageUpload"></label>
                                                        </div>
                                                        <label class="form-label-title mb-0">Image</label>
                                                        <div class="avatar-preview">
                                                            <div id="banner" class="image"
                                                                style="background-image: url('{{ auth()->user()->profile_image ? asset('public/images/profile/' . auth()->user()->profile_image) : asset('public/no-image.png') }}');">
                                                            </div>
                                                        </div>
                                                        <span class="thumbnail-error" style="color:red"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="payment-method">
                                            <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ auth()->user()->name }}"
                                                    placeholder="Please enter name">Name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="payment-method">
                                            <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                <input type="number" class="form-control" id="mobile" name="mobile"
                                                    value="{{ auth()->user()->mobile }}"
                                                    placeholder="Please enter mobile number">Mobile</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-animation btn-md fw-bold"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn theme-bg-color btn-md text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Profile Edit End -->
    <!-- Add address modal box start-->
    <div class="modal fade theme-modal " id="add-address" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body ">
                    <form action="{{ route('store.address') }}" method="get" id="addressForm">
                        <div>
                            <div class="accordion-body">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="payment-method">
                                            <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                <input type="text" class="form-control" id="credit2" name="address"
                                                    placeholder="Please enter address">Address</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="payment-method">
                                            <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                <input list="atypes" class="form-control" id=""
                                                    name="address_type" placeholder="Address Type (e.g. Home, Office, Work)">Address-Type (e.g. Home, Office, Work)</label>
                                                <datalist id="atypes">
                                                    <option value="home">
                                                    <option value="work">
                                                    <option value="office">
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="payment-method">
                                            <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                <input type="text" class="form-control" id="landmark"
                                                    name="landmark" placeholder="Please enter land mark">Land-mark</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="payment-method">
                                            <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                <input type="number" class="form-control" id="pincode" name="pincode"
                                                    placeholder="Please enter pincode">Pin-Code</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="payment-method">
                                            <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                <input type="text" class="form-control" id="country" name="country"
                                                    placeholder="Please enter pincode">Country</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="payment-method">
                                            <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                <input type="text" class="form-control" id="state" name="state"
                                                    placeholder="Please enter state">State</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="payment-method">
                                            <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                <input type="text" class="form-control" id="city" name="city"
                                                    placeholder="Please enter city">City</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="payment-method">
                                            <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                <input type="number" class="form-control" id="contact_number"
                                                    name="contact_number"
                                                    placeholder="Please enter Contact Number">Contact
                                                Number</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="payment-method">
                                            <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                <div class="form-check form-switch switch-radio ms-auto">
                                                    <input class="form-check-input" name="default" value="1"
                                                        type="checkbox" role="switch" style="width:37px;height:20px;"
                                                        id="redio3" aria-checked="false">
                                                    <label class="form-check-label"
                                                        style="margin-top:2px;margin-left:10px;" for="redio3">Set as
                                                        default?</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-animation btn-md fw-bold"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn theme-bg-color btn-md text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add address modal box end -->
    <!-- update address modal box start :-->
    @foreach ($address as $add)
        <div class="modal fade theme-modal " id="edit-address{{ $add->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <form action="{{ route('update.address', $add->id) }}" method="get"
                            id="addressFormEdit{{ $add->id }}">
                            @csrf
                            <div>
                                <div class="accordion-body">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="payment-method">
                                                <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                    <input type="text" class="form-control" id="credit2"
                                                        name="address" value="{{ $add->address }}"
                                                        placeholder="Please enter address">Address</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="payment-method">
                                                <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                    <input type="text" class="form-control" id=""
                                                        name="address_type" value="{{ $add->address_type }}"
                                                        placeholder="Home,Office,Home1,Neighbour...">Address-Type</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="payment-method">
                                                <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                    <input type="text" class="form-control" id="landmark"
                                                        name="landmark" value="{{ $add->landmark }}"
                                                        placeholder="Please enter land mark">Land-mark</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="payment-method">
                                                <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                    <input type="number" class="form-control" id="pincode"
                                                        name="pincode" value="{{ $add->pincode }}"
                                                        placeholder="Please enter pincode">Pin-Code</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="payment-method">
                                                <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                    <input type="text" class="form-control" id="country"
                                                        name="country" value="{{ $add->country }}"
                                                        placeholder="Please enter pincode">Country</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="payment-method">
                                                <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                    <input type="text" class="form-control" id="state"
                                                        value="{{ $add->state }}" name="state"
                                                        placeholder="Please enter state">State</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="payment-method">
                                                <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                    <input type="text" class="form-control" id="city"
                                                        value="{{ $add->city }}" name="city"
                                                        placeholder="Please enter city">City</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="payment-method">
                                                <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                    <input type="number" class="form-control" id="contact_number"
                                                        name="contact_number" value="{{ $add->contact_number }}"
                                                        placeholder="Please enter Contact Number">Contact
                                                    Number</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="payment-method">
                                                <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                    <div class="form-check form-switch switch-radio ms-auto">
                                                        <input class="form-check-input" name="default"
                                                            {{ $add->default == '1' ? 'checked' : ' ' }} value="1"
                                                            type="checkbox" role="switch"
                                                            style="width:37px;height:20px;" id="redio3"
                                                            aria-checked="false">
                                                        <label class="form-check-label"
                                                            style="margin-top:2px;margin-left:10px;" for="redio3">Set
                                                            as default?</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-animation btn-md fw-bold"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn theme-bg-color btn-md text-white">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- update address modal box end -->
    <!-- Edit Card Start -->
    <div class="modal fade theme-modal" id="editCard" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel8">Edit Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-xxl-6">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="finame" value="Mark">
                                    <label for="finame">First Name</label>
                                </div>
                            </form>
                        </div>
                        <div class="col-xxl-6">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="laname" value="Jecno">
                                    <label for="laname">Last Name</label>
                                </div>
                            </form>
                        </div>
                        <div class="col-xxl-4">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <select class="form-select" id="floatingSelect12"
                                        aria-label="Floating label select example">
                                        <option selected>Card Type</option>
                                        <option value="kindom">Visa Card</option>
                                        <option value="states">MasterCard Card</option>
                                        <option value="fra">RuPay Card</option>
                                        <option value="china">Contactless Card</option>
                                        <option value="spain">Maestro Card</option>
                                    </select>
                                    <label for="floatingSelect12">Card Type</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-animation btn-md fw-bold"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn theme-bg-color btn-md fw-bold text-light">Update Card</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Card End -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{asset('public/frontend/custom/profile/profile.js')}}"></script>
    @foreach ($address as $add)
        <script>
            $('#addressFormEdit{{ $add->id }}').validate({
                rules: {
                    address: {
                        required: true,
                    },
                    contact_number: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },
                    state: {
                        required: true,
                    },
                    country: {
                        required: true,
                    },
                    landmark: {
                        required: true,
                    },
                    address_type: {
                        required: true,
                    },
                    pincode: {
                        required: true,
                    },
                },

            });
        </script>
    @endforeach
    <!-- Wishlist Section End : -->
    {{-- <script>
        $(document).ready(function() {
            $('.removeWishList').on('click', function() {
                var wishlistID = $(this).data('wishlistid');
                $.ajax({
                    url: "{{ route('delete.wishlist') }}",
                    type: "POST",
                    data: {
                        id: wishlistID,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result) {
                            $('#wishlist-total').text(result.wishlist_total);

                            $.notify({
                                icon: "fa fa-check",
                                title: "Success!",
                                message: "Item Successfully added to Wishlist",
                            }, {
                                element: "body",
                                position: null,
                                type: "info",
                                allow_dismiss: true,
                                newest_on_top: false,
                                showProgressbar: true,
                                placement: {
                                    from: "top",
                                    align: "right",
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 1031,
                                delay: 5000,
                                animate: {
                                    enter: "animated fadeInDown",
                                    exit: "animated fadeOutUp",
                                },
                                icon_type: "class",
                                template: '<div data-notify="container" class="col-xxl-3 col-lg-5 col-md-6 col-sm-7 col-12 alert alert-{0}" role="alert">' +
                                    '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
                                    '<span data-notify="icon"></span> ' +
                                    '<span data-notify="title">{1}</span> ' +
                                    '<span data-notify="message">{2}</span>' +
                                    '<div class="progress" data-notify="progressbar">' +
                                    '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                    "</div>" +
                                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                    "</div>",
                            });
                        }
                    }
                });
            });
        });
    </script> --}}
    {{-- old password check  --}}
    <script>
        $(document).ready(function() {
            $('#old_password').on('keyup', function() {
                var old_password = $('#old_password').val();
                $.ajax({
                    url: "{{ route('check.password') }}",
                    type: "POST",
                    data: {
                        old_password: old_password,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        // console.log(result.result == 'success');
                        if (result.result == 'success') {
                            $('#oldPassword-error').text('Password Matched.').css('color',
                                'green');
                            $('#passwordSubmutBtn').prop('disabled', false);
                        } else {
                            $('#oldPassword-error').text('Wrong Password.').css('color',
                                'red');
                            $('#passwordSubmutBtn').prop('disabled', true);
                        }
                    }
                });
            });
        });
    </script>
@endsection
