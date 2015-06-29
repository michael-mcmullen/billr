<?php

// HOME PAGE
Route::get('/', [
    'as'   => 'home',
    'uses' => 'HomeController@index'
]);

// COMPANY
Route::group(['prefix' => 'company'], function(){
    Route::get('/', array(
        'as'   => 'company',
        'uses' => 'CompanyController@index')
    );
    Route::get('/view/{id}', array(
        'as'   => 'company.view',
        'uses' => 'CompanyController@view')
    );
    Route::get('/add', array(
        'as'   => 'company.add',
        'uses' => 'CompanyController@add')
    );
    Route::post('/insert', array(
        'as'   => 'company.insert',
        'uses' => 'CompanyController@insert')
    );
    Route::get('/edit/{id}', array(
        'as'   => 'company.edit',
        'uses' => 'CompanyController@edit')
    );
    Route::post('/update', array(
        'as'   => 'company.update',
        'uses' => 'CompanyController@update')
    );
    Route::get('/delete/{id}', array(
        'as'   => 'company.delete',
        'uses' => 'CompanyController@delete')
    );
});

// BILL
Route::group(['prefix' => 'bill'], function(){
    Route::get('/', array(
        'as'   => 'bill',
        'uses' => 'BillController@index')
    );
    Route::get('/add/{company_id?}', array(
        'as'   => 'bill.add',
        'uses' => 'BillController@add')
    );
    Route::post('/insert', array(
        'as'   => 'bill.insert',
        'uses' => 'BillController@insert')
    );
    Route::get('/pay/{id}', array(
        'as'   => 'bill.pay',
        'uses' => 'BillController@pay')
    );
    Route::post('/paid/{id}', array(
        'as'   => 'bill.paid',
        'uses' => 'BillController@paid')
    );
    Route::get('/edit/{id}', array(
        'as'   => 'bill.edit',
        'uses' => 'BillController@edit')
    );
    Route::post('/update/{id}', array(
        'as'   => 'bill.update',
        'uses' => 'BillController@update')
    );
    Route::get('/delete/{id}', array(
        'as'   => 'bill.delete',
        'uses' => 'BillController@delete')
    );
});

// SETTINGS
Route::group(['prefix' => 'settings'], function(){
    Route::get('/', array(
        'as'   => 'settings',
        'uses' => 'SettingsController@index')
    );
    Route::post('/update', array(
        'as'   => 'settings.update',
        'uses' => 'SettingsController@update')
    );
    Route::get('/testSMS', array(
        'as'   => 'settings.testSMS',
        'uses' => 'SettingsController@testSMS')
    );
    Route::get('/testEmail', array(
        'as'   => 'settings.testEmail',
        'uses' => 'SettingsController@testEmail')
    );
});

// AUTHENTICATION
Route::group(['prefix' => 'auth'], function() {
    // Authentication routes...
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
    // Registration routes...
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');
});

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
