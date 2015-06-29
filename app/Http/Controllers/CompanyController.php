<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Session;

class CompanyController extends Controller {

    var $validationRules = array();

    public function __construct()
    {
        $this->middleware('auth');

        $this->validationRules = [
            'company_name' => 'required|min:2'
        ];
    }

    /**
     * shows the index view
     */
    public function index()
    {
        return view('company.index');
    }

    /**
     * shows the view company
     * @param  integer $id company id
     */
    public function view($id)
    {
        $company = \App\Company::loadCompany($id);

        if(! $company)
        {
            return Redirect::route('home');
        }

        return view('company.view')
            ->with('company', $company);
    }

    /**
     * shows the add view
     */
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
        // validate user input
        $this->validate($request, $this->validationRules);

        // validation passed, insert company
        $company = new \App\Company([
            'name'           => $request->input('company_name'),
            'nickname' => $request->input('nickname')
        ]);


        Auth::user()->companies()->save($company);
        Session::flash('success', ['The company has been added successfully']);

        return Redirect::route('company');
    }

    /**
     * shows the edit screen for the assocaited company
     * @param  integer $id company id
     */
    public function edit($id)
    {
        // Load the company
        $company = \App\Company::loadCompany($id);

        // did we pass validation and find the company
        if(empty($company))
        {
            return Redirect::route('company');
        }

        return view('company.edit')->with('company', $company);
    }

    /**
     * updates the company
     * * @param  Request $request [description]
     */
    public function update(Request $request)
    {
        // validate user input
        $this->validate($request, $this->validationRules);

        // validation passed, insert company
        $company = \App\Company::loadCompany($request->input('id'));

        // did we pass validation and find the company
        if(empty($company))
        {
            return Redirect::route('company');
        }

        $company['name']           = $request->input('company_name');
        $company['nickname'] = $request->input('nickname');
        $company->save();

        Session::flash('success', ['The company has been updated successfully']);
        return Redirect::route('company');
    }

    /**
     * deletes the company that the user has chosen
     * @param  integer $id company id
     */
    public function delete($id)
    {
        // Load the company
        $company = \App\Company::loadCompany($id);

        // did we pass validation and find the company
        if(empty($company))
        {
            return Redirect::route('company');
        }

        $company->active = false;
        $company->save();

        // we will need to find any bills associated with the company
        // make them inactive also
        foreach($company->bills as $bill)
        {
            $bill->active = false;
            $bill->save();
        }

        Session::flash('success', ['The company has been deleted successfully, and all associated bills have been removed']);
        return Redirect::route('company');
    }

}