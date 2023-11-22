<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallary;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ProductController extends Controller
{
    public function productIndex(Request $request)
    {
        if($request->status){
            if ($request->status == 'on') {
                $datas = Product::where('status',1)->orderBy('id', 'DESC')->get();
            } else {
                $datas = Product::where('status',0)->orderBy('id', 'DESC')->get();
            }
        }else{
        $datas = Product::where('varient_status',1)->orderBy('id', 'DESC')->paginate(10);
        }
        return view('backend.product.product_index', compact('datas'));
    }
    public function productFilter(Request $request)
    {
        if($request->status){
            if ($request->status == 'on') {
                $datas = Product::where('status',1)->orderBy('id', 'DESC')->get();
            } else {
                $datas = Product::where('status',0)->orderBy('id', 'DESC')->get();
            }
        }else{
            $datas = [];
        }
        return view('backend.product.product_status', compact('datas'));
    }

    public function productAdd()
    {
        $category = Category::where('status', 1)->get();
        return view('backend.product.product_add', compact('category'));
    }
    public function productStore(Request $request)
    {
        // dd(json_encode($request->size));
        // dd($request->set_to_all);
        $data = new Product();
        $data->name = $request->name;
        $data->color = $request->color;
        $data->slug = $request->slug;
        $data->size = json_encode($request->size);
        $data->cat_id = $request->cat_id;
        $data->sub_cat_id = $request->sub_cat_id;
        $data->cost_price = number_format((float) $request->input('cost_price'), 2, '.', '');
        $data->discount = $request->discount;
        $data->sell_price = number_format((float) $request->input('sell_price'), 2, '.', '');
        $data->final_sell_price = number_format((float) $request->input('final_sell_price'), 2, '.', '');
        $data->quantity = $request->quantity;
        $data->status = $request->status;
        $data->sku = $request->sku;
        $data->description = $request->description;
        $data->is_varient = $request->is_varient;
        $data->set_to_all = 1;
        $data->varient_ids = ($request->varient_ids) ?  json_encode($request->varient_ids) : null;


        if ($request->hasFile('thumbnail')) {
            $uploadFile = $request->file('thumbnail');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->store('product/thumbnail', 's3');
            $thumbnail_image = Storage::disk('s3')->url($path);
            $data['thumbnail'] = $thumbnail_image;
            $data->save();
        }

        if ($request->hasFile('color_image')) {
            $uploadFile = $request->file('color_image');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->store('product/color_image', 's3');
            $color_image = Storage::disk('s3')->url($path);
            $data['color_image'] = $color_image;
            $data->save();
        }

        $data->save();

        #set to all
        if ($request->varient_ids) {
            for ($i = 0; $i < count($request->varient_ids); $i++) {
                $allIds = $request->varient_ids;
                array_push($allIds, $data->id);
                $productId = $allIds[$i];
                $productData = Product::find($productId);
                $updatedIds = array_filter($allIds, function ($id) use ($productId) {
                    return $id != $productId;
                });
                if ($productId == $data->id) {
                    # Set the current product's varient_status to 1
                    $productData->varient_status = 1;
                    $varientStatusSet = true;
                } elseif ($productData->varient_status != 1) {
                    # Set other products' varient_status to 0, but only if it's not already 1
                    $productData->varient_status = 0;
                }
                // $productData->varient_status = 0;
                $productData->varient_ids = count($updatedIds) > 0 ? json_encode(array_values($updatedIds)) : null;
                $productData->set_to_all = '1';
                $productData->is_varient = '1';

                $productData->save();
            }
        }
        if ($request->default_product || !$request->varient_ids) {
            $data->varient_status = 1;
            $data->save();
            if ($request->varient_ids) {
                $varientIds = $request->varient_ids;
                Product::whereIn('id', $varientIds)
                    ->where('id', '!=', $data->id)
                    ->update(['varient_status' => 0]);
            }
        }
        #gallary
        if ($request->has('gallary') && $data) {
            foreach ($request->gallary as $img) {
                $attachment = new Gallary();
                $uploadFile = $img;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->store('product/gallary', 's3');
                $gallary_images = Storage::disk('s3')->url($path);
                $attachment['image'] = $gallary_images;
                $attachment->product_id = $data->id;
                $attachment->save();
            }
        }
        return redirect()->route('product')->with('success', "Product created successfully");
    }
    public function productEdit($id)
    {
        $data = Product::with('galleries')->find($id);
        $category = Category::where('status', 1)->get();
        $subCategory = SubCategory::where([['status', '=', 1], ['cat_id', '=', $data->cat_id]])->get();
        $product = Product::where([['cat_id', '=', $data->cat_id], ['sub_cat_id', '=', $data->sub_cat_id], ['id', '<>', $id]])->get();

        $varients = [];
        if ($data->varient_ids) {
            $varients = json_decode($data->varient_ids);
        }

        return view('backend.product.product_edit', compact('data', 'category', 'subCategory', 'product', 'varients'));
    }

    public function productUpdate(Request $request, $id)
    {
        $data = Product::find($id);
        $data->name = $request->name;
        $data->color = $request->color;
        $data->slug = $request->slug;
        $data->size = json_encode($request->size);
        $data->cat_id = $request->cat_id;
        $data->sub_cat_id = $request->sub_cat_id;
        $data->cost_price = number_format((float) $request->input('cost_price'), 2, '.', '');
        $data->discount = $request->discount;
        $data->sell_price = number_format((float) $request->input('sell_price'), 2, '.', '');
        $data->final_sell_price = number_format((float) $request->input('final_sell_price'), 2, '.', '');
        $data->quantity = $request->quantity;
        $data->status = $request->status;
        $data->sku = $request->sku;
        $data->description = $request->description;
        $data->is_varient = $request->is_varient;
        $data->varient_ids = ($request->varient_ids) ?  json_encode($request->varient_ids) : null;
        $data->set_to_all = $request->set_to_all;
        // if ($request->default_product) {
        //     // return $request->default_product;
        //     $data->varient_status = 1;
        // }
        if ($request->set_to_all and $request->varient_ids) {
            $varientStatusSet = false;
            for ($i = 0; $i < count($request->varient_ids); $i++) {

                $allIds = $request->varient_ids;
                array_push($allIds, $id);

                $productId = $allIds[$i];
                $productData = Product::find($productId);
                if ($productId == $id) {
                    # Set the current product's varient_status to 1
                    $productData->varient_status = 1;
                    $varientStatusSet = true;
                } elseif ($productData->varient_status != 1) {
                    # Set other products' varient_status to 0, but only if it's not already 1
                    $productData->varient_status = 0;
                }
                $updatedIds = array_filter($allIds, function ($id) use ($productId) {
                    return $id != $productId;
                });
                // Update the product's varient_ids with the updated array
                // $productData->varient_status = 0;.

                $productData->varient_ids = count($updatedIds) > 0 ? json_encode(array_values($updatedIds)) : null;
                $productData->set_to_all = '1';
                $productData->is_varient = '1';

                $productData->save();
            }

            // if (!$varientStatusSet) {
            //     $data->varient_status = 1;
            //     $data->save();
            // }
        }
        if ($request->default_product) {
            $data->varient_status = 1;
            $data->save();
            $varientIds = $request->varient_ids;
            Product::whereIn('id', $varientIds)
                ->where('id', '!=', $data->id)
                ->update(['varient_status' => 0]);
        }

        if ($request->hasFile('thumbnail')) {
            $uploadFile = $request->file('thumbnail');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->store('product/thumbnail', 's3');
            $thumbnail_image = Storage::disk('s3')->url($path);
            $old_image_filename = basename(parse_url($data->thumbnail, PHP_URL_PATH));
            # old image filename exists, delete it from the 's3' disk
            if ($old_image_filename) {
                Storage::disk('s3')->delete('product/thumbnail/' . $old_image_filename);
            }
            $data['thumbnail'] = $thumbnail_image;
            $data->save();
        }

        if ($request->hasFile('color_image')) {
            $uploadFile = $request->file('color_image');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->store('product/color_image', 's3');
            $color_image = Storage::disk('s3')->url($path);
            $old_color_image_filename = basename(parse_url($data->color_image, PHP_URL_PATH));
            # old image filename exists, delete it from the 's3' disk
            if ($old_color_image_filename) {
                Storage::disk('s3')->delete('product/color_image/' . $old_color_image_filename);
            }
            $data['color_image'] = $color_image;
            $data->save();
        }
        $data->save();
        if ($request->has('gallary') && $data) {
            foreach ($request->gallary as $img) {
                $attachment = new Gallary();
                $uploadFile = $img;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->store('product/gallary', 's3');
                $gallary_images = Storage::disk('s3')->url($path);
                $attachment['image'] = $gallary_images;
                $attachment->product_id = $data->id;
                $attachment->save();
            }
        }
        return redirect()->route('product')->with('success', "Product updated successfully");
    }
    public function productSubCat(Request $request)
    {
        $data['subcat'] = SubCategory::where([["cat_id", '=', $request->catId], ["status", '=', 1]])->get();
        return response()->json($data);
    }
    public function productVarient(Request $request)
    {
        $data['subcat'] = Product::where([["cat_id", '=', $request->catId], ["sub_cat_id", '=', $request->subCatId]])->get();
        return response()->json($data);
    }
    public function productSlugValidation(Request $request)
    {
        $datas['data'] = null;
        if ($request->id) {
            $datas['data'] = Product::where([["slug", 'like', $request->slug], ['id', '<>', $request->id]])->get()->first();
        } else {
            $datas['data'] = Product::where([["slug", 'like', $request->slug]])->get()->first();
        }
        return response()->json($datas);
    }
    public function productSKUValidation(Request $request)
    {
        $datas['data'] = null;
        if ($request->id) {
            $datas['data'] = Product::where([["sku", 'like', $request->sku], ['id', '<>', $request->id]])->get()->first();
        } else {
            $datas['data'] = Product::where([["sku", 'like', $request->sku]])->get()->first();
        }
        return response()->json($datas);
    }
    public function productImgDelete($id)
    {
        $gallary = Gallary::findOrFail($id);
        if ($gallary->image) {
            $old_image_filename = basename(parse_url($gallary->image, PHP_URL_PATH));
            # delete thumbnail
            if ($old_image_filename) {
                Storage::disk('s3')->delete('product/gallary/' . $old_image_filename);
            }
        }
        $gallary->delete();
        return back()->with('success', "Image is delete successfully.");
    }

    public function productDelete($id)
    {
        return back()->with('error','You cannot delete product');
        // $data = Product::with('galleries')->findOrFail($id);
        // if (count($data->galleries) > 0) {
        //     foreach ($data->galleries as $img) {
        //         // return $img;
        //         $imagePath = 'public/images/product/' . $img->image;
        //         unlink($imagePath);
        //     }
        // }
        // $data->delete();
        // return back()->with('success', "Product is delete successfully.");
    }
    public function productStatus(Request $request)
    {
        // $data = Product::find($request->id);
        // $data->status = $request->status;
        // $data->save();
        // return response()->json([
        //     'success' => 'Product status has been updated successfully!'
        // ]);
        // $data = Product::find($request->id);
        // if ($data) {
        //     $varientIds = json_decode($data->varient_ids); // Assuming varient_ids is stored as JSON

        //     if (!empty($varientIds)) {
        //         foreach ($varientIds as $key => $varientId) {
        //             if ($key === 0) {
        //                 // Set the status of the first variant to 1 (on)
        //                 $variant = Product::find($varientId);
        //                 if ($variant) {
        //                     $variant->varient_status = 1;
        //                     $variant->save();
        //                 }
        //             } else {
        //                 // Set the status of the other variants to 0 (off)
        //                 $variant = Product::find($varientId);
        //                 if ($variant) {
        //                     $variant->varient_status = 0;
        //                     $variant->save();
        //                 }
        //             }
        //         }
        //     }

        //     // Update the main product's status
        //     $data->status = $request->status;
        //     $data->save();

        //     return response()->json([
        //         'success' => 'Product status and variant statuses have been updated successfully!'
        //     ]);
        // } else {
        //     return response()->json([
        //         'error' => 'Product not found!'
        //     ], 404);
        // }
        $data = Product::find($request->id);
        if ($data) {
            $varientIds = json_decode($data->varient_ids);
            if (!empty($varientIds)) {
                $firstVariantEncountered = false;
                foreach ($varientIds as $varientId) {
                    $variant = Product::where('status', 1)->where('id', $varientId)->first();
                    if ($variant) {
                        if ($data->status === 0) {
                            $variant->varient_status = 0;
                        } elseif (!$firstVariantEncountered) {
                            $variant->varient_status = 1;
                            $firstVariantEncountered = true;
                        } else {
                            $variant->varient_status = 0;
                        }
                        $variant->save();
                    }
                }
            } else {
                if ($request->status == 1) {
                    $data->varient_status = 1 ;
                }
            }
            if ($request->status == 0) {
                $data->varient_status = 0;
            }
            $data->status = $request->status;
            $data->save();
            return response()->json([
                'success' => 'Product status and variant statuses have been updated successfully!'
            ]);
        } else {
            return response()->json([
                'error' => 'Product not found!'
            ], 404);
        }
    }
}
