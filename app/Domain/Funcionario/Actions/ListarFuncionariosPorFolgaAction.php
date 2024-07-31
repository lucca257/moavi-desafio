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
        $domingos = $this->obterDomingos($dto->ano, $dto->mes);

        return Funcionario::where('filial', $dto->filial)
            ->get()
            ->map(function ($item) use ($domingos) {
                $diasTrabalhados = 0;
                $item->domingos = $domingos->mapWithKeys(function ($data) use ($item, &$diasTrabalhados) {
                    if ($item->ciclo === 0 || $diasTrabalhados == $item->ciclo) {
                        $diasTrabalhados = 0;
                        return [$data => 'folga'];
                    }

                    $diasTrabalhados++;
                    return [$data => 'trabalho'];
                });

                return $item;
            });
    }

    private function obterDomingos(string $ano, string $mes): Collection
    {
        $inicioMes = Carbon::create($ano, $mes, 1);
        $fimMes = $inicioMes->copy()->endOfMonth();

        $periodo = CarbonPeriod::create($inicioMes, $fimMes);

        $domingos = collect();

        foreach ($periodo as $data) {
            if ($data->isSunday()) {
                $domingos->push($data->format('d/m/Y'));
            }
        }

        return $domingos;
    }
}
