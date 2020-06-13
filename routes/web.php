<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware'=>'auth'], function() {

    //Project
    Route::get('project', 'ProjectController@index')
        ->name('project.index');
    Route::get('project/create', 'ProjectController@create')
        ->name('project.create');
    Route::post('project/store', 'ProjectController@store')
        ->name('project.store');
    Route::get('project/{id}/edit/', 'ProjectController@edit')
        ->name('project.edit');
    Route::put('project/{id}/update/', 'ProjectController@update')
        ->name('project.update');
    Route::delete('project/{id}/destroy/', 'ProjectController@destroy')
        ->name('project.destroy');
    Route::get('project/{id}/show/', 'ProjectController@show')
        ->name('project.show');

    //Task
    Route::get('task', 'TaskController@index')
        ->name('task.index');
    Route::get('task/create', 'TaskController@create')
        ->name('task.create');
    Route::post('task/store', 'TaskController@store')
        ->name('task.store');
    Route::get('task/{id}/edit/', 'TaskController@edit')
        ->name('task.edit');
    Route::put('task/{id}/update/', 'TaskController@update')
        ->name('task.update');
    Route::delete('task/{id}/destroy/', 'TaskController@destroy')
        ->name('task.destroy');
    Route::get('task/updatePriority', 'TaskController@updatePriority')
        ->name('task.updatePriority');
    Route::get('task/updateTable', 'TaskController@updateTable')
        ->name('task.updateTable');
});
