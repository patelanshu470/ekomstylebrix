<?php

namespace App\Http\Controllers;

use App\Models\NewsLetter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Mail;
class NewsLetterController extends Controller
{
    public function newsLetter(Request $request)
    {
        $check = NewsLetter::where('email', $request->email)->get()->first();
        if ($check) {
            if ($check->status == '1') {
                $data = NewsLetter::find($check->id);
                $data->email = $request->email;
                $data->status = '0';
                $data->save();
                return back()->with('success', "You had unsubscribed the news-letter.");
            } else {
                $data = NewsLetter::find($check->id);
                $data->email = $request->email;
                $data->status = '1';
                $data->save();
                return back()->with('success', "Thanks for subscribing.");
            }
        } else {
            $data = new NewsLetter();
            $data->email = $request->email;
            $data->status = '1';
            $data->save();
            return back()->with('success', "Thanks for subscribing.");
        }
    }
    public function adminIndex()
    {
        $datas = NewsLetter::all();
        return view('newsletter.index', compact('datas'));
    }
    public function sendNews(Request $request)
    {
        // $data = [
        //     'tomail' => "anshu.coders@gmail.com",
        //     'tonamemail' => "subscriber",
        //     'body' => $request->body,
        // ];
        // return view('newsletter.email_template',$data);

        $rules = [
            'subject' => 'required',
            'body' => 'required',
        ];
        $customMessages = [
            'subject.required' => 'This field is required.',
            'body.required' => 'This field is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return back()->with('error', 'Email Heading and Body is required');
        }
        $subject = $request->subject; // Get the subject from the request
        $users = NewsLetter::where([['status', '1']])->select('email')->get();
        if ($users->count() > 0) {
            foreach ($users as $user) {
                $data = [
                    'tomail' => $user->email,
                    'tonamemail' => "subscriber",
                    'body' => $request->body,
                ];
        
                Mail::send('newsletter.email_template', $data, function ($message) use ($data, $subject) {
                    $message->to($data['tomail'], $data['tonamemail'])->subject($subject);
                    $message->from(getenv('MAIL_FROM_ADDRESS'), config('MAIL_USERNAME'));
                });
            }
        }
        
        return back()->with('success', 'Emails are send successfully.');
    }

    public function paymentHistory(){
        return view('backend.payment.payment');
    }
}
