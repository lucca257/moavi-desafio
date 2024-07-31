<?php

namespace App\Domain\Importacao\Actions;

use App\Domain\Importacao\Jobs\ProcessarImportacaoJob;
use App\Domain\Importacao\Models\Importacao;
use Illuminate\Http\UploadedFile;

class ImportAction
{
    public function execute(UploadedFile $arquivo)
    {
        $originalName = $arquivo->getClientOriginalName();

        $caminho = 'imports/';

        $nome = pathinfo($originalName, PATHINFO_FILENAME);
        $extensao = pathinfo($originalName, PATHINFO_EXTENSION);

        $nomeUnico = $nome.now()->format('YmdHis').'.'.$extensao;

        $arquivo->storeAs($caminho, $nomeUnico);

        $importacao = Importacao::create([
            'arquivo' => $caminho.$nomeUnico
        ]);

        ProcessarImportacaoJob::dispatch($importacao);
    }
}
