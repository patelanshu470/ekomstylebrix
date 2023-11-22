@extends('frontend.layouts.home_master')
@section('frontendContent')
    <style>
        .alert-danger {
            margin: 41px;
        }

        .error {
            color: red !important;
        }
    </style>
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Checkout</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="#">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="checkout-section-2 section-b-space">
        <div class="container-fluid-lg">
            <form method="post" action="{{ route('checkout') }}" id="checkoutForm">
                <div class="row g-sm-4 g-3">
                    @csrf
                    <div class="col-lg-8">
                        <div class="left-sidebar-checkout">
                            <div class="checkout-detail-box">
                                <ul>
                                    @if (count($address) > 0)
                                        <li>
                                            <div class="checkout-icon">
                                                <lord-icon target=".nav-item" src="https://cdn.lordicon.com/ggihhudh.json"
                                                    trigger="loop-on-hover"
                                                    colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a"
                                                    class="lord-icon">
                                                </lord-icon>
                                            </div>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>Billing Address</h4>
                                                </div>
                                                <div class="checkout-detail">
                                                    <div class="row g-4">
                                                        @foreach ($address as $add)
                                                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                                                <div class="delivery-address-box">
                                                                    <div>
                                                                        <div class="form-check common-checkbox">
                                                                            <input class="form-check-input" type="radio"
                                                                                {{ $add->default == '1' ? 'checked' : '' }}
                                                                                name="address_id"
                                                                                value="{{ $add->id }}"
                                                                                id="flexRadioDefault1">
                                                                        </div>
                                                                        <div class="label">
                                                                            <label>{{ $add->address_type }}</label>
                                                                        </div>
                                                                        <ul class="delivery-address-detail">
                                                                            <li>
                                                                                <h4 class="fw-500">{{ $add->user->name }}
                                                                                </h4>
                                                                            </li>
                                                                            <li>
                                                                                <p class="text-content"><span
                                                                                        class="text-title">
                                                                                        Address:</span>{{ $add->address }}
                                                                                </p>
                                                                            </li>
                                                                            <li>
                                                                                <h6 class="text-content"><span
                                                                                        class="text-title">Pin
                                                                                        Code:</span>{{ $add->pincode }}</h6>
                                                                            </li>
                                                                            <li>
                                                                                <h6 class="text-content"><span
                                                                                        class="text-title">Land-Mark:</span>{{ $add->landmark }}
                                                                                </h6>
                                                                            </li>
                                                                            <li>
                                                                                <h6 class="text-content"><span
                                                                                        class="text-title">Country:</span>{{ $add->country }}
                                                                                </h6>
                                                                            </li>
                                                                            <li>
                                                                                <h6 class="text-content"><span
                                                                                        class="text-title">State:</span>{{ $add->state }}
                                                                                </h6>
                                                                            </li>

                                                                            <li>
                                                                                <h6 class="text-content"><span
                                                                                        class="text-title">City:</span>{{ $add->city }}
                                                                                </h6>
                                                                            </li>
                                                                            <li>
                                                                                <h6 class="text-content mb-0"><span
                                                                                        class="text-title">Phone:</span>{{ $add->contact_number }}
                                                                                </h6>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @else
                                        <li>
                                            <div class="checkout-icon">
                                                <lord-icon target=".nav-item" src="https://cdn.lordicon.com/qmcsqnle.json"
                                                    trigger="loop-on-hover" colors="primary:#0baf9a,secondary:#0baf9a"
                                                    class="lord-icon">
                                                </lord-icon>
                                            </div>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>Billing Address</h4>
                                                </div>
                                                <div class="checkout-detail">
                                                    <div class="accordion accordion-flush custom-accordion"
                                                        id="accordionFlushExample">
                                                        <div class="accordion-item">
                                                            <div>
                                                                <div class="accordion-body">
                                                                    <div class="row g-2">
                                                                        <div class="col-12">
                                                                            <div class="payment-method">
                                                                                <div
                                                                                    class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                    <input type="text"
                                                                                        class="form-control" id="address"
                                                                                        name="b_address"
                                                                                        placeholder="Please enter address">Address</label>
                                                                                </div>
                                                                            </div>
                                                                            @error('b_address')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-xxl-4">
                                                                            <div class="payment-method">
                                                                                <div
                                                                                    class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="address_type" name="b_type"
                                                                                        value="{{ old('b_type') }}"
                                                                                        placeholder="Home,Home1,Office...">Address-Type</label>
                                                                                </div>
                                                                                @error('b_type')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xxl-4">
                                                                            <div class="payment-method">
                                                                                <div
                                                                                    class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                    <input type="text"
                                                                                        class="form-control" id="landmark"
                                                                                        name="b_landmark"
                                                                                        placeholder="Please enter land mark">Land-mark</label>
                                                                                </div>
                                                                            </div>
                                                                            @error('b_landmark')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-xxl-4">
                                                                            <div class="payment-method">
                                                                                <div
                                                                                    class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        id="pincode" name="b_pincode"
                                                                                        placeholder="Please enter pincode">Pin-Code</label>
                                                                                </div>
                                                                            </div>
                                                                            @error('b_pincode')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-xxl-4">
                                                                            <div class="payment-method">
                                                                                <div
                                                                                    class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="country" name="b_country"
                                                                                        placeholder="Please enter pincode">Country</label>
                                                                                </div>
                                                                            </div>
                                                                            @error('b_country')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-xxl-4">
                                                                            <div class="payment-method">
                                                                                <div
                                                                                    class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="state" name="b_state"
                                                                                        placeholder="Please enter state">State</label>
                                                                                </div>
                                                                            </div>
                                                                            @error('b_state')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-xxl-4">
                                                                            <div class="payment-method">
                                                                                <div
                                                                                    class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="city" name="b_city"
                                                                                        placeholder="Please enter city">City</label>
                                                                                </div>
                                                                            </div>
                                                                            @error('b_city')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-xxl-4">
                                                                            <div class="payment-method">
                                                                                <div
                                                                                    class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        id="contact_number"
                                                                                        name="b_contact_number"
                                                                                        placeholder="Please enter Contact Number">Contact
                                                                                    Number</label>
                                                                                </div>
                                                                            </div>
                                                                            @error('b_contact_number')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    <li>
                                        <div class="checkout-icon">

                                        </div>
                                        <div class="checkout-box">
                                            <div class="checkout-title">
                                                <h4>Ship to different address?</h4>
                                            </div>
                                            <div class="checkout-detail">
                                                <div class="accordion accordion-flush custom-accordion"
                                                    id="accordionFlushExample">
                                                    <div class="accordion-item">
                                                        <div class="accordion-header" id="flush-headingOne">
                                                            <div class="accordion-button collapsed">
                                                                <div
                                                                    class="custom-form-check form-check mb-0 common-checkbox">
                                                                    <div class="form-floating  theme-form-floating">
                                                                        <div
                                                                            class="form-check form-switch switch-radio ms-auto">
                                                                            <input class="form-check-input"
                                                                                id="collaspe_btn"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#flush-collapseOne"
                                                                                name="ship_diff_address" value="1"
                                                                                type="checkbox" role="switch"
                                                                                style="width:37px;height:20px;margin-lef:0px !important;"
                                                                                id="redio3" aria-checked="false">
                                                                            <label class="form-check-label"
                                                                                style="margin-top:2px;margin-left:10px;"
                                                                                for="redio3">Add address</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if ($errors->any())
                                                                <div class="alert alert-danger">
                                                                    <ul>
                                                                        @foreach ($errors->all() as $error)
                                                                            <li>{{ $error }}</li><br>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                            data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body">
                                                                <div class="row g-2">
                                                                    <div class="col-12">
                                                                        <div class="payment-method">
                                                                            <div
                                                                                class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                <input type="text" class="form-control"
                                                                                    id="s_name" name="s_name"
                                                                                    placeholder="Please enter name">Name</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="payment-method">
                                                                            <div
                                                                                class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                <input type="email" class="form-control"
                                                                                    id="s_email" name="s_email"
                                                                                    placeholder="Please enter email">Email</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="payment-method">
                                                                            <div
                                                                                class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                <input type="text" class="form-control"
                                                                                    id="credit2" name="s_address"
                                                                                    placeholder="Please enter address">Address</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-4">
                                                                        <div class="payment-method">
                                                                            <div
                                                                                class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                <input type="text" class="form-control"
                                                                                    id="landmark" name="s_landmark"
                                                                                    placeholder="Please enter land mark">Land-mark</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-4">
                                                                        <div class="payment-method">
                                                                            <div
                                                                                class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                <input type="number" class="form-control"
                                                                                    id="pincode" name="s_pincode"
                                                                                    placeholder="Please enter pincode">Pin-Code</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-4">
                                                                        <div class="payment-method">
                                                                            <div
                                                                                class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                <input type="text" class="form-control"
                                                                                    id="country" name="s_country"
                                                                                    placeholder="Please enter pincode">Country</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-4">
                                                                        <div class="payment-method">
                                                                            <div
                                                                                class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                <input type="text" class="form-control"
                                                                                    id="state" name="s_state"
                                                                                    placeholder="Please enter state">State</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-4">
                                                                        <div class="payment-method">
                                                                            <div
                                                                                class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                <input type="text" class="form-control"
                                                                                    id="city" name="s_city"
                                                                                    placeholder="Please enter city">City</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-4">
                                                                        <div class="payment-method">
                                                                            <div
                                                                                class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                <input type="number" class="form-control"
                                                                                    id="contact_number"
                                                                                    name="s_contact_number"
                                                                                    placeholder="Please enter Contact Number">Contact
                                                                                Number</label>
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
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="right-side-summery-box">
                            <div class="summery-box-2">
                                <div class="summery-header">
                                    <h3>Order Summery</h3>
                                </div>
                                <div class="coupon-cart">
                                    <h4 class="text-content mb-2">Coupon Apply</h4>
                                    <div class=" coupon-box input-group">
                                        <input type="text" class="form-control" id="couponCode" name="couponCode"
                                            placeholder="Enter Coupon Code Here...">
                                        <a href="javascript:void(0)" onclick="coupon()"
                                            class="btn-apply btn btn-animation proceed-btn fw-bold">Apply</a>
                                    </div>
                                    <span class="coupon-error mb-3"></span>
                                </div>
                                <ul class="summery-contain">
                                    @foreach ($cart_data as $data)
                                        <li>
                                            <img src="{{ $data->product->thumbnail }}"
                                                class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                            <h4>{{ $data->product->name }} <span> X {{ $data->quantity }}</span></h4>
                                            <h4 class="price">${{ $data->product->final_sell_price }}</h4>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="summery-total">
                                    <li>
                                        <h4>Subtotal</h4>
                                        <h4 class="price">${{ $subTotal }}</h4>
                                    </li>
                                    <li>
                                        <h4>You Save</h4>
                                        <h4 class="price">- ${{ $totalSaved }}</h4>
                                    </li>
                                    <li>
                                        <h4>Coupon Discount</h4>
                                        <h4 class="price" id="couponAmount">$0</h4>
                                    </li>
                                    <li class="list-total">
                                        <h4>Total (USD)</h4>
                                        <h4 class="price" id="grandTotal">${{ $total }}</h4>
                                    </li>
                                </ul>
                            </div>
                            <div class="checkout-offer">
                                <div class="offer-title">
                                    <div class="offer-icon">
                                        <img src="../assets/images/inner-page/offer.svg" class="img-fluid"
                                            alt="">
                                    </div>
                                    <div class="offer-name">
                                        <h6>Available Offers</h6>
                                    </div>
                                </div>
                                <ul class="offer-detail">
                                    <li>
                                        <p>Combo: BB Royal Almond/Badam Californian, Extra Bold 100 gm...</p>
                                    </li>
                                    <li>
                                        <p>combo: Royal Cashew Californian, Extra Bold 100 gm + BB Royal Honey 500 gm</p>
                                    </li>
                                </ul>
                            </div>
                            <button type="submit" class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">Place
                                Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ asset('public/frontend/custom/checkout/checkout.js') }}"></script>
    {{-- coupon code   --}}
    <script>
        // coupon check
        $(document).ready(function() {
            $('.btn-apply').on('click', function() {
                var code = $('#couponCode').val();
                $.ajax({
                    url: "{{ route('coupon.apply') }}",
                    type: "POST",
                    data: {
                        code: code,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.discount) {
                            if (result.discount == 'used') {
                                $('.coupon-error').text('You have already used this coupon.')
                                    .css('color', 'orange');
                                coupenReset();
                            } else {
                                $('.coupon-error').text('Coupon is applied.').css('color',
                                    'green');
                                coupon(result.discount);
                            }
                        } else {
                            $('.coupon-error').text('Coupon is unavailable.').css('color',
                                'red');
                            coupenReset();
                        }
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#couponCode').on('keyup', function() {
                var code = $('#couponCode').val();
                $.ajax({
                    url: "{{ route('coupon.apply') }}",
                    type: "POST",
                    data: {
                        code: code,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.discount) {
                            if (result.discount == 'used') {
                                $('.coupon-error').text('You have already used this coupon.')
                                    .css('color', 'orange');
                                coupenReset();
                            } else {
                                $('.coupon-error').text('Coupon is applied.').css('color',
                                    'green');
                                coupon(result.discount);
                            }
                        } else {
                            $('.coupon-error').text('Coupon is unavailable.').css('color',
                                'red');
                            coupenReset();
                        }
                    }
                });
            });
        });

        function coupon(discount) {
            price = '{{ $total }}';
            couponDiscount = discount;
            couponAmount = price * couponDiscount / 100;
            grandTotal = price - couponAmount;
            $("#couponAmount").text('$' + couponAmount);
            $("#grandTotal").text('$' + grandTotal);
        }

        function coupenReset() {
            price = '{{ $total }}';
            $("#couponAmount").text('$' + 0);
            $("#grandTotal").text('$' + price);
        }
    </script>
@endsection
