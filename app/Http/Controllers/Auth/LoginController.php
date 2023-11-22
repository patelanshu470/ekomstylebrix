<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        
        if (Session::has('cart_data')) {

            $cartData = Session::get('cart_data', []);

            $product_id = $cartData['product_id'];
            $quantity = $cartData['quantity'];
            $size = $cartData['size'];
    
            $cartEntry = Cart::where([['product_id', '=', $product_id], ['user_id', '=', $user->id],['size', '=', $size]])->first();
    
            if ($cartEntry) {
                // Update the cart quantity if the product is already in the cart
                if (!$cartEntry->quantity > 5) {
                    $cartEntry->quantity += $quantity;
                    $cartEntry->save();
                }
            } else {
                // Create a new cart entry if the product is not in the cart
                $cartEntry = new Cart();
                $cartEntry->product_id = $product_id;
                $cartEntry->quantity = $quantity;
                $cartEntry->size = $size;
                $cartEntry->user_id = $user->id;
                $cartEntry->save();
            }
        
            // Clear the session data
            Session::forget('cart_data');

        }


        if ($request->input('type') == 191) {
            if ($user->type === 'user') {
                return redirect('/');
            } else {
                Auth::logout();
                return redirect()->back()->with(['error' => 'Access Denied.']);
            }
        } elseif ($request->input('type') == 704) {
            if ($user->type === 'admin') {
                return redirect('/admin');
            } else {
                Auth::logout();
                return redirect()->back()->with(['error' => 'Access Denied.']);
            }
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    public function adminLogin(Request $request)
    {
        return view('auth.admin_login');
    }
    // public function userRegister(Request $request)
    // {
    //     return view('auth.register');
    // }


}
