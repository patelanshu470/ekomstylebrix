@extends('backend.layouts.admin_master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/cust_backend/banner/banner.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <section class="user-dashboard-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-3 col-lg-4">
                    <div class="dashboard-left-sidebar">
                        <button type="submit" style="width:100%" data-bs-target="#exampleModalToggle2"
                            data-bs-toggle="modal" class="btn btn-solid" data-bs-original-title=""
                            title="">Reference</button>
                        <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist" style="display: grid;">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-dashboard-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-dashboard" type="button" role="tab" href="#banner1"
                                    aria-controls="pills-dashboard" aria-selected="true">
                                    Banner-1
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-order-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-order" type="button" role="tab" aria-controls="pills-order"
                                    href="#banner2" aria-selected="false">Banner-2</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-wishlist-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-wishlist" type="button" role="tab" href="#banner3"
                                    aria-controls="pills-wishlist" aria-selected="false">
                                    Banner-3</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-card-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-card" type="button" role="tab" aria-controls="pills-card"
                                    href="#banner4" aria-selected="false">Banner-4</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-address-tab" data-bs-toggle="pill" href="#productBanner"
                                    data-bs-target="#pills-address" type="button" role="tab"
                                    aria-controls="pills-address" aria-selected="false">
                                    Product Banner</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-address-tab" data-bs-toggle="pill" href="#shopBanner"
                                    data-bs-target="#shopBanner" type="button" role="tab" aria-controls="pills-address"
                                    aria-selected="false">
                                    Shop Banner</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xxl-9 col-lg-8">
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            {{-- : Shop-Banner1 --}}
                            <div class="tab-pane fade show" id="shopBanner" role="tabpanel"
                                aria-labelledby="pills-wishlist-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-sm-8 m-auto">
                                                    {{-- Shop-Banner1  --}}
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="card-header-2">
                                                                <h5>Shop-Banner1</h5>
                                                            </div>
                                                            @if ($shopBanner1)
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="bannerShop1formAddEdit"
                                                                    action="{{ route('banner.update', $shopBanner1->id) }}">
                                                                    @csrf
                                                                    <div class="mb-4 row" style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUploadShop1Edit"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label
                                                                                        for="imageUploadShop1Edit"></label>
                                                                                </div>
                                                                                <label class="form-label-title mb-0">Shop
                                                                                    Banner-1</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="bannerShop1Edit"
                                                                                        style="background-image: url('{{ $shopBanner1->banner }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(6400x4600
                                                                                    px)</label>
                                                                                <span class="bannerShop1-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                value="{{ $shopBanner1->link }}"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="shopbanner1">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                value="{{ $shopBanner1->special_text }}"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="header_text"
                                                                                value="{{ $shopBanner1->header_text }}"
                                                                                type="text" placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="short_desc"
                                                                                value="{{ $shopBanner1->short_desc }}"
                                                                                type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="bannerShop1formAdd"
                                                                    action="{{ route('banner.store') }}">
                                                                    @csrf
                                                                    <div class="mb-4 row "
                                                                        style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUploadShop1"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label for="imageUploadShop1"></label>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">ShopBanner-1</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="bannerShop1"
                                                                                        style="background-image: url('{{ asset('public/no-image.png') }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(6400x4600
                                                                                    px)</label>
                                                                                <span class="bannerShop1-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="shopBanner1">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="header_text"
                                                                                type="text" placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="short_desc"
                                                                                type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{-- Shop-banner-2  --}}
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="card-header-2">
                                                                <h5>Shop-Banner2</h5>
                                                            </div>
                                                            @if ($shopBanner2)
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="bannerShop2formEdit"
                                                                    action="{{ route('banner.update', $shopBanner2->id) }}">
                                                                    @csrf
                                                                    <div class="mb-4 row" style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUploadShop2Edit"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label
                                                                                        for="imageUploadShop2Edit"></label>
                                                                                </div>
                                                                                <label class="form-label-title mb-0">Shop
                                                                                    Banner-2</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="bannerShop2Edit"
                                                                                        style="background-image: url('{{ $shopBanner2->banner }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(6400x4600
                                                                                    px)</label>
                                                                                <span class="bannerShop2-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                value="{{ $shopBanner2->link }}"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="shopbanner2">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                value="{{ $shopBanner2->special_text }}"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="header_text"
                                                                                value="{{ $shopBanner2->header_text }}"
                                                                                type="text" placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="short_desc"
                                                                                value="{{ $shopBanner2->short_desc }}"
                                                                                type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="bannerShop2formAdd"
                                                                    action="{{ route('banner.store') }}">
                                                                    @csrf
                                                                    <div class="mb-4 row "
                                                                        style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUploadShop2"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label for="imageUploadShop2"></label>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">ShopBanner-1</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="bannerShop2"
                                                                                        style="background-image: url('{{ asset('public/no-image.png') }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(6400x4600
                                                                                    px)</label>
                                                                                <span class="bannerShop2-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="shopBanner2">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="header_text"
                                                                                type="text" placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="short_desc"
                                                                                type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    {{-- Shop-banner-3  --}}
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="card-header-2">
                                                                <h5>Shop Banner-3</h5>
                                                            </div>
                                                            @if ($shopBanner3)
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="bannerShop3formEdit"
                                                                    action="{{ route('banner.update', $shopBanner3->id) }}">
                                                                    @csrf
                                                                    <div class="mb-4 row" style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUploadShop3Edit"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label
                                                                                        for="imageUploadShop3Edit"></label>
                                                                                </div>
                                                                                <label class="form-label-title mb-0">Shop
                                                                                    Banner-3</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="bannerShop3Edit"
                                                                                        style="background-image: url('{{ $shopBanner3->banner }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(6400x4600
                                                                                    px)</label>
                                                                                <span class="bannerShop3-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                value="{{ $shopBanner3->link }}"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="shopbanner3">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                value="{{ $shopBanner3->special_text }}"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="header_text"
                                                                                value="{{ $shopBanner3->header_text }}"
                                                                                type="text" placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="short_desc"
                                                                                value="{{ $shopBanner3->short_desc }}"
                                                                                type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="bannerShop3formAdd"
                                                                    action="{{ route('banner.store') }}">
                                                                    @csrf
                                                                    <div class="mb-4 row "
                                                                        style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUploadShop3"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label for="imageUploadShop3"></label>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">ShopBanner-3</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="bannerShop3"
                                                                                        style="background-image: url('{{ asset('public/no-image.png') }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(6400x4600
                                                                                    px)</label>
                                                                                <span class="bannerShop3-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="shopBanner3">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="header_text"
                                                                                type="text" placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="short_desc"
                                                                                type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- banner-1  --}}
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel"
                                aria-labelledby="pills-dashboard-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-sm-8 m-auto">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="card-header-2">
                                                                <h5>Banner-1</h5>
                                                            </div>
                                                            @if ($bannerOne)
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="banner1formEdit"
                                                                    action="{{ route('banner.update', $bannerOne->id) }}">
                                                                    @csrf
                                                                    <div class="mb-4 row" style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUpload1Edit"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label for="imageUpload1Edit"></label>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Banner-1</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="banner1Edit"
                                                                                        style="background-image: url('{{ $bannerOne->banner }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(1860x550
                                                                                    px)</label>
                                                                                <span class="thumbnail-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                value="{{ $bannerOne->link }}"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="banner1">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                value="{{ $bannerOne->special_text }}"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="header_text"
                                                                                value="{{ $bannerOne->header_text }}"
                                                                                type="text" placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="short_desc"
                                                                                value="{{ $bannerOne->short_desc }}"
                                                                                type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="banner1formAdd"
                                                                    action="{{ route('banner.store') }}">
                                                                    @csrf
                                                                    <div class="mb-4 row "
                                                                        style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUpload1"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label for="imageUpload1"></label>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Banner-1</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="banner1"
                                                                                        style="background-image: url('{{ asset('public/no-image.png') }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(1860x550
                                                                                    px)</label>

                                                                                <span class="thumbnail-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="banner1">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="header_text"
                                                                                type="text" placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="short_desc"
                                                                                type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- : banner-3 --}}
                            <div class="tab-pane fade show" id="pills-wishlist" role="tabpanel"
                                aria-labelledby="pills-wishlist-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-sm-8 m-auto">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="card-header-2">
                                                                <h5>Banner-3</h5>
                                                            </div>
                                                            @if ($bannerThree)
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="banner2formAdd"
                                                                    action="{{ route('banner.update', $bannerThree->id) }}">
                                                                    @csrf
                                                                    <div class="mb-4 row" style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUpload3Edit"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label for="imageUpload3Edit"></label>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Banner-3</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="banner3Edit"
                                                                                        style="background-image: url('{{ $bannerThree->banner }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(500x245
                                                                                    px)</label>

                                                                                <span class="banner3-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                value="{{ $bannerThree->link }}"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="banner3">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                value="{{ $bannerThree->special_text }}"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="header_text"
                                                                                value="{{ $bannerThree->header_text }}"
                                                                                type="text" placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="short_desc"
                                                                                value="{{ $bannerThree->short_desc }}"
                                                                                type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="banner3formAdd"
                                                                    action="{{ route('banner.store') }}">
                                                                    @csrf
                                                                    <div class="mb-4 row "
                                                                        style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUpload3"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label for="imageUpload3"></label>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Banner-3</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="banner3"
                                                                                        style="background-image: url('{{ asset('public/no-image.png') }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(500x245
                                                                                    px)</label>
                                                                                <span class="banner3-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="banner3">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="header_text"
                                                                                type="text" placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="short_desc"
                                                                                type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- banner-2:  --}}
                            <div class="tab-pane fade show" id="pills-order" role="tabpanel"
                                aria-labelledby="pills-order-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-sm-8 m-auto">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="card-header-2">
                                                                <h5>Banner-2</h5>
                                                            </div>
                                                            @if ($bannerTwo)
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="banner2formEdit"
                                                                    action="{{ route('banner.update', $bannerTwo->id) }}">
                                                                    @csrf
                                                                    <div class="mb-4 row" style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUpload2Edit"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label for="imageUpload2Edit"></label>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Banner-2</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="banner2Edit"
                                                                                        style="background-image: url('{{ $bannerTwo->banner }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(1030x245
                                                                                    px)</label>
                                                                                <span class="banner2-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                value="{{ $bannerTwo->link }}"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="banner2">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                value="{{ $bannerTwo->special_text }}"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="header_text"
                                                                                value="{{ $bannerTwo->header_text }}"
                                                                                type="text" placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="short_desc"
                                                                                value="{{ $bannerTwo->short_desc }}"
                                                                                type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="banner2formAdd"
                                                                    action="{{ route('banner.store') }}">
                                                                    @csrf
                                                                    <div class="mb-4 row "
                                                                        style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUpload2"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label for="imageUpload2"></label>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Banner-2</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="banner2"
                                                                                        style="background-image: url('{{ asset('public/no-image.png') }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(1030x245
                                                                                    px)</label>
                                                                                <span class="banner2-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="banner2">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="header_text"
                                                                                type="text" placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="short_desc"
                                                                                type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  product banner --}}
                            <div class="tab-pane fade show" id="pills-address" role="tabpanel"
                                aria-labelledby="pills-address-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-sm-8 m-auto">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="card-header-2">
                                                                <h5>Produc Banner</h5>
                                                            </div>
                                                            @if ($productBanner)
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="productBannerformEdit"
                                                                    action="{{ route('banner.update', $productBanner->id) }}">
                                                                    @csrf
                                                                    <div class="mb-4 row" style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUploadProductEdit"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label
                                                                                        for="imageUploadProductEdit"></label>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Product-Banner</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="bannerProductEdit"
                                                                                        style="background-image: url('{{ $productBanner->banner }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(370x580
                                                                                    px)</label>

                                                                                <span class="bannerProduct-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                value="{{ $productBanner->link }}"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="productBanner">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                value="{{ $productBanner->special_text }}"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="header_text"
                                                                                value="{{ $productBanner->header_text }}"
                                                                                type="text" placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="short_desc"
                                                                                value="{{ $productBanner->short_desc }}"
                                                                                type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="productBannerformAdd"
                                                                    action="{{ route('banner.store') }}">
                                                                    @csrf
                                                                    <div class="mb-4 row "
                                                                        style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUploadProduct"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label
                                                                                        for="imageUploadProduct"></label>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Product-Banner</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="bannerProduct"
                                                                                        style="background-image: url('{{ asset('public/no-image.png') }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(370x580
                                                                                    px)</label>
                                                                                <span class="bannerProduct-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="productBanner">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="header_text"
                                                                                type="text" placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="short_desc"
                                                                                type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- banner-4 : --}}
                            <div class="tab-pane fade show" id="pills-card" role="tabpanel"
                                aria-labelledby="pills-card-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-sm-8 m-auto">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="card-header-2">
                                                                <h5>Banner-4</h5>
                                                            </div>
                                                            @if ($bannerFour)
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="banner4formAdd"
                                                                    action="{{ route('banner.update', $bannerFour->id) }}">
                                                                    @csrf
                                                                    <div class="mb-4 row"
                                                                        style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUpload4Edit"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label for="imageUpload4Edit"></label>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Banner-4</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="banner4Edit"
                                                                                        style="background-image: url('{{ $bannerFour->banner }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(370x580
                                                                                    px)</label>

                                                                                <span class="banner2-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                value="{{ $bannerFour->link }}"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="banner4">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                value="{{ $bannerFour->special_text }}"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                name="header_text"
                                                                                value="{{ $bannerFour->header_text }}"
                                                                                type="text"
                                                                                placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                name="short_desc"
                                                                                value="{{ $bannerFour->short_desc }}"
                                                                                type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    class="theme-form theme-form-2 mega-form"
                                                                    id="banner4formAdd"
                                                                    action="{{ route('banner.store') }}">
                                                                    @csrf
                                                                    <div class="mb-4 row "
                                                                        style="justify-content: center">
                                                                        <div class="form-group col-sm-6 col-6">
                                                                            <div class="avatar-upload">
                                                                                <div class="avatar-edit">
                                                                                    <input type='file'
                                                                                        id="imageUpload4"
                                                                                        name="banner_image"
                                                                                        accept=".png, .jpg, .jpeg" />
                                                                                    <label for="imageUpload4"></label>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Banner-4</label>
                                                                                <div class="avatar-preview">
                                                                                    <div id="banner4"
                                                                                        style="background-image: url('{{ asset('public/no-image.png') }}');">
                                                                                    </div>
                                                                                </div>
                                                                                <label
                                                                                    class="form-label-title mb-0">Recommended-Size:(370x580
                                                                                    px)</label>
                                                                                <span class="banner4-error"
                                                                                    style="color:red"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Redirect-Link</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" name="link"
                                                                                type="text"
                                                                                placeholder="redirect link">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-control" name="type" readonly
                                                                        type="hidden" value="banner4">
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Special-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                name="special_text" type="text"
                                                                                placeholder="special-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Header-Text</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                name="header_text" type="text"
                                                                                placeholder="header-text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <label
                                                                            class="form-label-title col-sm-3 mb-0">Short-Description</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control"
                                                                                name="short_desc" type="text"
                                                                                placeholder="short description">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row align-items-center">
                                                                        <button type="submit"
                                                                            class="btn btn-solid">Submit</button>
                                                                    </div>
                                                                </form>
                                                            @endif
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
            </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" style="background:whitesmoke">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Banner-Reference</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 border" style="background: #FFFFFF">
                            <h2 style="text-align: center;">Page-1</h2>

                            <img style="width:100%;" src="{{ asset('public/home_banner.jpg') }}" />
                        </div>
                        <div class="col-6 border" style="background: #FFFFFF">
                            <h2 style="text-align: center;">Page-2</h2>

                            <img style="width:100%;" src="{{ asset('public/product_banner.jpg') }}" />
                        </div>
                        <div class="col-6 border" style="background: #FFFFFF;margin-top:7px">
                            <h2 style="text-align: center;">Page-3</h2>
                            <img style="width:100%;" src="{{ asset('public/shop_banner_reference.jpg') }}" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{asset('public/cust_backend/banner/banner.js')}}"></script>

    {{-- // image validation  banner-2 --}}
    <script>
        $.validator.addMethod(
            "url",
            function(value, element) {
                var urlPattern =
                    /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i;
                return this.optional(element) || urlPattern.test(value);
            },
            "Please enter a valid URL."
        );
        $('#banner2formAdd').validate({
            rules: {
                link: {
                    required: true,
                    url: true,
                },
                short_desc: {
                    required: true,
                },
                special_text: {
                    required: true,
                },
                header_text: {
                    required: true,
                },
                type: {
                    required: true,
                },
            },
        });
        $('#banner2formEdit').validate({
            rules: {
                link: {
                    required: true,
                    url: true,
                },
                short_desc: {
                    required: true,
                },
                special_text: {
                    required: true,
                },
                header_text: {
                    required: true,
                },
                type: {
                    required: true,
                },
            },
        });
        document.getElementById("banner2formAdd").addEventListener("submit", function(event) {
            var fileInput = document.getElementById("imageUpload2");
            var file = fileInput.files[0];
            if (!file) {
                $('.banner2-error').text("This field is required");
                event.preventDefault();
                fileInput.setCustomValidity("Please select an image.");
            } else {
                $('.banner2-error').text(" ");
                fileInput.setCustomValidity("");
            }
        });
    </script>
    {{-- // image validation  banner-4 --}}
    <script>
        $.validator.addMethod(
            "url",
            function(value, element) {
                var urlPattern =
                    /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i;
                return this.optional(element) || urlPattern.test(value);
            },
            "Please enter a valid URL."
        );
        $('#banner4formAdd').validate({
            rules: {
                link: {
                    required: true,
                    url: true,
                },
                short_desc: {
                    required: true,
                },
                special_text: {
                    required: true,
                },
                header_text: {
                    required: true,
                },
                type: {
                    required: true,
                },
            },

        });
        $('#banner4formEdit').validate({
            rules: {
                link: {
                    required: true,
                    url: true,
                },
                short_desc: {
                    required: true,
                },
                special_text: {
                    required: true,
                },
                header_text: {
                    required: true,
                },
                type: {
                    required: true,
                },
            },
        });
        document.getElementById("banner4formAdd").addEventListener("submit", function(event) {
            var fileInput = document.getElementById("imageUpload4");
            var file = fileInput.files[0];
            if (!file) {
                $('.banner4-error').text("This field is required");
                event.preventDefault();
                fileInput.setCustomValidity("Please select an image.");
            } else {
                $('.banner4-error').text(" ");
                fileInput.setCustomValidity("");
            }
        });
    </script>
    {{-- // image validation  product Banner --}}
    <script>
        $.validator.addMethod(
            "url",
            function(value, element) {
                var urlPattern =
                    /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i;
                return this.optional(element) || urlPattern.test(value);
            },
            "Please enter a valid URL."
        );
        $('#productBannerformAdd').validate({
            rules: {
                link: {
                    required: true,
                    url: true,
                },
                short_desc: {
                    required: true,
                },
                special_text: {
                    required: true,
                },
                header_text: {
                    required: true,
                },
                type: {
                    required: true,
                },
            },
        });
        $('#productBannerformEdit').validate({
            rules: {
                link: {
                    required: true,
                    url: true,
                },
                short_desc: {
                    required: true,
                },
                special_text: {
                    required: true,
                },
                header_text: {
                    required: true,
                },
                type: {
                    required: true,
                },
            },
        });
        document.getElementById("productBannerformAdd").addEventListener("submit", function(event) {
            var fileInput = document.getElementById("imageUploadProduct");
            var file = fileInput.files[0];
            if (!file) {
                $('.bannerProduct-error').text("This field is required");
                event.preventDefault();
                fileInput.setCustomValidity("Please select an image.");
            } else {
                $('.bannerProduct-error').text(" ");
                fileInput.setCustomValidity("");
            }
        });
    </script>
    {{-- // image validation  ShopBanner-1 --}}
    <script>
        $.validator.addMethod(
            "url",
            function(value, element) {
                var urlPattern =
                    /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i;
                return this.optional(element) || urlPattern.test(value);
            },
            "Please enter a valid URL."
        );
        $('#bannerShop1formAdd').validate({
            rules: {
                link: {
                    required: true,
                    url: true,
                },
                short_desc: {
                    required: true,
                },
                special_text: {
                    required: true,
                },
                header_text: {
                    required: true,
                },
                type: {
                    required: true,
                },
            },
        });
        $('#bannerShop1formAddEdit').validate({
            rules: {
                link: {
                    required: true,
                    url: true,
                },
                short_desc: {
                    required: true,
                },
                special_text: {
                    required: true,
                },
                header_text: {
                    required: true,
                },
                type: {
                    required: true,
                },
            },
        });
        document.getElementById("bannerShop1formAdd").addEventListener("submit", function(event) {
            var fileInput = document.getElementById("imageUploadShop1");
            var file = fileInput.files[0];
            if (!file) {
                $('.bannerShop1-error').text("This field is required");
                event.preventDefault();
                fileInput.setCustomValidity("Please select an image.");
            } else {
                $('.bannerShop1-error').text(" ");
                fileInput.setCustomValidity("");
            }
        });
    </script>
    {{-- // image validation  ShopBanner-2 --}}
    <script>
        $.validator.addMethod(
            "url",
            function(value, element) {
                var urlPattern =
                    /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i;
                return this.optional(element) || urlPattern.test(value);
            },
            "Please enter a valid URL."
        );
        $('#bannerShop2formAdd').validate({
            rules: {
                link: {
                    required: true,
                    url: true,
                },
                short_desc: {
                    required: true,
                },
                special_text: {
                    required: true,
                },
                header_text: {
                    required: true,
                },
                type: {
                    required: true,
                },
            },

        });
        $('#bannerShop2formEdit').validate({
            rules: {
                link: {
                    required: true,
                    url: true,
                },
                short_desc: {
                    required: true,
                },
                special_text: {
                    required: true,
                },
                header_text: {
                    required: true,
                },
                type: {
                    required: true,
                },
            },
        });
        document.getElementById("bannerShop2formAdd").addEventListener("submit", function(event) {
            var fileInput = document.getElementById("imageUploadShop2");
            var file = fileInput.files[0];
            if (!file) {
                $('.bannerShop2-error').text("This field is required");
                event.preventDefault();
                fileInput.setCustomValidity("Please select an image.");
            } else {
                $('.bannerSho2-error').text(" ");
                fileInput.setCustomValidity("");
            }
        });
    </script>
    {{-- // image validation  ShopBanner-3 --}}
    <script>
        $.validator.addMethod(
            "url",
            function(value, element) {
                var urlPattern =
                    /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i;
                return this.optional(element) || urlPattern.test(value);
            },
            "Please enter a valid URL."
        );
        $('#bannerShop3formAdd').validate({
            rules: {
                link: {
                    required: true,
                    url: true,
                },
                short_desc: {
                    required: true,
                },
                special_text: {
                    required: true,
                },
                header_text: {
                    required: true,
                },
                type: {
                    required: true,
                },
            },

        });
        $('#bannerShop3formEdit').validate({
            rules: {
                link: {
                    required: true,
                    url: true,
                },
                short_desc: {
                    required: true,
                },
                special_text: {
                    required: true,
                },
                header_text: {
                    required: true,
                },
                type: {
                    required: true,
                },
            },

        });
        document.getElementById("bannerShop3formAdd").addEventListener("submit", function(event) {
            var fileInput = document.getElementById("imageUploadShop3");
            var file = fileInput.files[0];
            if (!file) {
                $('.bannerShop3-error').text("This field is required");
                event.preventDefault();
                fileInput.setCustomValidity("Please select an image.");
            } else {
                $('.bannerShop3-error').text(" ");
                fileInput.setCustomValidity("");
            }
        });
    </script>
    {{-- image preview  --}}
    <script>
        function readURL(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + previewId).css('background-image', 'url(' + e.target.result + ')');
                    $('#' + previewId).hide();
                    $('#' + previewId).fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        // banner-1
        $("#imageUpload1").change(function() {
            readURL(this, 'banner1');
        });
        $("#imageUpload1Edit").change(function() {
            readURL(this, 'banner1Edit');
        });
        // banner-2
        $("#imageUpload2").change(function() {
            readURL(this, 'banner2');
        });
        $("#imageUpload2Edit").change(function() {
            readURL(this, 'banner2Edit');
        });
        // banner-3
        $("#imageUpload3").change(function() {
            readURL(this, 'banner3');
        });
        $("#imageUpload3Edit").change(function() {
            readURL(this, 'banner3Edit');
        });
        // banner-4
        $("#imageUpload4").change(function() {
            readURL(this, 'banner4');
        });
        $("#imageUpload4Edit").change(function() {
            readURL(this, 'banner4Edit');
        });
        // banner-4
        $("#imageUploadProduct").change(function() {
            readURL(this, 'bannerProduct');
        });
        $("#imageUploadProductEdit").change(function() {
            readURL(this, 'bannerProductEdit');
        });

        // shop banner-1
        $("#imageUploadShop1").change(function() {
            readURL(this, 'bannerShop1');
        });
        $("#imageUploadShop1Edit").change(function() {
            readURL(this, 'bannerShop1Edit');
        });

        // shop banner-2
        $("#imageUploadShop2").change(function() {
            readURL(this, 'bannerShop2');
        });
        $("#imageUploadShop2Edit").change(function() {
            readURL(this, 'bannerShop2Edit');
        });

        // shop banner-2
        $("#imageUploadShop3").change(function() {
            readURL(this, 'bannerShop3');
        });
        $("#imageUploadShop3Edit").change(function() {
            readURL(this, 'bannerShop3Edit');
        });
    </script>
    {{-- select tab  --}}
    <script>
        function updateUrlHash(tabId) {
            window.location.hash = tabId;
        }
        function activateTabFromHash() {
            var hash = window.location.hash;
            if (hash) {
                $(`.nav-link[href="${hash}"]`).tab('show');
            }
        }
        $(document).ready(function() {
            activateTabFromHash();
        });
        $('.nav-link').on('click', function(event) {
            var tabId = $(this).attr('href');
            updateUrlHash(tabId);
        });
    </script>
@endsection
