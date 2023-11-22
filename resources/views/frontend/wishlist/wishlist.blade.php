@extends('frontend.layouts.home_master')
@section('frontendContent')
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Wishlist</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="#">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="wishlist-section section-b-space">
        <div class="container-fluid-lg">
            @if (count($wishlists) > 0)
            <div class="row g-sm-4 g-3 row-cols-xxl-6 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section ratio_110">
                    @foreach ($wishlists as $wishlist)
                    <div>
                        <div class="product-box-5 wow fadeInUp">
                            <div class="product-image">
                                <a href="{{ route('product.details', $wishlist->product->slug) }}">
                                    <img src="{{ $wishlist->product->thumbnail }}"
                                        class="img-fluid blur-up lazyload bg-img" alt="">
                                </a>
                                <ul class="product-option" style="justify-content:space-evenly;width:126px;">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                        <a href="{{ route('product.details', $wishlist->product->slug) }}">
                                            <i data-feather="eye"></i>
                                        </a>
                                    </li>
                                    <li >
                                        <a href="{{ route('delete.wishlist',$wishlist->id) }}" class="notifi-wishlist-custom removeWishList" data-wishlistid="{{ $wishlist->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Removed To Wishlist">
                                            <i data-feather="heart" fill="currentColor"></i>
                                        </a>
                                    </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-detail">
                                <a href="#">
                                    <h5 class="name">{{ $wishlist->product->name }}</h5>
                                </a>
                                <h5 class="sold text-content">
                                    <span class="theme-color price">${{ $wishlist->product->final_sell_price }}</span>
                                    @if ($wishlist->product->discount)
                                        <del>${{ $wishlist->product->sell_price }}</del>
                                    @endif
                                </h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="row g-sm-4 g-3 row-cols-xxl-12 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section ratio_110" style="justify-content: center">
                    <div class="image" style="display: flex;justify-content: center;">
                        <img style="width:60% !important;height:484px !important;object-fit: contain;"
                            src="{{ asset('public/empty-cart.png') }}" />
                    </div>
                </div>
                @endif
        </div>
    </section>
    {{-- <script>
        $(document).ready(function() {
            $('.removeWishList').on('click', function() {
                var wishlistID = $(this).data('wishlistid');
                var cardToRemove = $(this).closest('.product-box-5');
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
                                message: "Product Removed to Wishlist",
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
                            // toastr.success(result.success);
                            cardToRemove.remove();
                        //     if (result.wishlist_total === 0) {
                        //     $('.product-list-section').html(
                        //         '<div class="image" style="display: flex;justify-content: center;">' +
                        //         '<img style="width:60% !important;height:484px !important;object-fit: contain;" src="{{ asset('public/empty-cart.png') }}" />' +
                        //         '</div>'
                        //     );
                        // }
                        }
                    }
                });
            });
        });
    </script> --}}
@endsection
