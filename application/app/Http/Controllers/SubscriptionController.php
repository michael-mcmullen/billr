<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Redirect;
use Session;

class SubscriptionController extends Controller {

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['register', 'create']]);
    }

    /**
     * will show them the plan information
     * @return [type] [description]
     */
    public function index()
    {
        return 'place holder';
    }

    /**
     * will allow the user to register an account (same as auth/register)
     * but accepts credit card information
     * @return [type] [description]
     */
    public function register()
    {
        return view('subscription.register');
    }

    public function create(Request $request)
    {
        // Account Rules, we will check 'stripe-token' later
        $rules = [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ];

        // validate the request, returning errors back to the form
        $this->validate($request, $rules);

        // create the user
        $user = User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        // subscribe the user with stripe
        $user->subscription('mybillr')->create($request->input('stripe-token'));

        // log the user in
        Auth::login($user);

        return Redirect::route('home');
    }

    /**
     * this will allow users who have not already subscribed to subscribe
     * @return [type] [description]
     */
    public function subscribe()
    {
        return 'subscribe';
    }

}