<?php

namespace App\Domain\Importacao\Actions;

use App\Domain\Importacao\DTOs\ArquivoDto;
use App\Domain\Importacao\DTOs\ImportDto;

interface mportInterface
{
    public function execute(ImportDto $importDto): ArquivoDto;
}
