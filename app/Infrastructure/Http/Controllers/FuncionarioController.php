<?php

namespace App\Infrastructure\Http\Controllers;

use App\Domain\Funcionario\Actions\ListarFuncionariosPorFolgaAction;
use App\Domain\Funcionario\DTOs\ListarUsuariosPorFolgaDto;
use App\Domain\Funcionario\Models\Funcionario;
use App\Http\Controllers\Controller;
use App\Infrastructure\Http\Validators\folga\IndexFolgaValidator;
use Illuminate\Support\Collection;

class FuncionarioController extends Controller
{
    public function index(IndexFolgaValidator $folgaValidator, ListarFuncionariosPorFolgaAction $action)
    {
        $dto = new ListarUsuariosPorFolgaDto(...$folgaValidator->validated());
        return $action->execute($dto);
    }

    public function listarFilial(): Collection
    {
        return Funcionario::select('filial')
            ->distinct()
            ->orderBy('filial', 'asc')
            ->pluck('filial');
    }
}
