<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Http\Requests\OTPRequest;

class VerifyOTPController extends Controller
{
    public function verify(OTPRequest $request){
       
        if($request->otp == Cache::get('OTP_'.auth()->user()->id)){

            auth()->user()->update(['isVerified' => true]);
            return redirect('/home');
        }

        return back()->withErrors('OTP is Expired or invalid');
    }

    public function showVerify(){
        
        return view('OTP.verify');
    }
}
