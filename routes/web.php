<?php

use App\Applications\Web\Post\PostWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostWebController::class, 'index']);
