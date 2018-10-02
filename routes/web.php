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

Route::post('/timezone', 'HomeController@timezone')->name('timezone');

Route::resources([
    'travels' => 'TravelController'
]);

Route::prefix('/travels/{travel}')->group(function(){
    Route::resources([
        'visits' => 'VisitController',
        'tasks' => 'TaskController',
        'expenses' => 'ExpenseController',
        'trips' => 'TripController'
    ]);

    Route::prefix('/tasks/{task}')->group(function(){
        Route::resource('comments', 'CommentController');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
