<?php

Route::get('/', function () {
    return view('inicio');
});
Route::get('/inicio', function () {
    return view('inicio');
});

Route::get('/noticias', function () {
    return view('noticias');
});