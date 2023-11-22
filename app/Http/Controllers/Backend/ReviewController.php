<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review(){
        $datas=ProductReview::latest()->get();
        return view('backend.review.review',compact('datas'));
    }
    public function reviewStatus(Request $request)
    {
        $data = ProductReview::find($request->id);
        $data->status = $request->status;
        $data->save();
        return response()->json([
            'success' => 'Product status has been updated successfully!'
        ]);
    }
}
