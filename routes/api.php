<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('users', 'UserController', array('except' => array('create', 'edit')));

Route::resource('posts', 'PostController', array('except' => array('create', 'edit')));
Route::get('/admin/posts', 'PostController@admin');

Route::resource('files', 'FileController', array('except' => array('create', 'edit')));

Route::resource('classifieds', 'ClassifiedController', array('except' => array('create', 'edit')));
Route::get('/admin/classifieds', 'ClassifiedController@admin');
Route::put('/admin/classifieds/{classified}', 'ClassifiedController@updateStatus');

Route::resource('reservations', 'ReservationController', array('except' => array('create', 'edit')));

Route::resource('petitions', 'PetitionController', array('except' => array('create', 'edit')));

Route::resource('parkings', 'ParkingController', array('except' => array('create', 'edit')));

Route::resource('censuses', 'CensusController', array('except' => array('create', 'edit')));
