<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract,
                                    BillableContract
{
    use Authenticatable, Authorizable, CanResetPassword, Billable;

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
     * The attributes that will be converted into carbon
     * @var array
     */
    protected $dates = ['trial_ends_at', 'subscription_ends_at'];

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

    public function canCreateCompany()
    {
        if($this->companies()->where('active', true)->count() >= 3)
        {
            return $this->subscribed();
        }

        return true;
    }
}
