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


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'DashController@index')->name('dash.index');


//試合関連
Route::group(['prefix'=>'event','as'=>'event.'],function(){
    
    //試合情報取り込み
    Route::get('/create', 'EventCreateController@index')->name('create');
    Route::match(['post'],'/set', 'EventCreateController@set')->name('set');
    Route::get('/end', 'EventCreateController@end')->name('end');

    Route::get('/', 'EventController@index')->name('index');
    Route::get('/{event_id?}', 'EventController@list')->where('event_id', '[0-9]+')->name('list');
    Route::get('/{event_id?}/{athlete_id?}', 'AthleteController@index')->where('event_id', '[0-9]+')->where('athlete_id', '[0-9]+')->name('athlete');
    Route::put('/{event_id?}/{athlete_id?}/memo', 'AthleteController@update')->where('event_id', '[0-9]+')->where('athlete_id', '[0-9]+')->name('athlete.update');

});


Route::get('/dscreator', 'DsController@index')->name('ds.index');
