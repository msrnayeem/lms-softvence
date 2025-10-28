<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

Route::redirect('/', '/courses')->name('index');

Route::controller(CourseController::class)->prefix('courses')->name('courses.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
});