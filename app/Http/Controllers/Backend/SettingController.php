<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WebsiteDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class SettingController extends Controller
{
    #profile-setting
    public function profileSetting(Request $request)
    {
        return view('backend.setting.profile_setting');
    }
    public function profileSettingUpdate(Request $request)
    {
        $data = User::find(auth()->user()->id);
        $dublicate_check = User::where([['email','<>',$data->email],['email','=',$request->email]])->get()->first();
        if ($dublicate_check) {
            return back()->with('error', "Email is already taken.");
        }
        if ($request->hasFile('image')) {
            $uploadFile = $request->file('image');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->store('user/profile', 's3');
            $image_url = Storage::disk('s3')->url($path);
            $old_image_filename = basename(parse_url($data->profile_image, PHP_URL_PATH));
            #old image delete
            if ($old_image_filename) {
                Storage::disk('s3')->delete('user/profile/' . $old_image_filename);
            }
            $data->profile_image = $image_url;
            $data->save();
        }
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();
        return back()->with('success', 'Profile setting update successfully');
    }

    public function passwordSetting()
    {
        return view('backend.setting.password_setting');
    }
    public function passwprdSettingupdate(Request $request)
    {
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required',
        ];
        $customMessages = [
            'old_password.required' => 'Old Password is required.',
            'new_password.required' => 'New Password is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Old password is incorrect.'])->withInput();
        }
        if (Hash::check($request->old_password, auth()->user()->password)) {
            $data = User::find(auth()->user()->id);
            $data->password = Hash::make($request->new_password);
            $data->save();
            return redirect()->back()->with('success', "Password Updated Successfully");
        } else {
            return redirect()->back()->with('error', "Password not matched");
        }
    }

    public function websiteSetting()
    {
        return view('backend.setting.website_setting');
    }
    public function websiteSettingStore(Request $request)
    {

        $data = WebsiteDetails::get()->first();
        if (!$data) {
            $data = null;
            $data = new WebsiteDetails();
        }
        $data->website_name = $request->website_name;
        if ($request->hasFile('website_logo')) {
            $uploadFile = $request->file('website_logo');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->store('website/logo', 's3');
            $image_url = Storage::disk('s3')->url($path);
            $old_image_filename = basename(parse_url($data->logo, PHP_URL_PATH));
            #old image delete
            if ($old_image_filename) {
                Storage::disk('s3')->delete('website/logo/' . $old_image_filename);
            }
            $data->logo = $image_url;
            $data->save();
        }
        if ($request->hasFile('favicon_icon')) {
            $uploadFile = $request->file('favicon_icon');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->store('website/favicon', 's3');
            $favicon_image_url = Storage::disk('s3')->url($path);
            $old_image_filename = basename(parse_url($data->favicon_icon, PHP_URL_PATH));
            #old image delete
            if ($old_image_filename) {
                Storage::disk('s3')->delete('website/favicon/' . $old_image_filename);
            }
            $data->favicon_icon = $favicon_image_url;
            $data->save();
        }
        $data->location = $request->address;
        $data->email = $request->email;
        $data->fb_url = $request->fb_url;
        $data->twitter_url = $request->twitter_url;
        $data->insta_url = $request->insta_url;
        $data->pinterest_url = $request->pinterest_url;
        $data->save();
        return back()->with('success', "Website Details updated successfully");
    }
}
