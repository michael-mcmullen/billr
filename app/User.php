<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'phone_number', 'phone_provider', 'notification_type', 'notification_days'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * a user can have many bills
     */
    public function bills()
    {
        return $this->hasMany('App\Bill');
    }

    /**
     * a user can have many companies
     */
    public function companies()
    {
        return $this->hasMany('App\Company');
    }

    public static function canSMS()
    {
        $canSendSMS = true;

        if(empty(\Auth::user()->phone_number))
            $canSendSMS = false;
        if(empty(\Auth::user()->phone_provider))
            $canSendSMS = false;
        if(strtolower(\Auth::user()->notification_type) != 'sms')
            $canSendSMS = false;

        return $canSendSMS;
    }
}
