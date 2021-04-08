<?php

namespace App;
use Twilio\Rest\Client;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'password',
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
        'phone_verified_at' => 'datetime',
    ];


    public function hasVerifiedPhone()
    {
        return !is_null($this->phone_verified_at);
    }

    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }


    public function msgToVerify()
    {
        $code = random_int(100000, 999999);

        $this->forceFill([
            'verification_code' => $code
        ])->save();
        $account_sid = env('account_sid');
        $auth_token = env('auth_token');
        $twilio_number = env('twilio_number');
        $user_phone = '+'.$this->phone;
        
        $client = new Client($account_sid, $auth_token);
        $message = $client->messages->create(
            // Where to send a text message 
            $user_phone,
            array(
                'from' => $twilio_number,
                'body' => 'your verification code is ' . $code
            )
        );
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
