<?php

// HOME PAGE
Route::get('/', [
    'as'   => 'home',
    'uses' => 'PagesController@index'
]);
