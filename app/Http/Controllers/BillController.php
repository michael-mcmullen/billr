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

    public function add()
    {
        return view('bill.add');
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
    }

    /**
     * updates the company
     * * @param  Request $request [description]
     */
    public function update(Request $request)
    {
    }

    /**
     * deletes the company that the user has chosen
     * @param  integer $id company id
     */
    public function delete($id)
    {
    }

}