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
