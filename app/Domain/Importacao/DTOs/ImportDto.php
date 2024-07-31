<?php

namespace App\Domain\Importacao\DTOs;

class ImportDto
{
    public function __construct(
        public int $matricula,
        public string $nome,
        public int $filial,
        public int $ciclo,
        public string $folga
    ) {
    }
}
