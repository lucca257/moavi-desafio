<?php

namespace App\Infrastructure\Http\Controllers;

use App\Domain\Importacao\Actions\ImportAction;
use App\Domain\Importacao\Models\Importacao;
use App\Infrastructure\Http\Validators\Import\CreateImportValidator;
use App\Http\Controllers\Controller;

class ImportController extends Controller
{
    public function create(CreateImportValidator $createImportValidator, ImportAction $action)
    {
        $file = $createImportValidator->file('file');
        $action->execute($file);

        return response()->json();
    }

    public function list()
    {
        return Importacao::all();
    }
}
