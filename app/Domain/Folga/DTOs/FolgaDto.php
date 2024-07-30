<?php

namespace App\Domain\Folga\DTOs;

class FolgaDto
{
    public function __construct(
        public int $funcionario_id,
        public string $folga
    ) {
    }
}
