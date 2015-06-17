<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'account_number', 'active'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * the company belongs to a user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * a company can have many bills
     */
    public function bills()
    {
        return $this->hasMany('App\Bill');
    }

    public static function loadCompany($id)
    {
        $company = Company::find($id);

        if(intval(Auth::id()) !== intval($company->user_id))
        {
            $company = null;
        }

        return $company;
    }
}
