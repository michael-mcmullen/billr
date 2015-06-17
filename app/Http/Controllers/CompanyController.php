<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Session;

class CompanyController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('company.index');
    }

    public function add()
    {
        return view('company.add');
    }

    /**
     * try to insert the company if validation passes
     * @param  Request $request [description]
     */
    public function insert(Request $request)
    {
        // validate the company
        $validationRules = [
            'company_name' => 'required|min:2'
        ];

        $this->validate($request, $validationRules);

        // validation passed, insert company
        $company = new \App\Company([
            'name'           => $request->input('company_name'),
            'account_number' => $request->input('account_number')
        ]);


        Auth::user()->companies()->save($company);
        Session::flash('success', ['The company has been added successfully']);

        return Redirect::route('company');
    }

}