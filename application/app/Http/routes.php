<?php

// HOME PAGE
Route::get('/', [
    'as'   => 'home',
    'uses' => 'HomeController@index'
]);

include('Routes/Auth.php');
include('Routes/Company.php');
include('Routes/Bill.php');
include('Routes/Settings.php');
include('Routes/Subscription.php');