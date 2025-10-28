<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::namespace('App\Http\Controllers')->prefix('courses')->group(function () {
    Route::get('/', 'CourseController@index')->name('courses.index');
    Route::get('/create', 'CourseController@create')->name('courses.create');
    Route::post('/', 'CourseController@store')->name('courses.store'); 
});
