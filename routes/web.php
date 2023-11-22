<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\InvoiceController as BackendInvoiceController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentController as BackendPaymentController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReviewController as BackendReviewController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SubCatController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\InvoiceController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ReturnController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\NewsLetterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;



#Frontend Route
// Route::get('user/register', [LoginController::class, 'userRegister'])->name('user.register');
Auth::routes();
#Forgot Password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('add/to/cart', [CartController::class, 'addToCart'])->name('add.to.cart');
#shop
Route::get('shop', [ShopController::class, 'shop'])->name('shop');
Route::get('details/{slug}', [ShopController::class, 'productDetails'])->name('product.details');
#newsLetter
Route::post('newletter/subscribe', [NewsLetterController::class, 'newsLetter'])->name('newsletter');
#Legal
Route::get('terms', [LegalController::class, 'terms'])->name('terms');
Route::get('contact-us', [LegalController::class, 'contactUs'])->name('contact.us');
Route::post('contact-us/store', [LegalController::class, 'contactUsStore'])->name('contact.us.store');
Route::get('about-us', [LegalController::class, 'aboutUs'])->name('about.us');
Route::get('FAQ', [LegalController::class, 'faq'])->name('faq');

Route::group(['middleware' => ['auth', 'xss']], function () {
    Route::get('view/cart', [CartController::class, 'viewCart'])->name('view.cart');
    Route::post('delete/cart', [CartController::class, 'deleteCart'])->name('delete.cart');
    Route::post('update/cart', [CartController::class, 'updateCart'])->name('update.cart');
    Route::post('checkout/details', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('checkout', [CheckoutController::class, 'checkoutDetails'])->name('checkout.details');
    Route::post('coupon/apply', [CheckoutController::class, 'couponApply'])->name('coupon.apply'); //ajax
    #WishList
    Route::get('wishlist', [WishListController::class, 'wishList'])->name('wishlist');
    Route::post('add/to/wishlist', [WishListController::class, 'addToWishList'])->name('add.to.wishlist');
    Route::post('removed/to/wishlist', [WishListController::class, 'removeToWishList'])->name('remove.to.wishlist');
    Route::get('delete/wishlist/{id}', [WishListController::class, 'deleteWishList'])->name('delete.wishlist');
    #payment
    Route::get('payment/page/{order_id}', [PaymentController::class, 'paymentPage'])->name('payment.page');
    Route::get('payment/stripe/{order_id}', [PaymentController::class, 'payment'])->name('payment');
    Route::get('payment/stripe/store/{order_id}', [PaymentController::class, 'paymentStore'])->name('payment.store');
    Route::get('payment/success/{order_id}', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    #myprofile
    Route::get('profile', [UserProfileController::class, 'viewProfile'])->name('view.profile');
    Route::post('profile/update', [UserProfileController::class, 'updateProfile'])->name('update.profile');
    Route::get('store/address', [UserProfileController::class, 'storeAddress'])->name('store.address');
    Route::get('update/address/{id}', [UserProfileController::class, 'updateAddress'])->name('update.address');
    Route::get('delete/address/{id}', [UserProfileController::class, 'deleteAddress'])->name('delete.address');
    Route::get('order/tracking/{id}', [UserProfileController::class, 'orderTracking'])->name('order.tracking');
    Route::get('order/cancel/{id}', [UserProfileController::class, 'orderCancel'])->name('order.cancel');
    Route::post('check/password', [UserProfileController::class, 'checkPassword'])->name('check.password');
    Route::post('change/password', [UserProfileController::class, 'changePassword'])->name('change.password');
    #Review
    Route::post('review/add', [ReviewController::class, 'addReview'])->name('add.review');
    Route::post('review/update', [ReviewController::class, 'updateReview'])->name('update.review');
    #Invoice
    Route::get('order/invoice/{id}', [InvoiceController::class, 'orderInvoice'])->name('order.invoice');
    #Return
    Route::get('return/product/{id}', [ReturnController::class, 'returnProduct'])->name('return.product');
    Route::post('return/product/detail/{id}', [ReturnController::class, 'returnProductDetails'])->name('return.product.details');
});


#Backend Routes
Route::get('admin/login', [LoginController::class, 'adminLogin'])->name('user.login');
Route::post('product/update/{id}', [ProductController::class, 'productUpdate'])->name('product.update')->middleware('admin');
Route::post('product/store', [ProductController::class, 'productStore'])->name('product.store')->middleware('admin');

Route::group(['middleware' => ['admin', 'xss']], function () {
    Route::prefix('admin')->group(function () {
        #Dashboard
        Route::get('/', [DashboardController::class, 'dashboardIndex'])->name('dashboard');
        #Category
        Route::get('/category', [CategoryController::class, 'catIndex'])->name('category');
        Route::get('/category/add', [CategoryController::class, 'catAdd'])->name('category.add');
        Route::post('/category/store', [CategoryController::class, 'catStore'])->name('category.store');
        Route::get('/category/edit/{id}', [CategoryController::class, 'catEdit'])->name('category.edit');
        Route::post('/category/update/{id}', [CategoryController::class, 'catUpdate'])->name('category.update');
        Route::get('/category/delete/{id}', [CategoryController::class, 'catDelete'])->name('category.delete');
        Route::post('/category/status', [CategoryController::class, 'catStatus'])->name('category.status'); //ajax-route
        #Sub-Category
        Route::get('sub-category', [SubCatController::class, 'subCatIndex'])->name('subCategory');
        Route::get('sub-category/add', [SubCatController::class, 'subCatAdd'])->name('subCategory.add');
        Route::post('sub-category/store', [SubCatController::class, 'subCatStore'])->name('subCategory.store');
        Route::get('sub-category/edit/{id}', [SubCatController::class, 'subCatEdit'])->name('subCategory.edit');
        Route::post('sub-category/update/{id}', [SubCatController::class, 'subCatUpdate'])->name('subCategory.update');
        Route::get('sub-category/delete/{id}', [SubCatController::class, 'subCatDelete'])->name('subCategory.delete');
        Route::post('sub-category/status', [SubCatController::class, 'subCatStatus'])->name('subCategory.status'); //ajax-route
        #Product
        Route::get('product', [ProductController::class, 'productIndex'])->name('product');
        Route::get('product/filter', [ProductController::class, 'productFilter'])->name('product.filter');
        Route::get('product/add', [ProductController::class, 'productAdd'])->name('product.add');
        Route::get('product/varient', [ProductController::class, 'productVarient'])->name('product.varient'); //ajax-route
        Route::get('product/edit/{id}', [ProductController::class, 'productEdit'])->name('product.edit');
        Route::get('product/delete/{id}', [ProductController::class, 'productDelete'])->name('product.delete');
        Route::get('product/image/delete{id}', [ProductController::class, 'productImgDelete'])->name('product.img.delete'); //ajax-route
        Route::get('product/status', [ProductController::class, 'productStatus'])->name('product.status'); //ajax-route
        Route::get('product/subCat', [ProductController::class, 'productSubCat'])->name('product.subCat'); //Ajax Routes
        Route::get('product/slug/validation', [ProductController::class, 'productSlugValidation'])->name('product.slug.validation'); //Ajax Routes
        Route::get('product/sku/validation', [ProductController::class, 'productSKUValidation'])->name('product.sku.validation'); //Ajax Routes
        #Orders
        Route::get('all/orders', [OrderController::class, 'allOrders'])->name('all.orders');
        Route::get('pending/orders', [OrderController::class, 'pendingOrders'])->name('pending.orders');
        Route::get('confirmed/orders', [OrderController::class, 'confirmedOrders'])->name('confirmed.orders');
        Route::get('complete/orders', [OrderController::class, 'completeOrders'])->name('complete.orders');
        Route::get('canceled/orders', [OrderController::class, 'canceledOrders'])->name('canceled.orders');
        Route::get('call/status', [OrderController::class, 'callStatus'])->name('call.status');
        Route::get('order/details/{id}', [OrderController::class, 'orderDetails'])->name('order.details');
        Route::get('order/status', [OrderController::class, 'orderStatus'])->name('order.status');
        Route::get('check/new/order', [OrderController::class, 'checkNewOrder'])->name('check.new.order');
        Route::get('return/orders', [OrderController::class, 'returnOrder'])->name('return.order');
        Route::get('packed/orders', [OrderController::class, 'packedOrders'])->name('packed.orders');
        Route::get('shipped/orders', [OrderController::class, 'shippedOrders'])->name('shipped.orders');

        Route::post('return/orders/update/{id}', [OrderController::class, 'returnOrderUpdate'])->name('return.order.update');
        #Banner
        Route::get('banner', [BannerController::class, 'banner'])->name('banner');
        Route::post('banner/store', [BannerController::class, 'bannerStore'])->name('banner.store');
        Route::post('banner/update/{id}', [BannerController::class, 'bannerUpdate'])->name('banner.update');
        #Coupon
        Route::get('coupon', [CouponController::class, 'coupon'])->name('coupon');
        Route::post('coupon/store', [CouponController::class, 'couponStore'])->name('coupon.store');
        Route::post('coupon/update/{id}', [CouponController::class, 'couponUpdate'])->name('coupon.update');
        Route::get('coupon/check', [CouponController::class, 'couponCheck'])->name('coupon.check'); //ajax
        Route::post('coupon/status', [CouponController::class, 'couponStatus'])->name('coupon.status'); //ajax
        Route::get('coupon/delete/{id}', [CouponController::class, 'couponDelete'])->name('coupon.delete');
        Route::get('send/coupon/{id}', [CouponController::class, 'couponSend'])->name('coupon.send');
        #Review
        Route::get('review', [BackendReviewController::class, 'review'])->name('review');
        Route::get('review/status', [BackendReviewController::class, 'reviewStatus'])->name('review.status');
        #setting
        Route::get('setting/profile', [SettingController::class, 'profileSetting'])->name('profile.setting');
        Route::post('setting/profile/update', [SettingController::class, 'profileSettingUpdate'])->name('profile.setting.update');
        Route::get('password/profile', [SettingController::class, 'passwordSetting'])->name('password.setting');
        Route::post('password/profile/update', [SettingController::class, 'passwprdSettingupdate'])->name('password.setting.update');
        #all-users
        Route::get('all/users', [UserController::class, 'user'])->name('user');
        #Invoice
        Route::get('order/invoice/admin/{id}', [BackendInvoiceController::class, 'orderInvoice'])->name('order.invoice.admin');
        Route::get('order/invoice/send/admin/{id}', [BackendInvoiceController::class, 'sendInvoice'])->name('order.invoice.send.admin');
        #Newsletter
        Route::get('newletter/index', [NewsLetterController::class, 'adminIndex'])->name('admin.newsletter');
        Route::post('send/news', [NewsLetterController::class, 'sendNews'])->name('send.news.email');
        #payment
        Route::get('payment/history', [BackendPaymentController::class, 'paymentHistory'])->name('admin.payment');
        #report
        Route::get('report', [ReportController::class, 'report'])->name('report');
        #setting
        Route::get('website/setting', [SettingController::class, 'websiteSetting'])->name('website.setting');
        Route::post('website/setting/store', [SettingController::class, 'websiteSettingStore'])->name('website.setting.store');
    });
});
