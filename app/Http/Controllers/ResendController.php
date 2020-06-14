<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResendController extends Controller
{
   public function resend(){
        auth()->user()->sendOTP();

       return back()->with('msg', 'OTP resent Successfully');
   }
}
