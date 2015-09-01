<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(intval(Auth::user()->notification_days) <= 0)
        {
            Session::flash('notification_warning', true);
        }

        $overdueBills    = \App\Bill::before(date('Y-m-d'), false);
        $nextUnpaidBills = \App\Bill::next(Auth::user()->notification_days, false);
        $nextPaidBills   = \App\Bill::next(Auth::user()->notification_days, true);
        $lastPaidBills   = \App\Bill::before(date('Y-m-d'), true);

        // refactor into REPORTS
        $report = array();
        // get months
        for($month = 1; $month <= 12; $month++)
        {
            $startDate = mktime(0, 0, 0, $month, 1, date('Y'));
            $stopDate  = mktime(0, 0, 0, $month, date('t', $startDate), date('Y'));
            $bills = \App\Bill::between(date('Y-m-d', $startDate), date('Y-m-d', $stopDate), true);

            $report['months'][]  = date('F Y', $startDate);
            $report['amounts'][] = $bills->sum('amount');
        }

        return view('home.index')
            ->with('overdueBills', $overdueBills)
            ->with('nextUnpaidBills', $nextUnpaidBills)
            ->with('nextPaidBills', $nextPaidBills)
            ->with('lastPaidBills', $lastPaidBills)
            ->with('report_months', json_encode($report['months']))
            ->with('report_amounts', json_encode($report['amounts']));

    }

}