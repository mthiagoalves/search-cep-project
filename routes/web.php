<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontendController@getAllCeps')->name('homepage');

Route::get('/{cep}', 'FrontendController@getOneCep')->name('getOneCep');

Route::post('/newAddress', 'FrontendController@createAddress')->name('createAddress');

