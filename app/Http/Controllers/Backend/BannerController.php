<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class BannerController extends Controller
{
    public function banner(){
        $bannerOne=Banner::where('type','banner1')->get()->first();
        $bannerTwo=Banner::where('type','banner2')->get()->first();
        $bannerThree=Banner::where('type','banner3')->get()->first();
        $bannerFour=Banner::where('type','banner4')->get()->first();
        $productBanner=Banner::where('type','productBanner')->get()->first();

        $shopBanner1=Banner::where('type','shopBanner1')->get()->first();
        $shopBanner2=Banner::where('type','shopBanner2')->get()->first();
        $shopBanner3=Banner::where('type','shopBanner3')->get()->first();
        return view('backend.banner.banner',compact('bannerOne','bannerTwo','bannerThree','bannerFour','productBanner','shopBanner1','shopBanner2','shopBanner3'));
    }
    public function bannerStore(Request $request){

        $data=new Banner();
        if ($request->file('banner_image')) {
            $uploadFile = $request->file('banner_image');
            // $file_name = $uploadFile->hashName();
            // $path = $uploadFile->move('public/images/banner/',$file_name);
            $path = $uploadFile->store('banner_images', 's3');
            $file_name = Storage::disk('s3')->url($path);
            $data['banner'] = $file_name;

        }
        $data->type=$request->type;
        $data->link=$request->link;
        $data->special_text=$request->special_text;
        $data->header_text=$request->header_text;
        $data->short_desc=$request->short_desc;
        $data->save();

        return back()->with('success','Banner created Successfully');
    }

    public function bannerUpdate(Request $request,$id){
        $data=Banner::find($id);
        if ($request->file('banner_image')) {
            $uploadFile = $request->file('banner_image');
            $path = $uploadFile->store('banner_images', 's3');
            $file_name = Storage::disk('s3')->url($path);
            // Remove the old image
            if ($data->banner) {
                $old_image_filename = basename(parse_url($data->banner, PHP_URL_PATH));
                if ($old_image_filename) {
                    Storage::disk('s3')->delete('banner_images/' . $old_image_filename);
                }
            }
            $data['banner'] = $file_name;
        }
        $data->type=$request->type;
        $data->link=$request->link;
        $data->special_text=$request->special_text;
        $data->header_text=$request->header_text;
        $data->short_desc=$request->short_desc;
        $data->save();
        return back()->with('success','Banner Updated Successfully');

    }

}
