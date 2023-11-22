<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user(){
        $datas=User::where('type','user')->orderBy('id', 'DESC')->get();
        return view('backend.users.users',compact('datas'));
    }
}
