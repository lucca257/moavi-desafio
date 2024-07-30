<?php

use App\Applications\Api\Category\Controllers\CategoryController;
use App\Applications\Api\Post\Controllers\PostApiController;
use Illuminate\Support\Facades\Route;

Route::controller(PostApiController::class)->prefix('posts')->group(function () {
    Route::get('', 'index')->name('posts.index');
    Route::get('search/{search}', 'search')->name('posts.search');
    Route::get('{post}', 'show')->name('posts.show');
    Route::post('', 'store')->name('posts.store');
});

Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('', 'index')->name('category.index');
});
