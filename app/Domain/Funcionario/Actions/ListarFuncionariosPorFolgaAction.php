<?php

namespace App\Domain\Funcionario\Actions;

use App\Domain\Funcionario\DTOs\ListarUsuariosPorFolgaDto;
use App\Domain\Funcionario\Models\Funcionario;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class ListarFuncionariosPorFolgaAction
{
    public function execute(ListarUsuariosPorFolgaDto $dto)
    {
        /**
         * Buscar todos os funcionários da filial
         * Separar em grupos de quem vai trabalhar e folgar
         *
         */

        $funcionarios = Funcionario::with('folgas')
            ->where('filial', $dto->filial)
            ->get();


        $domingos = $this->obterDomingos($dto->ano, $dto->mes);
    }

    private function obterDomingos(string $ano, string $mes): Collection
    {
        $inicioMes = Carbon::create($ano, $mes);
        $fimMes = $inicioMes->copy()->endOfMonth();
        $periodo = CarbonPeriod::create($inicioMes, $fimMes);

        $domingos = collect();

        foreach ($domingos as $data) {
            if ($data->isSunday()) {
                $domingos->push($data->format('d-m-Y'));
            }
        }

        return $domingos;
    }
}
