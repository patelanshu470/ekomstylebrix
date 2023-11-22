@extends('frontend.layouts.home_master')
@section('frontendContent')
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-9 col-lg-8">
                    <div class="cart-table order-table order-table-2">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    @foreach ($cart_data as $data)
                                        <tr>
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
                                                            <li class="text-content">Size: {{ $data->size }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="price">
                                                <h4 class="table-title text-content">Price</h4>
                                                <h6 class="theme-color">${{ $data->product->final_sell_price }}</h6>
                                            </td>
                                            <td class="quantity">
                                                <h4 class="table-title text-content">Qty</h4>
                                                <h4 class="text-title">{{ $data->quantity }}</h4>
                                            </td>
                                            <td class="subtotal">
                                                <h4 class="table-title text-content">Total</h4>
                                                <h5>${{ $data->product->final_sell_price * $data->quantity }}</h5>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4">
                    <div class="row g-4">
                        <div class="col-lg-12 col-sm-6">
                            <div class="summery-box">
                                <div class="summery-header">
                                    <h3>Price Details</h3>
                                    <h5 class="ms-auto theme-color">({{ count($cart_data) }} Items)</h5>
                                </div>
                                <ul class="summery-contain">
                                    <li>
                                        <h4>Sub-Total</h4>
                                        <h4 class="price">${{ $subTotal }}</h4>
                                    </li>
                                    <li>
                                        <h4>Total-Saving</h4>
                                        <h4 class="price theme-color">- ${{ $totalSaved }}</h4>
                                    </li>
                                    <li>
                                        <h4>Coupon-Discount</h4>
                                        <h4 class="price text-danger">${{ $couponAmount }}</h4>
                                    </li>
                                </ul>
                                <ul class="summery-total">
                                    <li class="list-total">
                                        <h4>Total (USD)</h4>
                                        <h4 class="price">${{ $total }}</h4>
                                    </li>
                                </ul>
                            </div>
                            <button style="width: 100%;background-color:#ff7272 !important;"
                                onclick="window.open('{{ route('payment', $order_id) }}', '_blank');"
                                class="btn theme-bg-color btn-md text-white fw-bold mt-md-4 mt-2 mend-auto" tabindex="0">
                                Pay-Now
                                <i class="fa-solid fa-money-bill-wave icon" style="color: #ffffff;"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
