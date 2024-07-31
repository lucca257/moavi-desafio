<?php

namespace App\Domain\Funcionario\DTOs;

use App\Infrastructure\Helpers\BaseDto;

class ListarUsuariosPorFolgaDto extends BaseDto
{
    public function __construct(
        public int $ano,
        public int $mes,
        public int $filial
    ) {
    }
}
