<?php

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