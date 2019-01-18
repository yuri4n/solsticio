<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('posts', 'PostController', array('except' => array('create', 'edit')));
Route::get('/admin/posts', 'PostController@admin');

Route::resource('files', 'FileController', array('except' => array('create', 'edit')));

Route::resource('classifieds', 'ClassifiedController', array('except' => array('create', 'edit')));

Route::resource('reservations', 'ReservationController', array('except' => array('create', 'edit')));
