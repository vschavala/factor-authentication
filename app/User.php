<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements ShouldQueue
{
    use Notifiable;
  

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','isVerified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function cacheOTP(){

        $OTP = rand(10000,99999);

        Cache::put(['OTP_'.$this->id => $OTP], now()->addMinutes(5));

        return $OTP;
    }

    public function sendOTP(){

        Mail::to($this->email)->send(new OTPMail($this->cacheOTP()));
    }
}
