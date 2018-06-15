<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group( ['middleware' => ['cors'], 'namespace' => 'Test' , 'prefix' => 'test'], function () {

    Route::get('/one', 'TestController@one')->name('onename');
    Route::get('/two', 'TestController@two')->name('twoname');
    Route::get('/getTestFacade', 'TestController@getTestFacade')->name('getTestFacadename');
    Route::get('/three', 'TestController@three')->name('threename');




});
