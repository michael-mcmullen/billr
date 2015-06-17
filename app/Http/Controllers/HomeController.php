<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HomeController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // REFACTOR LATER AFTER ALL WORKING
        // ***************************************
        // unpaid bills
        $companies = Auth::user()->companies;
        $unpaid    = array('total' => 0.00, 'count' => 0);
        $thisMonth = array('total' => 0.00, 'count' => 0);

        foreach($companies as $company)
        {
            $bills = $company->bills()->where('paid', false)->where('active', true)->get()->lists('amount');

            foreach($bills as $amount)
            {
                $unpaid['total'] += $amount;
                $unpaid['count'] += 1;
            }
        }

        // spent this month
        foreach($companies as $company)
        {

            $bills = $company->bills()->where("paid_date", 'LIKE', date('Y-m-') ."%")->get()->lists('amount');

            if(count($bills) > 0)
            {
                foreach($bills as $amount)
                {
                    $thisMonth['total'] += $amount;
                    $thisMonth['count'] += 1;
                }
            }
        }

        return view('home.index')->with('unpaid', $unpaid)->with('thisMonth', $thisMonth);
    }

}