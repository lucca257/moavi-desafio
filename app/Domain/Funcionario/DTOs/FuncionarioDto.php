<?php

namespace App\Domain\Funcionario\DTOs;

class FuncionarioDto
{
    public function __construct(
        public string $matricula,
        public string $nome,
        public int $ciclo,
        public string $filial
    ) {
    }
}
