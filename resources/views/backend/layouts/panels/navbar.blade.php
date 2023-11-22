<div class="page-header">
    <div class="header-wrapper m-0">
        <div class="header-logo-wrapper p-0">
            <div class="logo-wrapper">
                <a href="#">
                    <img class="img-fluid main-logo" src="{{ asset(getenv('WEBSTIE_LOGO')) }}"
                        alt="logo">
                    <img class="img-fluid white-logo" src="{{ asset(getenv('WEBSTIE_LOGO')) }}"
                        alt="logo">
                </a>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
                <a href="#">
                    <img src="{{ asset(getenv('WEBSTIE_LOGO')) }}" class="img-fluid" alt="">
                </a>
            </div>
        </div>
        <div class="nav-right col-6 pull-right right-header p-0">
            <ul class="nav-menus">
                <li>
                    <span class="header-search">
                        <i class="ri-search-line"></i>
                    </span>
                </li>
                {{-- <li class="onhover-dropdown">
                    <div class="notification-box">
                        <i class="ri-notification-line"></i>
                        <span class="badge rounded-pill badge-theme">4</span>
                    </div>

                    <ul class="notification-dropdown onhover-show-div">
                        <li>
                            <i class="ri-notification-line"></i>
                            <h6 class="f-18 mb-0">Notitications</h6>
                        </li>
                        <li>
                            <p>
                                <i class="fa fa-circle me-2 font-primary"></i>Delivery processing <span
                                    class="pull-right">10 min.</span>
                            </p>
                        </li>
                        <li>
                            <p>
                                <i class="fa fa-circle me-2 font-success"></i>Order Complete<span class="pull-right">1
                                    hr</span>
                            </p>
                        </li>
                        <li>
                            <p>
                                <i class="fa fa-circle me-2 font-info"></i>Tickets Generated<span class="pull-right">3
                                    hr</span>
                            </p>
                        </li>
                        <li>
                            <p>
                                <i class="fa fa-circle me-2 font-danger"></i>Delivery Complete<span class="pull-right">6
                                    hr</span>
                            </p>
                        </li>
                        <li>
                            <a class="btn btn-primary" href="javascript:void(0)">Check all notification</a>
                        </li>
                    </ul>
                </li> --}}

                <li>
                    <div class="mode">
                        <i class="ri-moon-line"></i>
                    </div>
                </li>
                <li class="profile-nav onhover-dropdown pe-0 me-0">
                    <div class="media profile-media">
                        <img class="user-profile rounded-circle"
                            src="{{ (auth()->user()->profile_image)?   asset('public/images/profile/'.auth()->user()->profile_image):asset('public/no-image.png')}}" alt="">
                        <div class="user-name-hide media-body">
                            <span>{{auth()->user()->name}}</span>
                            <p class="mb-0 font-roboto">Admin<i class="middle ri-arrow-down-s-line"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <a href="{{route('user')}}">
                                <i data-feather="users"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('all.orders')}}">
                                <i data-feather="archive"></i>
                                <span>Orders</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('profile.setting')}}">
                                <i data-feather="settings"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li>
                            <a data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop" href="javascript:void(0)">
                                <i data-feather="log-out"></i>
                                <span>Log out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
   <!-- Modal Start -->
   <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog  modal-dialog-centered">
       <div class="modal-content">
           <div class="modal-body">
               <h5 class="modal-title" id="staticBackdropLabel">Logging Out</h5>
               <p>Are you sure you want to log out?</p>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               <div class="button-box">
                   <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                   <button type="button" class="btn  btn--yes btn-primary" 
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">Yes</button>
               </div>
           </div>
       </div>
   </div>
</div>
<!-- Modal End -->
