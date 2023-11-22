<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function shop(Request $request)
    {
        $products = [];
        #filter
        $query = Product::where('status', '1')->where('varient_status',1);
        if ($request->subcategory && $request->subcategory != " ") {
            $query->where('sub_cat_id', $request->subcategory);
        }
        if ($request->price && $request->price != " ") {
            $range_array = explode(';', $request->price);
            $products = $query->whereRaw('CAST(final_sell_price AS UNSIGNED) BETWEEN ? AND ?', [$range_array[0], end($range_array)]);
        }
        if ($request->discount && $request->discount != " ") {
            if ($request->discount == "5") {
                $discountRange = range(1, 5);
                $products = $query->whereRaw('CAST(discount AS UNSIGNED) BETWEEN ? AND ?', [$discountRange[0], end($discountRange)]);
            } elseif ($request->discount == "10") {
                $discountRange = range(6, 10);
                $products = $query->whereRaw('CAST(discount AS UNSIGNED) BETWEEN ? AND ?', [$discountRange[0], end($discountRange)]);
            } elseif ($request->discount == "15") {
                $discountRange = range(11, 15);
                $products = $query->whereRaw('CAST(discount AS UNSIGNED) BETWEEN ? AND ?', [$discountRange[0], end($discountRange)]);
            } elseif ($request->discount == "25") {
                $discountRange = range(16, 25);
                $products = $query->whereRaw('CAST(discount AS UNSIGNED) BETWEEN ? AND ?', [$discountRange[0], end($discountRange)]);
            } elseif ($request->discount == "25+") {
                $products = $query->whereRaw('CAST(discount AS UNSIGNED) > ?', [25]);
            }
        }
        if ($request->sort && $request->sort != " ") {
            if ($request->sort == 'low_to_high') {
                $query->orderByRaw("CAST(final_sell_price AS DECIMAL(10, 2)) ASC");
            } elseif ($request->sort == "high_to_low") {
                $query->orderByRaw("CAST(final_sell_price AS DECIMAL(10, 2)) DESC");
            } elseif ($request->sort == "off") {
                $query->orderByRaw("CAST(discount AS DECIMAL(10, 2)) DESC");
            }
        }
        $products = $query->with(['review' => function ($query) {
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
            ->latest()
            ->paginate(20);

        // Getting product according to rating
        if ($request->min_avg_rating && $request->min_avg_rating != " ") {
            $minAvgRating = $request->min_avg_rating;
            $products = Product::where('status', 1)
                ->when($request->subcategory && $request->subcategory != " ", function ($query) use ($request) {
                    $query->where('sub_cat_id', $request->subcategory);
                })
                ->when($request->price && $request->price != " ", function ($query) use ($request) {
                    $range_array = explode(';', $request->price);
                    $query->whereRaw('CAST(final_sell_price AS UNSIGNED) BETWEEN ? AND ?', [$range_array[0], end($range_array)]);
                })
                ->with(['review' => function ($query) {
                    $query->where('status', 1)
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
                ->having('avg_rating', '>=', $minAvgRating) // Filter by minimum average rating
                ->latest()
                ->paginate(20);
        }
        #wishlist
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $wishlist = Wishlist::where('user_id', $user_id)->pluck('id', 'product_id')->toArray();
        } else {
            $wishlist = array();
        }
        $category = Category::where('status', 1)->get();
        $shopBanner1 = Banner::where('type', 'shopBanner1')->get()->first();
        $shopBanner2 = Banner::where('type', 'shopBanner2')->get()->first();
        $shopBanner3 = Banner::where('type', 'shopBanner3')->get()->first();

        return view('frontend.shop.shop', compact('products', 'category', 'shopBanner1', 'shopBanner2', 'shopBanner3','wishlist'));
    }

    public function productDetails($slug)
    {
        // $data = Product::where([['slug', '=', $slug], ['status', '=', 1]])->with('galleries')->get()->first();
        $data = Product::where([['slug', '=', $slug], ['status', '=', 1]])
            ->with(['galleries', 'review' => function ($query) {
                $query->where('status', '1')
                    ->select('product_id', 'rating', 'user_id', 'description', 'image', 'created_at');
            }])
            ->withCount(['review as avg_rating' => function ($query) {
                $query->where('status', '1')
                    ->select(\DB::raw('FLOOR(AVG(rating))'));
            }])
            ->withCount(['review as total_raters' => function ($query) {
                $query->where('status', '1')
                    ->select(\DB::raw('COUNT(DISTINCT user_id)'));
            }])->firstOrFail();


        $varient = null;
        if ($data->varient_ids) {
            $varients = json_decode($data->varient_ids);
            foreach ($varients as $var) {
                $varient[] = Product::where([['status','=','1'],['id','=',$var]])->get()->first();
            }
        }
        // return $varient;
        #Related Products
        $query = Product::where([['cat_id', '=', $data->cat_id],['status','=','1']])->where('varient_status',1);
        $related_products = $query->with(['review' => function ($query) {
            $query->where('status', '1')
                ->select('product_id', 'rating', 'user_id');
        }])
            ->withCount(['review as avg_rating' => function ($query) {
                $query->where('status', '1')
                    ->select(DB::raw('FLOOR(AVG(rating))'));
            }])
            ->withCount(['review as total_raters' => function ($query) {
                $query->where('status', '1')
                    ->select(DB::raw('COUNT(DISTINCT user_id)'));
            }])->where('id','<>',$data->id)
            ->get();
        #wishlist
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $wishlist = Wishlist::where('user_id', $user_id)->pluck('id', 'product_id')->toArray();
        } else {
            $wishlist = array();
        }
        $trending = Product::where([['status', '=', "1"]])->where('varient_status',1)->limit(5)->get();
        $productBanner = Banner::where('type', 'productBanner')->get()->first();
        return view('frontend.product.product_details', compact('data', 'varient', 'related_products', 'trending', 'productBanner','wishlist'));
    }
}
