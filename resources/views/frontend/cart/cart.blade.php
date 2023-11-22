@extends('frontend.layouts.home_master')
@section('frontendContent')
<style>
    .cart-table table tbody tr td .quantity-price .cart_qty button{
        width: calc(25px + (35 - 29) * ((100vw - 320px) / (1920 - 320)));
        height: calc(25px + (35 - 29) * ((100vw - 320px) / (1920 - 320)));
    }
</style>
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Cart</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (count($cart_data) > 0)
        <section class="cart-section section-b-space">
            <div class="container-fluid-lg">
                <div class="row g-sm-5 g-3">
                    <div class="col-xxl-9">
                        <div class="cart-table">
                            <div class="table-responsive-xl">
                                <table class="table">
                                    <tbody>
                                        @foreach ($cart_data as $data)
                                            <tr class="product-box-contain">
                                                <td class="product-detail">
                                                    <div class="product border-0">
                                                        <a href="#" class="product-image">
                                                            <img src="{{ $data->product->thumbnail }}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>
                                                        <div class="product-detail">
                                                            <ul>
                                                                <li class="name">
                                                                    <a href="#">{{ Str::limit($data->product->name,15) }}</a>
                                                                </li>
                                                                <li class="text-content"><span
                                                                        class="text-title">Size:</span>
                                                                    {{ $data->size }}</li>
                                                                <li>
                                                                    <h5 class="text-content d-inline-block">Price:</h5>
                                                                    <span>${{ $data->product->final_sell_price }}</span>
                                                                    @if ($data->product->discount)
                                                                        <del
                                                                            class="text-content">${{ $data->product->sell_price }}</del>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="price">
                                                    <h4 class="table-title text-content">Price</h4>
                                                    <h5 class="product-price{{ $data->id }}"
                                                        data-finalsellprice="{{ $data->product->final_sell_price }}"
                                                        data-sellprice="{{ $data->product->discount ? $data->product->sell_price : $data->product->final_sell_price }}">
                                                        ${{ $data->product->final_sell_price }}
                                                        @if ($data->product->discount)
                                                            <del
                                                                class="text-content">${{ $data->product->sell_price }}</del>
                                                        @endif
                                                    </h5>
                                                    <h6 class="theme-color">
                                                        @if ($data->product->discount)
                                                            You Save :
                                                            <span class="single-saved-amount{{ $data->id }}"
                                                                data-singlesaveprice="{{ $data->product->sell_price - $data->product->final_sell_price }}">${{ $data->product->sell_price - $data->product->final_sell_price }}</span>
                                                        @endif
                                                    </h6>
                                                </td>
                                                <td class="quantity{{ $data->id }}">
                                                    <h4 class="table-title text-content">Qty</h4>
                                                    <div class="quantity-price">
                                                        <div class="cart_qty">
                                                            <div class="input-group">
                                                                <button type="button" data-cartid="{{ $data->id }}"
                                                                    class="btn qty-left-minus-custom{{ $data->id }}"
                                                                    data-type="minus" data-field="">
                                                                    <i class="fa fa-minus ms-0" aria-hidden="true"></i>
                                                                </button>
                                                                <input id="quantityInput"
                                                                    class="form-control input-number qty-input{{ $data->id }}"
                                                                    type="text" readonly name="quantity"
                                                                    value="{{ $data->quantity }}">
                                                                <button type="button" data-cartid="{{ $data->id }}"
                                                                    class="btn qty-right-plus-custom{{ $data->id }}"
                                                                    data-type="plus" data-field="">
                                                                    <i class="fa fa-plus ms-0" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="subtotal">
                                                    <h4 class="table-title text-content">Total </h4>
                                                    <h5 class="single-total-price{{ $data->id }}">
                                                        ${{ $data->product->final_sell_price * $data->quantity }}
                                                    </h5>
                                                </td>
                                                <td class="save-remove">
                                                    <h4 class="table-title text-content">Action</h4>
                                                    <a class="remove close_button" href="javascript:void(0)"
                                                        id="removeItem{{ $data->id }}"
                                                        data-id="{{ $data->id }}">Remove</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3">
                        <div class="summery-box p-sticky">
                            <div class="summery-header">
                                <h3>Cart Total</h3>
                            </div>
                            <div class="summery-contain">
                                <ul>
                                    <li>
                                        <h4>Subtotal</h4>
                                        <h4 class="price ">
                                            $<span class="all-product-sub-total"
                                                data-allproductsubtotal="{{ $subTotal }}">{{ $subTotal }}</span>
                                        </h4>
                                    </li>
                                    <li class="align-items-start">
                                        <h4>You Saved</h4>
                                        <h4 class="price text-end ">
                                           - $<span class="final-saved-amount">{{ $totalSaved }}</span>
                                        </h4>
                                    </li>
                                </ul>
                            </div>
                            <ul class="summery-total">
                                <li class="list-total border-top-0">
                                    <h4>Total (USD)</h4>
                                    <h4 class="price theme-color">$<strong
                                            class="grand-total-price">{{ $total }}</strong>
                                    </h4>
                                </li>
                            </ul>
                            <div class="button-group cart-button">
                                <ul>
                                    <li>
                                        <button onclick="location.href = '{{ route('checkout.details') }}';"
                                            class="btn btn-animation proceed-btn fw-bold">Process To Checkout</button>
                                    </li>
                                    <li>
                                        <button onclick="location.href = '{{ route('home') }}';"
                                            class="btn btn-light shopping-button text-dark">
                                            <i class="fa-solid fa-arrow-left-long"></i>Return To Shopping</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @else
        <div class="image" style="display: flex;justify-content: center;">
            <img style="width:60% !important;height:484px !important;object-fit: contain;"
                src="{{ asset('public/empty-cart.png') }}" />
        </div>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @foreach ($cart_data as $data)
        {{-- custom increment and decrement  --}}
        <script>
            $(document).ready(function() {
                var minValue = 1;
                var maxValue = 5;
                $(".quantity{{ $data->id }} .qty-input{{ $data->id }}").on('input', function() {
                    var inputField = $(this);
                    var value = parseInt(inputField.val());

                    if (isNaN(value) || value < minValue) {
                        inputField.val(minValue);
                    } else if (value > maxValue) {
                        inputField.val(maxValue);
                    }
                });
                $(".quantity{{ $data->id }} .qty-left-minus-custom{{ $data->id }}").on('click', function() {

                    var parentDataSet = $(this).closest(".quantity{{ $data->id }}");
                    var inputField = parentDataSet.find(".qty-input{{ $data->id }}");
                    var currentValue = parseInt(inputField.val());
                    if (currentValue > minValue) {
                        inputField.val(currentValue - 1);
                        // for subtotal
                        sellPrice = $('.product-price{{ $data->id }}').data('sellprice');
                        getSubTotal = parseInt($('.all-product-sub-total').text());
                        subTotal = getSubTotal - sellPrice;
                        $('.all-product-sub-total').text(subTotal);
                        // total saved amount
                        singleSavedAmount = $('.single-saved-amount{{ $data->id }}').data(
                            'singlesaveprice');
                        singleSavedAmount = singleSavedAmount || 0;
                        totalSavedAmount = parseInt($('.final-saved-amount').text());
                        totalSavedAmount = totalSavedAmount || 0;
                        saved = totalSavedAmount - singleSavedAmount;
                        $('.final-saved-amount').text(saved);
                        //Grand-Total
                        singleProductAmount = $('.product-price{{ $data->id }}').data('finalsellprice');
                        totalProductAmount = parseInt($('.grand-total-price').text());
                        saved = totalProductAmount - singleProductAmount;
                        $('.grand-total-price').text(saved);
                    }
                });
                $(".quantity{{ $data->id }} .qty-right-plus-custom{{ $data->id }}").on('click', function() {
                    var parentDataSet = $(this).closest(".quantity{{ $data->id }}");
                    var inputField = parentDataSet.find(".qty-input{{ $data->id }}");
                    var currentValue = parseInt(inputField.val());

                    if (currentValue < maxValue) {
                        inputField.val(currentValue + 1);
                        // for subtotal
                        sellPrice = $('.product-price{{ $data->id }}').data('sellprice');
                        getSubTotal = parseInt($('.all-product-sub-total').text());
                        subTotal = getSubTotal + parseInt(sellPrice);
                        $('.all-product-sub-total').text(subTotal);
                        // total saved amount
                        singleSavedAmount = $('.single-saved-amount{{ $data->id }}').data(
                            'singlesaveprice');
                        singleSavedAmount = singleSavedAmount || 0;
                        totalSavedAmount = parseInt($('.final-saved-amount').text());
                        totalSavedAmount = totalSavedAmount || 0;
                        saved = totalSavedAmount + parseInt(singleSavedAmount);
                        $('.final-saved-amount').text(saved);
                        //Grand-Total
                        singleProductAmount = $('.product-price{{ $data->id }}').data('finalsellprice');
                        totalProductAmount = parseInt($('.grand-total-price').text());
                        saved = totalProductAmount + parseInt(singleProductAmount);
                        $('.grand-total-price').text(saved);
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.qty-left-minus-custom{{ $data->id }},.qty-right-plus-custom{{ $data->id }}').on('click',
                    function() {
                        finalPrice = $('.product-price{{ $data->id }}').data('finalsellprice');
                        qty = $('.qty-input{{ $data->id }}').val();
                        singleTotal = finalPrice * qty;
                        $('.single-total-price{{ $data->id }}').text('$' + singleTotal);
                        // ajax for updating quantity
                        var cartID = $(this).data('cartid');
                        $.ajax({
                            url: "{{ route('update.cart') }}",
                            type: "POST",
                            data: {
                                id: cartID,
                                quantity: qty,
                                _token: '{{ csrf_token() }}'
                            },
                            dataType: 'json',
                            success: function(result) {}
                        });
                    });
            });
        </script>

        <script>
            // Delete Cart Product
            $(document).ready(function() {
                $('#removeItem{{ $data->id }}').on('click', function() {
                    var cartID = $(this).data('id');
                    $.ajax({
                        url: "{{ route('delete.cart') }}",
                        type: "POST",
                        data: {
                            id: cartID,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            if (result) {
                                $('#cart-total').text(result.cart_total);

                                $.notify({
                                    icon: "fa fa-check",
                                    title: "Success!",
                                    message: "Item Successfully removed from Cart",
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
        </script>
    @endforeach

@endsection
