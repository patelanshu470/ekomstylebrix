<?php

namespace App\Http\Controllers;

use App\Models\ContactUS;
use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function contactUs()
    {
        return view('legal.contact_us');
    }
    public function terms()
    {
        return view('legal.terms');
    }
    public function aboutUs()
    {
        return view('legal.about_us');
    }
    public function contactUsStore(Request $request)
    {
        $data = new ContactUS();
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->message = $request->message;
        $data->save();
        return back()->with('success', "Thanks for Contacting us,we will get back to you shortly.");
    }
    public function faq()
    {
        return view('legal.faq');
    }
}
