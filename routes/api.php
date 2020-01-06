<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});

Route::resource('users', 'UserController', array('except' => array('create', 'edit')));
Route::get('/admin/users', 'UserController@complete');
Route::put('/admin/users/{user}', 'UserController@updateStatus');

Route::resource('posts', 'PostController', array('except' => array('create', 'edit')));
Route::get('/admin/posts', 'PostController@admin');

Route::resource('files', 'FileController', array('except' => array('create', 'edit')));

Route::resource('classifieds', 'ClassifiedController', array('except' => array('create', 'edit')));
Route::get('/admin/classifieds', 'ClassifiedController@admin');
Route::put('/admin/classifieds/{classified}', 'ClassifiedController@updateStatus');

Route::resource('reservations', 'ReservationController', array('except' => array('create', 'edit')));
Route::get('/reservations/approved', 'ReservationController@approved');
Route::put('/admin/reservations/{reservation}', 'ReservationController@updateAndNotify');

Route::resource('petitions', 'PetitionController', array('except' => array('create', 'edit')));

Route::resource('parkings', 'ParkingController', array('except' => array('create', 'edit')));

Route::resource('censuses', 'CensusController', array('except' => array('create', 'edit')));

Route::resource('categories', 'CategoryController', array('except' => array('create', 'edit')));

Route::post('/mails/{mail}', 'MailController@send');
