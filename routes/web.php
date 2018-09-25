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

Route::resources([
    'travels' => 'TravelController'
]);

Route::prefix('/travels/{travel}')->group(function(){
    Route::resource('visits', 'VisitController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
