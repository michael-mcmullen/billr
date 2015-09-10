<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bills';

    /**
     * the dates on the table
     */
     protected $dates = ['created_at', 'updated_at', 'received', 'due', 'paid_date'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'user_id', 'company_id', 'amount', 'received',
                            'due', 'paid', 'paid_amount', 'paid_date',
                            'reference_number' ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * a bill belongs to a user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * a bill belongs to a company
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    /**
     * loads the bill handling the authentication
     * @param  integer $id bill id
     * @return bill    bill array
     */
    public static function loadBill($id)
    {
        $bill = array();

        $bill = Bill::find($id);

        if(! empty($bill))
        {
            if(Auth::id() != $bill['user_id'])
            {
                return array();
            }
        }

        return $bill;
    }


    /**
     * returns the bills between the given time periods for the current logged in user
     * @param  date         $dateStart  the start date (refers to due)
     * @param  date         $dateStop   the stop date (refers to due)
     * @param  boolean      $paid       if the bill has been paid or not
     * @return collection               the bills from the request period
     */
    public static function between($dateStart, $dateStop, $paid)
    {
        $bills = Auth::user()->bills()->where('active', true)->where('paid', $paid)->whereBetween('due', [$dateStart, $dateStop])->orderBy('due')->get();

        return $bills;
    }

    /**
     * returns the bills for the next $DAYS for the logged in user
     * @param  integer      $days   number of days to go ahead
     * @param  boolean      $paid   if you want paid or unpaid bills
     * @param  integer $user_id null will use the authenticated user
     * @return collection           collection of bills
     */
    public static function next($days, $paid, $user_id = null)
    {
        $dateStart = date('Y-m-d');
        $dateStop  = date('Y-m-d', strtotime("+$days days"));

        if(! $user_id)
        {
            $user_id = Auth::id();
        }

        $user = \App\User::find($user_id);

        $bills = $user->bills()->where('active', true)->where('paid', $paid)->whereBetween('due', [$dateStart, $dateStop])->orderBy('due')->get();

        return $bills;
    }

    /**
     * returns the bills previous todays day minus (-) the $days for the logged in user
     * @param  integer      $days       the number of days to go back
     * @param  boolean      $paid       if you want paid or unpaid bills
     * @return collection               collection of bills
     */
    public static function previous($days, $paid)
    {
        $dateStart  = date('Y-m-d', strtotime("-$days days"));

        $bills = Auth::user()->bills()->where('active', true)->where('paid', $paid)->where('due', '<=', $dateStart)->orderBy('due')->get();

        return $bills;
    }

    /**
     * returns the bills after the $DAYS for the logged in user
     * @param  integer      $days   number of days to go ahead
     * @param  boolean      $paid   if you want paid or unpaid bills
     * @param  integer $user_id null will use the authenticated user
     * @return collection           collection of bills
     */
    public static function after($days, $paid, $user_id = null)
    {
        $dateStart = date('Y-m-d', strtotime("+$days days"));

        if(! $user_id)
        {
            $user_id = Auth::id();
        }

        $user = \App\User::find($user_id);

        $bills = $user->bills()->where('active', true)->where('paid', $paid)->where('due', '>', $dateStart)->orderBy('due')->get();

        return $bills;
    }

    /**
     * returns the bills before the $date for the logged in user
     * @param  integer      $dateStart  the date to start looking for bills
     * @param  boolean      $paid       if you want paid or unpaid bills
     * @return collection               collection of bills
     */
    public static function before($dateStart, $paid, $user_id = null)
    {
        if(! $user_id)
        {
            $user_id = Auth::id();
        }

        $user = \App\User::find($user_id);

        return $user->bills()->where('active', true)->where('paid', $paid)->where('due', '<', $dateStart)->orderBy('due')->get();
    }

    public function isOverdue()
    {
        $due   = strtotime(date('Y-m-d', strtotime($this->due)));
        $today = strtotime(date('Y-m-d'));

        return ($due - $today < 0) ? true : false;
    }
}
