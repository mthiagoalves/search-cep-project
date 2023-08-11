<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontendController@getAllCeps')->name('homepage');

Route::get('/{cep}', 'FrontendController@getOneCep')->name('getOneCep');

Route::post('/newAddress', 'FrontendController@createAddress')->name('createAddress');

Route::put('/updateAddress/{cep}', 'FrontendController@updateAddress')->name('updateAddress');

Route::delete('/deleteAddress/{cep}', 'FrontendController@deleteAddress')->name('deleteAddress');

