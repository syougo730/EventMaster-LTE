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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test', function () {
    return view('test');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'DashController@index')->name('dash.index');


//試合関連
Route::group(['prefix'=>'event'],function(){
    
    //試合情報取り込み
    Route::get('/create', 'EventCreateController@index')->name('create');
    Route::match(['post'],'/set', 'EventCreateController@set')->name('set');
    Route::get('/end', 'EventCreateController@end')->name('end');

});
