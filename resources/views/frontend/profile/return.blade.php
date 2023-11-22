@extends('frontend.layouts.home_master')
@section('frontendContent')
    <style>
        #return_reason-error,
        #video-input-error,
        #custom_reason-error {
            color: red !important;
        }
    </style>
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Return Page</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="#">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Order Tracking</li>
                                <li class="breadcrumb-item active" aria-current="page">Return Page</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (!$dublicate_return)
        <section class="order-detail">
            <div class="container-fluid-lg">
                <div class="row g-sm-4 g-3">
                    <div class="col-xxl-3 col-xl-4 col-lg-6">
                        <div class="order-image">
                            <img src="{{ $data->product->thumbnail }}"
                                class="img-fluid blur-up lazyload" alt="">
                        </div>
                    </div>
                    <div class="col-xxl-9 col-xl-8 col-lg-6">
                        <div class="row g-sm-4 g-3">
                            <form action="{{ route('return.product.details', $data->id) }}" method="post" id="returnForm" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <div class="accordion-body">
                                        <div class="row g-2">
                                            <div class="col-12">
                                                <div class="payment-method">
                                                    <label>Detailed Video</label>
                                                    <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                        <input id="video-input" class="form-control" name="attachement"
                                                            type="file" accept="video/*" />
                                                    </div>
                                                    <p id="video-error" style="color: red;"></p>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="payment-method">
                                                    <div class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                        <select class="form-select" id="return_reason" name="reason"
                                                            aria-label="">
                                                            <option value="" selected="" disabled="">
                                                                Select Cancel Reason</option>
                                                            <option>Ordered by mistake</option>
                                                            <option>Ordered wrong product</option>
                                                            <option>Delivery date too long</option>
                                                            <option>Shipping or handling costs too high</option>
                                                            <option>Concerns about product quality or safety
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkout-detail">
                                                <div class="accordion accordion-flush custom-accordion"
                                                    id="accordionFlushExample">
                                                    <div class="accordion-item">
                                                        <div class="accordion-header" id="flush-headingOne"
                                                            style="argin-left: -23px; margin-bottom: 19px;">
                                                            <div class="accordion-button collapsed" style="padding:0px;">
                                                                <div class="custom-form-check form-check mb-0 common-checkbox"
                                                                    style="padding: 0px !important;">
                                                                    <div class="form-floating  theme-form-floating">
                                                                        <div
                                                                            class="form-check form-switch switch-radio ms-auto">
                                                                            <input class="form-check-input"
                                                                                id="return_collaspe_btn"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#flush-collapseOne"
                                                                                name="is_custom_reason" value="1"
                                                                                type="checkbox" role="switch"
                                                                                style="width:37px;height:20px;margin-lef:0px !important;"
                                                                                id="redio3" aria-checked="false">
                                                                            <label class="form-check-label"
                                                                                style="margin-top:2px;margin-left:10px;"
                                                                                for="redio3">Custom
                                                                                Reason?</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                            data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body" style="padding:0px !important;">
                                                                <div class="row ">
                                                                    <div class="col-12">
                                                                        <div class="payment-method">
                                                                            <div
                                                                                class="form-floating mb-lg-3 mb-2 theme-form-floating">
                                                                                <textarea class="form-control" id="custom_reason" name="custom_reason" placeholder=""></textarea>
                                                                                </label>
                                                                            </div>
                                                                            <input type="hidden" name="size" value="{{ $data->size }}">
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
        </section>
    @else
        <section class="order-detail">
            <div class="container-fluid-lg">
                <div class="row g-sm-12 g-3" style="display: flex;justify-content: center;">
                    <div class="col-xxl-3 col-xl-3 col-lg-3">
                        <div class="order-image">
                            <video controls width="100%">
                                <source src="{{ $dublicate_return->attachement }}"
                                    type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="order-image">
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <span style="font-size: large;"> <strong>Return-Reason</strong></span> <br>
                                    {{ $dublicate_return->return_reason }}
                                </div>
                                <div class="col-md-4 mt-3">
                                    <span style="font-size: large;"> <strong>Order-No</strong></span> <br>
                                    {{ $dublicate_return->order->unique_no }}
                                </div>
                                <div class="col-md-4 mt-3">
                                    <span style="font-size: large;"> <strong>Product</strong></span> <br>
                                    {{ $dublicate_return->product->name }}
                                </div>
                                <div class="col-md-4 mt-3">
                                    <span style="font-size: large;"> <strong>Request-Status</strong></span> <br>
                                    {{ $dublicate_return->status }}
                                </div>
                                @if ($dublicate_return->reject_reason)
                                    <div class="col-md-4 mt-3">
                                        <span style="font-size: large;"> <strong>Reject-Reason</strong></span> <br>
                                        {{ $dublicate_return->reject_reason }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Order Detail Section End -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ asset('public/frontend/custom/return/return.js') }}"></script>

@endsection
