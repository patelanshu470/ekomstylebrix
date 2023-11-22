<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\CanceledOrder;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UserProfileController extends Controller
{
    public function viewProfile()
    {
        $wishlists = Wishlist::where('user_id', Auth()->user()->id)->get();
        $all_orders = Order::where([['user_id', '=', auth()->user()->id], ['payment_status', '=', 'succeeded']])->latest()->get();
        $address = Address::where('user_id', auth()->user()->id)->get();
        return view('frontend.profile.profile', compact('address', 'all_orders', 'wishlists'));
    }
    public function storeAddress(Request $request)
    {
        $data = new Address();
        $userAddresses = Address::where('user_id', Auth()->user()->id)->get();
        $data->user_id = Auth()->user()->id;
        $data->address_type = $request->address_type;
        $data->address = $request->address;
        $data->landmark = $request->landmark;
        $data->pincode = $request->pincode;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->city = $request->city;
        $data->contact_number = $request->contact_number;
        if ($request->default == 1) {
            foreach ($userAddresses as $add) {
                $add->default = 0;
                $add->save();
            }
            $data->default = $request->default;
        }
        $data->save();
        return back()->with('success', "Address added successfully.");
    }
    public function updateAddress(Request $request, $id)
    {
        $data = Address::find($id);
        $userAddresses = Address::where('user_id', Auth()->user()->id)->get();
        // $data->user_id=Auth()->user()->id;
        $data->address_type = $request->address_type;
        $data->address = $request->address;
        $data->landmark = $request->landmark;
        $data->pincode = $request->pincode;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->city = $request->city;
        $data->contact_number = $request->contact_number;
        if ($request->default == 1) {
            foreach ($userAddresses as $add) {
                $add->default = 0;
                $add->save();
            }
            $data->default = $request->default;
        }
        $data->save();

        return back()->with('success', "Address update successfully.");
    }
    public function deleteAddress($id)
    {
        $data = Address::find($id);
        $data->delete();
        return back()->with('success', "Address deleted successfully.");
    }
    public function orderTracking($id)
    {
        $order = Order::where('unique_no', $id)->get()->first();
        $products = OrderedProduct::join('orders', 'orders.id', '=', 'ordered_products.order_id')
            ->where([
                ['ordered_products.order_id', '=', $order->id],
                ['ordered_products.user_id', '=', Auth()->user()->id],
                // ['orders.order_status', '=', 'delivered']
            ])
            ->select('ordered_products.*')
            ->get();
        return view('frontend.profile.order_tracking', compact('products', 'order'));
    }

    public function orderCancel(Request $request, $id)
    {
        $orderCheck = Order::find($id);
        if ($orderCheck->confirmed_at == null and $orderCheck->canceled_at == null) {
            $data = new CanceledOrder();
            $data->order_id = $id;
            $data->user_id = auth()->user()->id;
            $data->canceled_by = 'user';
            if ($request->is_custom_reason == '1') {
                $data->reason = $request->custom_reason;
            } else {
                $data->reason = $request->reason;
            }
            $data->save();
            #updating order table
            $now = Carbon::now();
            $order = Order::find($id);
            $order->order_status = 'canceled';
            $order->canceled_at = $now;
            $order->canceled_by = 'user';
            $order->save();

            return back()->with('success', 'Order canceled successfully');
        } else {
            return back()->with('error', 'You had already canceled the order.');
        }
    }

    public function changePassword(Request $request)
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
            Session::flash('errors', $validator->errors());
            return redirect()->back()->with('error', "Invalid Request");
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
    public function checkPassword(Request $request)
    {
        if (Hash::check($request->old_password, auth()->user()->password)) {
            return response()->json([
                'result' => 'success',
                'message' => 'password matched',
            ]);
        } else {
            return response()->json([
                'result' => 'failed',
                'message' => 'wrong password',
            ]);
        }
    }
    public function updateProfile(Request $request)
    {
        $data = User::find(auth()->user()->id);
        if ($request->hasFile('profile_image')) {
            $uploadFile = $request->file('profile_image');
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
        $data->mobile = $request->mobile;
        $data->save();
        return back()->with('success', 'Profile update Successfully');
    }
}
