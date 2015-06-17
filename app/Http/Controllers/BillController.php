<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Session;

class BillController extends Controller {

    var $validationRules = array();

    public function __construct()
    {
        $this->middleware('auth');

        $this->validationRules = [
            'company_id' => 'required|numeric|exists:companies,id',
            'amount'     => 'required|numeric',
            'due_date'   => 'required|date_format:Y-m-d'
        ];
    }

    public function index()
    {

    }

    public function add()
    {
        return view('bill.add');
    }

    /**
     * try to insert the company if validation passes
     * @param  Request $request [description]
     */
    public function insert(Request $request)
    {
        // validate user input
        $this->validate($request, $this->validationRules);

        // validation passed, create the bill with the associated information
        \App\Bill::create([
            'company_id'  => $request->input('company_id'),
            'amount'      => $request->input('amount'),
            'received'    => $request->input('due_date'), // @TODO FIX THIS LATER
            'due'         => $request->input('due_date'),
            'paid'        => ' ',
            'paid_amount' => 0,
            'paid_date'   => null
        ]);

        Session::flash('success', ['The bill has been added successfully']);

        return Redirect::route('company');
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