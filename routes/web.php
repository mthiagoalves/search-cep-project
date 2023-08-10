<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontendController@getAllCeps')->name('homepage');

