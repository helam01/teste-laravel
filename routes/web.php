<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', 'SacController@getSacForm')->name('getSac');
Route::get('sac', 'SacController@getSacForm')->name('getSac');
Route::post('sac', 'SacController@postSacForm')->name('postSac');
Route::post('postSacAjax', 'SacController@postSacFormAjax')->name('postSacAjax');

Route::get('relatorio', 'SacController@getRelatorio')->name('getRelatorio');
