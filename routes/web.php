<?php

Route::get('/', function () {
    return view('web.inicio');
});
Route::get('/inicio', function () {
    return view('web.inicio');
});

Route::get('/noticias', function () {
    return view('web.noticias');
});

Route::get('/noticias/noticia', function () {
    return view('web.noticia');
});

Route::get('/admin', function () {
    return view('admin.index');
});