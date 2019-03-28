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

Route::group( ['middleware' => [], 'namespace' => 'Test' , 'prefix' => 'test'], function () {

    Route::get('/one', 'TestController@one')->name('onename');
    Route::get('/two', 'TestController@two')->name('twoname');
    Route::get('/getTestFacade', 'TestController@getTestFacade')->name('getTestFacadename');
    Route::get('/three', 'TestController@three')->name('threename');
    Route::get('/four', 'TestController@four')->name('fourname');
    Route::get('/fire', 'TestController@fire')->name('firename');
    Route::get('/decrypt', 'TestController@decrypt')->name('decryptname');
    Route::get('/decrypthtml', 'TestController@decrypthtml')->name('decrypthtmlname');
    Route::get('/md5', 'TestController@md5')->name('md5name');
    Route::post('/six', 'TestController@six')->name('sixname');
    Route::get('/get', 'TestController@get')->name('getname');
    Route::post('/post', 'TestController@post')->name('postname');
    Route::get('/getConfigParam', 'TestController@getConfigParam')->name('getConfigParamname');
    Route::get('/declareTicks', 'TestController@declareTicks')->name('declareTicksname');




    Route::get('/ftpUpload', 'TestController@ftpUpload')->name('ftpUploadRoute');


    Route::get('/jwt', 'TestController@jwt')->name('jwtRoute');
    Route::get('/jwt_encode', 'TestController@jwt_encode')->name('jwt_encodeRoute');
    Route::get('/jwt_decode', 'TestController@jwt_decode')->name('jwt_decodeRoute');


    Route::get('/testxu', 'TestController@testxu')->name('testxuRoute');




});

Route::group(['prefix' => 'async'], function () {
    Route::get('one', 'Async\AsyncController@one');
    Route::post('one2', 'Async\AsyncController@one2');

    Route::get('yemian', 'Async\AsyncController@yemian');
    Route::get('yemian2', 'Async\AsyncController@yemian2');


    Route::get('variable', 'Async\AsyncController@variable');
    Route::get('ueditor', 'Async\AsyncController@ueditor');


    Route::get('arrayone', 'Async\AsyncController@arrayone');

});




Route::group(['prefix' => 'one'], function () {
    Route::get('indexOne', 'One\OneController@indexOne');
    Route::post('indexTwo', 'One\OneController@indexTwo');
    Route::get('indexThree', 'One\OneController@indexThree');
    Route::get('indexFour', 'One\OneController@indexFour');
    Route::get('es_test', 'One\OneController@es_test');
});


Route::group(['prefix' => 'login'] , function () {
    Route::get("index", "Login\LoginController@index")->name('loginIndex');
    Route::get("login", "Login\LoginController@login")->name('login');
});

Route::group(['prefix' => 'login', 'middleware' => 'login'] , function () {
    Route::get("getData", "Login\LoginController@getData")->name('getData');
});





//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
