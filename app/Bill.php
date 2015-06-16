<?php

namespace App;

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'company_id', 'amount', 'received', 'due',
                            'paid', 'paid_amount', 'paid_date'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * a bill belongs to a company
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
