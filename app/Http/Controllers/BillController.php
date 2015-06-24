<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Session;

class BillController extends Controller {

    var $validationRules    = array();
    var $validationMessages = array();

    public function __construct()
    {
        $this->middleware('auth');

        $this->validationRules = [
            'company_id'  => 'required|numeric|exists:companies,id',
            'amount'      => 'required|numeric',
            'received'    => 'required|date_format:Y-m-d',
            'due_date'    => 'required|date_format:Y-m-d',
            'paid'        => 'required|in:0,1',
            'paid_amount' => 'required_if:paid,1|numeric',
            'paid_date'   => 'required_if:paid,1|date_format:Y-m-d'
        ];

        $this->validationMessages = [
            'paid_amount.required_if' => 'The :attribute is required when the bill has been marked as paid',
            'paid_date.required_if'   => 'The :attribute is required when the bill has been marked as paid'
        ];
    }

    public function index()
    {
        $overdueBills = \App\Bill::before(date('Y-m-d'), false);
        $nextBills    = \App\Bill::next(30, false);
        $futureBills  = \App\Bill::after(30, false);

        return view('bill.index')
            ->with('overdueBills', $overdueBills)
            ->with('nextBills', $nextBills)
            ->with('futureBills', $futureBills);
    }

    /**
     * show the add view
     * @param integer $company_id optional, company id
     */
    public function add($company_id = null)
    {
        return view('bill.add')->with('company_id', $company_id);
    }

    /**
     * try to insert the bill if validation passes
     * @param  Request $request [description]
     */
    public function insert(Request $request)
    {
        // validate user input
        $this->validate($request, $this->validationRules, $this->validationMessages);

        // validation passed, create the bill with the associated information
        $bill = new \App\Bill([
            'company_id'       => $request->input('company_id'),
            'amount'           => $request->input('amount'),
            'received'         => $request->input('received'),
            'due'              => $request->input('due_date'),
            'paid'             => $request->input('paid'),
            'paid_amount'      => $request->input('paid_amount'),
            'paid_date'        => $request->input('paid_date'),
            'reference_number' => $request->input('reference_number')
        ]);

        // save the bill using eloquent (automatically insert the current logged in user)
        Auth::user()->bills()->save($bill);

        Session::flash('success', ['The bill has been added successfully']);

        return Redirect::route('bill');
    }

    /**
     * shows the edit screen for the assocaited company
     * @param  integer $id company id
     */
    public function edit($id)
    {
        // load the bill
        $bill = \App\Bill::loadBill($id);

        if(empty($bill))
        {
            return Redirect::route('bill');
        }

        return view('bill.edit')->with('bill', $bill);
    }

    /**
     * display the payment for the bill
     * @param  integer $id bill id
     */
    public function pay($id)
    {
        // load the bill
        $bill = \App\Bill::loadBill($id);

        if(empty($bill))
        {
            return Redirect::route('bill');
        }

        return view('bill.pay')->with('bill', $bill);
    }

    /**
     * try to mark the bill as paid
     * @param  Request $request user input
     * @param  integer $id bill id
     */
    public function paid(Request $request, $id)
    {
        // load the bill
        $bill = \App\Bill::loadBill($id);

        if(empty($bill))
        {
            return Redirect::route('bill');
        }

        // validation rules
        $validationRules = [
            'paid'        => 'required|in:0,1',
            'paid_amount' => 'required_if:paid,1|numeric',
            'paid_date'   => 'required_if:paid,1|date_format:Y-m-d'
        ];

        $validationMessages = [
            'paid_amount.required_if' => 'The :attribute is required when the bill has been marked as paid',
            'paid_date.required_if'   => 'The :attribute is required when the bill has been marked as paid'
        ];

        $this->validate($request, $validationRules, $validationMessages);

        // update the bill
        $bill->paid             = true;
        $bill->paid_amount      = $request->input('paid_amount');
        $bill->reference_number = $request->input('reference_number');
        $bill->save();

        // tell the user
        Session::flash('success', ['The bill has been paid successfully']);

        // redirect
        return Redirect::route('bill');
    }

    /**
     * updates the company
     * * @param  Request $request [description]
     */
    public function update(Request $request, $id)
    {
        // load the bill
        $bill = \App\Bill::loadBill($id);

        if(empty($bill))
        {
            return Redirect::route('bill');
        }

        // validate user input
        $this->validate($request, $this->validationRules, $this->validationMessages);

        // update the bill
        $bill->company_id       = $request->input('company_id');
        $bill->amount           = $request->input('amount');
        $bill->received         = $request->input('received');
        $bill->due              = $request->input('due_date');
        $bill->paid             = $request->input('paid');
        $bill->paid_amount      = $request->input('paid_amount');
        $bill->paid_date        = $request->input('paid_date');
        $bill->reference_number = $request->input('reference_number');
        $bill->save();

        // tell the user
        Session::flash('success', ['The bill has been updated successfully']);

        // redirect
        return Redirect::route('bill');
    }

    /**
     * deletes the company that the user has chosen
     * @param  integer $id company id
     */
    public function delete($id)
    {
        // load the bill
        $bill = \App\Bill::loadBill($id);

        if(empty($bill))
        {
            return Redirect::route('bill');
        }

        // delete the bill
        $bill->active = false;
        $bill->save();

        // tell the user
        Session::flash('success', ['The bill has been deleted successfully']);

        // redirect
        return Redirect::route('bill');
    }

}