<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Session;

class SettingsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * shows the index for settings
     */
    public function index()
    {
        $providers     = \Config::get('providers');
        $notifications = \Config::get('notifications');
        $timezoneList  = \DateTimeZone::listIdentifiers();
        $timezones     = array();

        // restructure timezones
        foreach($timezoneList as $timezone)
        {
            $timezones[$timezone] = $timezone;
        }

        return view('settings.index', [
            'providers'     => $providers,
            'notifications' => $notifications,
            'timezones'     => $timezones,
        ]);
    }

    /**
     * update the settings
     * @param  Request $request [description]
     */
    public function update(Request $request)
    {
        $rules = [
            'phone_number'      => 'required_if:notification_type,SMS',
            'phone_provider'    => 'required_if:notification_type,SMS',
            'notification_days' => 'required|integer|min:0|max:30',
            'timezone'          => 'required',
        ];


        $this->validate($request, $rules);

        // Update the user's settings
        Auth::user()->phone_number      = $request->input('phone_number');
        Auth::user()->phone_provider    = $request->input('phone_provider');
        Auth::user()->notification_type = $request->input('notification_type');
        Auth::user()->notification_days = $request->input('notification_days');
        Auth::user()->timezone          = $request->input('timezone');
        Auth::user()->save();

        Session::flash('success', ['Your settings have been saved']);

        return Redirect::route('settings');
    }

    public function testSMS()
    {
        $this->dispatch(new \App\Jobs\TestSMS(Auth::id()));

        Session::flash('success', ['A test SMS Notification has been sent to your phone.']);

        return Redirect::route('settings');
    }

    public function testEmail()
    {
        $this->dispatch(new \App\Jobs\TestEmail(Auth::id()));

        Session::flash('success', ['A test Email Notification has been sent to your inbox.']);

        return Redirect::route('settings');
    }

}