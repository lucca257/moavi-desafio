<?php

use App\Infrastructure\Http\Controllers\FuncionarioController;
use App\Infrastructure\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;

Route::controller(ImportController::class)->prefix('import')->group(function () {
    Route::get('', 'list')->name('import.list');
    Route::post('', 'create')->name('import.create');
});

Route::controller(FuncionarioController::class)->prefix('funcionario')->group(function () {
    Route::post('', 'index')->name('funcionario.index');
    Route::get('/filial', 'listarFilial')->name('funcionario.filial');
});
