@extends('frontend.layouts.home_master')
@section('frontendContent')
    <style>
        .error {
            color: red !important;
        }
    </style>
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Contact Us</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Contact Box Section Start -->
    <section class="contact-box-section">
        <div class="container-fluid-lg">
            <div class="row g-lg-5 g-3">
                <div class="col-lg-6">
                    <div class="left-sidebar-box">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="contact-image" >
                                    <img src="{{ asset('public/contact_us.png') }}" style="width: 100% !important;" class="img-fluid blur-up lazyloaded"
                                        alt="">
                                </div>
                            </div>
                            @php
                                $website = App\Models\WebsiteDetails::get()->first();
                            @endphp
                            @if ($website)
                                <div class="col-xl-12">
                                    <div class="contact-title">
                                        <h3>Get In Touch</h3>
                                    </div>
                                    <div class="contact-detail">
                                        <div class="row g-4">

                                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                                <div class="contact-detail-box">
                                                    <div class="contact-icon">
                                                        <i class="fa-solid fa-envelope"></i>
                                                    </div>
                                                    <div class="contact-detail-title">
                                                        <h4>Email</h4>
                                                    </div>

                                                    <div class="contact-detail-contain">
                                                        <p>{{$website->email}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                                <div class="contact-detail-box">
                                                    <div class="contact-icon">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                    </div>
                                                    <div class="contact-detail-title">
                                                        <h4>Location</h4>
                                                    </div>
                                                    <div class="contact-detail-contain">
                                                        <p>{{$website->location}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="title d-xxl-none d-block">
                        <h2>Contact Us</h2>
                    </div>
                    <div class="right-sidebar-box">

                        <form action="{{ route('contact.us.store') }}" method="POST" id="contactUsForm">
                            @csrf

                            <div class="row">
                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput" class="form-label">First Name</label>
                                        <div class="custom-input">
                                            <input type="text" class="form-control" id="exampleFormControlInput"
                                                name="first_name" placeholder="Enter First Name">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                                        <div class="custom-input">
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                name="last_name" placeholder="Enter Last Name">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput2" class="form-label">Email Address</label>
                                        <div class="custom-input">
                                            <input type="email" class="form-control" id="exampleFormControlInput2"
                                                name="email" placeholder="Enter Email Address">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput3" class="form-label">Phone Number</label>
                                        <div class="custom-input">
                                            <input type="tel" class="form-control" id="exampleFormControlInput3"
                                                name="mobile" placeholder="Enter Your Phone Number" maxlength="10"
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value =
                                            this.value.slice(0, this.maxLength);">
                                            <i class="fa-solid fa-mobile-screen-button"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlTextarea" class="form-label">Message</label>
                                        <div class="custom-textarea">
                                            <textarea class="form-control" id="exampleFormControlTextarea" name="message" placeholder="Enter Your Message"
                                                rows="6"></textarea>
                                            <i class="fa-solid fa-message"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-animation btn-md fw-bold ms-auto">Send Message</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Box Section End -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ asset('public/frontend/custom/contact_us/contact_us.js') }}"></script>
@endsection
