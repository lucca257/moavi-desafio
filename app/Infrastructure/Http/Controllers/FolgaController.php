<?php

namespace App\Infrastructure\Http\Controllers;

use App\Infrastructure\Http\Validators\folga\IndexFolgaValidator;
use App\Models\User;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class FolgaController extends Controller
{
    public function index(IndexFolgaValidator $folgaValidator)
    {

    }

    public function listFiliais(): Collection
    {
        return User::all()->pluck('filial');
    }
}
