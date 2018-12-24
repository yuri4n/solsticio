<?php

//Web
Route::view('/', 'web.inicio');
Route::view('/inicio', 'web.inicio');

Route::view('/noticias', 'web.noticias');
Route::view('/noticias/{slug}', 'web.noticia');

Route::view('/servicios', 'web.servicios');
Route::view('/servicios/salon-de-juntas', 'web.salon-de-juntas');
Route::view('/servicios/salon-social', 'web.salon-social');
Route::view('/servicios/bbq', 'web.bbq');

Route::view('/archivos', 'web.archivos');

Route::view('/clasificados', 'web.clasificados');
Route::view('/clasificados/{slug}', 'web.clasificado');

Route::view('/peticiones', 'web.peticiones');
Route::view('/peticiones/genericas', 'web.peticiones_genericas');
Route::view('/peticiones/parqueadero', 'web.peticion_parqueadero');

Route::view('/censo', 'web.censo');

Route::view('/pagos', 'web.pagos');

//Admin
Route::view('/admin', 'admin.index');