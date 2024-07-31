<?php

namespace App\Domain\Funcionario\DTOs;

use App\Infrastructure\Helpers\BaseDto;

class FuncionarioDto extends BaseDto
{
    public function __construct(
        public int $matricula,
        public string $nome,
        public int $ciclo,
        public string $filial,
        public string $ultima_folga,
    ) {
    }
}
