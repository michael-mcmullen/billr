<?php

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