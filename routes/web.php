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



/*
|--------------------------------------------------------------------------
| Example Code
|--------------------------------------------------------------------------
  Dynamic Route Example

  Route::get('/users/{id}/{name}', function($id, $name) {
    return 'This is user ' . $name. ' with an id of '.$id;
  });
|
*/

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::resource('posts', 'PostsController');

Route::resource('weeks', 'WeeksController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
