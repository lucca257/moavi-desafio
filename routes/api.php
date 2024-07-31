<?php

use App\Infrastructure\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;

Route::controller(ImportController::class)->prefix('import')->group(function () {
    Route::get('', 'list')->name('import.list');
    Route::post('', 'create')->name('import.create');
});

//Route::controller(ImportController::class)->prefix('import')->group(function () {
//    Route::get('', 'index')->name('import.index');
//});
