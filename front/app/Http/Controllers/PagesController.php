<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller {


    public function __construct()
    {
    }

    /**
     * shows the index view
     */
    public function index()
    {
        return view('pages.index');
    }

}