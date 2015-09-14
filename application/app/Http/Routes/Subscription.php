<?php

Route::group(['prefix' => 'subscription'], function(){
    Route::get('/', array(
        'as'   => 'subscription',
        'uses' => 'SubscriptionController@index')
    );
    Route::get('/subscribe', array(
        'as'   => 'subscription.subscribe',
        'uses' => 'SubscriptionController@subscribe')
    );

    Route::get('/register', array(
        'as'   => 'subscription.register',
        'uses' => 'SubscriptionController@register')
    );
    Route::post('/create', array(
        'as'   => 'subscription.create',
        'uses' => 'SubscriptionController@create')
    );
});