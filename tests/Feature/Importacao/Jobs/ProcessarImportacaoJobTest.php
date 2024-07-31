<?php

use App\Domain\Importacao\Jobs\ProcessarImportacaoJob;
use App\Domain\Importacao\Models\Importacao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('should process data from csv file', function () {
    $this->assertTrue(true);
    Storage::fake('local');

    $filePath = 'imports/test.csv';

    $importacao = Importacao::factory()->create([
        'processado' => false,
        'arquivo' => $filePath
    ]);

    $csvContent = "matricula;nome;filial_codigo;ciclo;ultima_folga\n92;Lívia;3;2;30/06/2024\n97;Cecília;1;2;21/07/2024";
    Storage::put($filePath, $csvContent);

    ProcessarImportacaoJob::dispatch($importacao);

    $this->assertDatabaseHas('funcionarios', [
        'matricula' => 92,
        'nome' => 'Lívia',
        'filial' => 3,
        'ciclo' => 2,
        'ultima_folga' => '30/06/2024'
    ]);

    $this->assertDatabaseHas('funcionarios', [
        'matricula' => 97,
        'nome' => 'Cecília',
        'filial' => 1,
        'ciclo' => 2,
        'ultima_folga' => '21/07/2024'
    ]);

    $importacao->refresh();
    $this->assertTrue((bool) $importacao->processado);
});
