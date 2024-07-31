<?php

namespace App\Domain\Importacao\DTOs;

class ArquivoDto
{
    public function __construct(
        public string $nome,
        public ?bool $processado = false,
        public ?string $processado_as = null
    ) {
    }
}
