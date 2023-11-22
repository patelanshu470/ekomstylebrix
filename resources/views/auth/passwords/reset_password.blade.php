@extends('frontend.layouts.home_master')
@section('frontendContent')
<style>
    .error{
        color:red !important;
    }
</style>
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2 class="mb-2">Reset Password</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Reset Password</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="log-in-section section-b-space forgot-section">
        <div class="container-fluid-lg w-100">
            <div class="row">
                <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                    <div class="image-contain">
                        <img src="{{ asset('public/frontend/assets/images/inner-page/forgot.png') }}" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <div class="log-in-box">
                            <div class="log-in-title">
                                <h3>Welcome To Fastkart</h3>
                                <h4>Forgot your password</h4>
                            </div>

                            <div class="input-box">
                                <form class="row g-4" method="POST" action="{{ route('reset.password.post') }}" id="ResetPassword">
                                    @csrf
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Address" value="{{ $email ?? old('email') }}" name="email" required autocomplete="email" autofocus readonly>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label for="email">Email Address</label>
                                        </div>
                                        <label id="email-error" class="error" for="email" style="display: none"></label>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="password" name="password" required autocomplete="current-password">
                                            <label for="password">Password</label>
                                        </div>
                                        <label id="password-error" class="error" for="password" style="display: none"></label>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Confirm Password*" name="confirm_password" required autocomplete="current-password">
                                            <label for="password">Confirm Password</label>
                                        </div>
                                        <label id="confirm_password-error" class="error" for="confirm_password" style="display: none"></label>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-animation w-100" type="submit">Reset Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script>
        jQuery.validator.addMethod("email", function(value, element) {
            if (/^([a-zA-Z0-9_\.\-])+\@(gmail\.com)$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter a valid Email.");
        jQuery.validator.addMethod("password", function(value, element) {
            if (/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()+=-\?;,./{}|\":<>\[\]\\\' ~_]).{8,}/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Use at least 8 characters. Use a mix of letters (uppercase and lowercase), numbers, and symbols.");
        $('#ResetPassword').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                confirm_password: {
                    equalTo: '#password'
                },
                password:{
                    required: true,
                    password: true,
                }
            },
            messages: {
                email: {
                    required: "This email field is required",
                },
                password: {
                    required: "This password field is required",
                },
                confirm_password: {
                    required: "This confirm password field is required",
                    equalTo: "Your password and confirm password do not match"
                },
            }
        });
    </script>
@endsection
