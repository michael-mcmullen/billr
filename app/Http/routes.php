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
        'uses' => 'HomeController@index')
    );
    Route::get('/add', array(
        'as'   => 'bill.add',
        'uses' => 'BillController@add')
    );
    Route::post('/insert', array(
        'as'   => 'bill.insert',
        'uses' => 'BillController@insert')
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
