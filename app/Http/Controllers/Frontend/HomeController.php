<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Wishlist;

class HomeController extends Controller
{
    public function index()
    {
        $category = Category::where('status', 1)->get();
        $all_products = Product::where('status', 1)->where('varient_status',1)->get();

        #Recenty Added Products
            $query = Product::where('status', 1)->where('varient_status',1);
            $recently = $query->with(['review' => function ($query) {
                $query->where('status', '1')
                    ->select('product_id', 'rating', 'user_id');
            }])
                ->withCount(['review as avg_rating' => function ($query) {
                    $query->where('status', '1')
                        ->select(\DB::raw('FLOOR(AVG(rating))'));
                }])
                ->withCount(['review as total_raters' => function ($query) {
                    $query->where('status', '1')
                        ->select(\DB::raw('COUNT(DISTINCT user_id)'));
                }])
                ->latest()->get();
        #end recently added

        #Top-selling
        $get_product = Product::where('status', 1)->where('varient_status',1)->get();
        #For getting trending products count according to Confirm Order;
        $products = DB::table('products')
            ->join('ordered_products', 'ordered_products.product_id', '=', 'products.id')
            ->join('orders', 'orders.id', '=', 'ordered_products.order_id')
            ->where([['orders.payment_status', '=', 'succeeded'], ['products.status', '=', 1], ['orders.order_status', '=', 'delivered']])  //change "confirm" string according to Payment Method
            ->select('products.*', 'orders.payment_status')
            ->get();
        $counts = [];
        $uniqueIds = [];
        #For getting count
        foreach ($products as $product) {
            $id = $product->id;
            if (!in_array($id, $uniqueIds)) {
                $counts[$id] = 1;
                $uniqueIds[] = $id;
            } else {
                $counts[$id]++;
            }
        }
        #For getting all products without dublicate ,here count will be added in all products to getting trend
        $top_selling = [];
        foreach ($get_product as $product_datas) {
            if (in_array($product_datas->id, $uniqueIds)) {
                $img = $product_datas->image;

                #Getting AVG Rating of all products
                $rating = null;
                $totalRating = null;
                $rating_sum = null;
                $rating = ProductReview::where([['product_id', '=', $product_datas->id], ['status', '=', '1']])->pluck('rating');
                $totalRating = count($rating);
                if ($totalRating > 0) {
                    $rating_sum = $rating->sum();
                    $product_datas["avg_rating"] = floor($rating_sum / $totalRating);
                    $product_datas["total_raters"] = $totalRating;
                } else {
                    $product_datas["avg_rating"] = null;
                    $product_datas["total_raters"] = $totalRating;
                }
                #end
                unset($product_datas->image);
                $id = $product_datas->id;
                $product_datas->count = $counts[$id];
                $top_selling[] = $product_datas;
            }
        }
        #For sorting according to Count value
        usort($top_selling, function ($a, $b) {
            $b->count - $a->count;
        });
        #end top selling

        #Top Rated Products
            $query = Product::where('status', 1)->where('varient_status',1);
            $top_rated = $query->with(['review' => function ($query) {
                $query->where('status', '1')
                    ->select('product_id', 'rating', 'user_id');
            }])
                ->withCount(['review as avg_rating' => function ($query) {
                    $query->where('status', '1')
                        ->select(\DB::raw('FLOOR(AVG(rating))'));
                }])
                ->withCount(['review as total_raters' => function ($query) {
                    $query->where('status', '1')
                        ->select(\DB::raw('COUNT(DISTINCT user_id)'));
                }])
                ->orderBy('total_raters', 'desc')->limit(3)
                ->get();
        #end Top Rated Products

        #wishlist
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $wishlist = Wishlist::where('user_id', $user_id)->pluck('id', 'product_id')->toArray();
        } else {
            $wishlist = array();
        }
        $bannerOne = Banner::where('type', 'banner1')->get()->first();
        $bannerTwo = Banner::where('type', 'banner2')->get()->first();
        $bannerThree = Banner::where('type', 'banner3')->get()->first();
        $bannerFour = Banner::where('type', 'banner4')->get()->first();

        $featureCoupon = Coupon::where('is_feature', '1')->get()->first();

        return view('frontend.layouts.home_index', compact('top_rated','category', 'all_products', 'recently', 'top_selling', 'bannerOne', 'bannerTwo', 'bannerThree', 'bannerFour', 'featureCoupon','wishlist'));
    }
}
