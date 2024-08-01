<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('importacao');
});

Route::get('/funcionarios', function () {
    return view('funcionario');
});
