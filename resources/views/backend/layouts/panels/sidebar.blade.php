
<div class="sidebar-wrapper" style="background: #417394 !important;">
    <div id="sidebarEffect"></div>
    <div>
        <div class="logo-wrapper logo-wrapper-center">
            <a href="{{route('dashboard')}}" data-bs-original-title="" title="">
                <img class="img-fluid for-white" src="{{ asset(getenv('WEBSTIE_LOGO')) }}" alt="logo">
            </a>
            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="toggle-sidebar">
                <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{route('dashboard')}}">
                <img class="img-fluid main-logo main-white" src="{{ asset(getenv('FAVICON_ICON')) }}" alt="logo">
                <img class="img-fluid main-logo main-dark" src="{{ asset(getenv('FAVICON_ICON')) }}" alt="logo">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"></li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() === 'dashboard' ? 'custom-active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="ri-home-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title 
                        {{ Route::currentRouteName() === 'category' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'category.add' ? 'custom-active' : '' }}
                        "  href="javascript:void(0)">
                            <i class="ri-list-check-2"></i>
                            <span>Category</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('category') }}" >Category List</a>
                            </li>

                            <li>
                                <a href="{{ route('category.add') }}">Add New Category</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title 
                        {{ Route::currentRouteName() === 'subCategory' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'subCategory.add' ? 'custom-active' : '' }}
                        " href="javascript:void(0)">
                            <i class="ri-list-check"></i>
                            <span>Sub-Category</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('subCategory') }}">Sub-Category List</a>
                            </li>
                            <li>
                                <a href="{{ route('subCategory.add') }}">Add New Sub-Category</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title
                         {{ Route::currentRouteName() === 'product' ? 'custom-active' : '' }}
                         {{ Route::currentRouteName() === 'product.add' ? 'custom-active' : '' }}
                         " href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Product</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('product') }}">Product List</a>
                            </li>
                            <li>
                                <a href="{{ route('product.add') }}">Add New Products</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title 
                        {{ Route::currentRouteName() === 'all.orders' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'pending.orders' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'confirmed.orders' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'complete.orders' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'canceled.orders' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'packed.orders' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'shipped.orders' ? 'custom-active' : '' }}
                        " href="javascript:void(0)">
                            <i class="ri-archive-line"></i>
                            <span>Orders</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('all.orders') }}">All-Order</a>
                            </li>
                            <li>
                                <a href="{{route('pending.orders')}}">Pending-Orders</a>
                            </li>
                            <li>
                                <a href="{{route('confirmed.orders')}}">Confirmed-Orders</a>
                            </li>
                            <li>
                                <a href="{{route('packed.orders')}}">Packed-Orders</a>
                            </li>
                            <li>
                                <a href="{{route('shipped.orders')}}">Shipped-Orders</a>
                            </li>

                            <li>
                                <a href="{{route('complete.orders')}}">Completed-Orders</a>
                            </li>
                            <li>
                                <a href="{{route('return.order')}}">Return-Orders</a>
                            </li>
                            <li>
                                <a href="{{route('canceled.orders')}}">Canceled-Orders</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() === 'review' ? 'custom-active' : '' }}" href="{{route('review')}}">
                            <i class="ri-star-line"></i>
                            <span>Product Review</span>
                            
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() === 'user' ? 'custom-active' : '' }}" href="{{route('user')}}">
                            <i class="ri-user-3-line"></i>
                            <span>Users</span>
                            
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() === 'admin.newsletter' ? 'custom-active' : '' }}" href="{{route('admin.newsletter')}}">
                            <i class="ri-newspaper-line"></i>
                            <span>NewsLetter</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() === 'admin.payment' ? 'custom-active' : '' }}" href="{{route('admin.payment')}}">
                            <i class="ri-secure-payment-line"></i>
                            <span>Payments</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() === 'report' ? 'custom-active' : '' }}" href="{{route('report')}}">
                            <i class="ri-file-chart-line"></i>
                            <span>Reports</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title 
                        {{ Route::currentRouteName() === 'profile.setting' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'password.setting' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'coupon' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'banner' ? 'custom-active' : '' }}
                        {{ Route::currentRouteName() === 'website.setting' ? 'custom-active' : '' }}
                        " href="javascript:void(0)">
                            <i class="ri-settings-line"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{route('profile.setting')}}">Profile Setting</a>
                                <a href="{{route('password.setting')}}">Password Setting</a>
                                <a href="{{ route('coupon') }}">Coupon</a>
                                <a href="{{ route('banner') }}">Banners</a>
                                <a href="{{ route('website.setting') }}">Website Setting</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>
        </nav>
    </div>
</div>
