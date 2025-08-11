<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::localized(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('/courses' . '/{course_id}', 'getCourse')->name('api.course.show');
        Route::get('/resources' . '/{resource_id}', 'getResource')->name('api.resource.show');
    });

    Route::controller(PostController::class)->group(function () {
        Route::get(Lang::uri('instant-search') . '/{keyword}', 'instantSearch')->name('instant_search');
    });
});
