<?php

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

    Route::post('/ajax/insert', array(
        'as'   => 'company.insert.ajax',
        'uses' => 'CompanyController@insertAjax')
    );
    Route::get('/ajax/listing', array(
        'as'   => 'company.listing',
        'uses' => 'CompanyController@listing')
    );
});