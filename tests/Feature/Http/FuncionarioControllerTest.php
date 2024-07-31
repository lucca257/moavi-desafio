<?php

use App\Domain\Funcionario\Models\Funcionario;
use App\Domain\Importacao\Jobs\ProcessarImportacaoJob;
use App\Domain\Importacao\Models\Importacao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

describe('listar funcionários', function () {
    it('deve validar os parâmetros', function () {
        $this->postJson('/api/funcionario', [
            'ano' => 'invalido',
            'mes' => 'invalido',
            'filial' => 'invalido',
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['ano', 'mes', 'filial']);
    });

    it('obter lista de funcionarios e folgas por ciclo', function () {
        $data = now()->setMonth(1)->setYear(2024);
        Carbon::setTestNow($data);

        $funcionario1 = Funcionario::factory()->create([
            'filial' => 1,
            'ciclo' => 0,
        ]);
        $funcionario1->refresh();
        $funcionario1->domingos = [
            "07/01/2024" => "folga",
            "14/01/2024" => "folga",
            "21/01/2024" => "folga",
            "28/01/2024" => "folga",
        ];

        $funcionario2 = Funcionario::factory()->create([
            'filial' => 1,
            'ciclo' => 1,
        ]);
        $funcionario2->refresh();
        $funcionario2->domingos = [
            "07/01/2024" => "trabalho",
            "14/01/2024" => "folga",
            "21/01/2024" => "trabalho",
            "28/01/2024" => "folga"
        ];

        $funcionario3 = Funcionario::factory()->create([
            'filial' => 1,
            'ciclo' => 2,
        ]);
        $funcionario3->refresh();
        $funcionario3->domingos = [
            "07/01/2024" => "trabalho",
            "14/01/2024" => "trabalho",
            "21/01/2024" => "folga",
            "28/01/2024" => "trabalho"
        ];

        $funcionario4 = Funcionario::factory()->create([
            'filial' => 1,
            'ciclo' => 3,
        ]);
        $funcionario4->refresh();
        $funcionario4->domingos = [
            "07/01/2024" => "trabalho",
            "14/01/2024" => "trabalho",
            "21/01/2024" => "trabalho",
            "28/01/2024" => "folga"
        ];

        $this->postJson('/api/funcionario', [
            'ano' => $data->year,
            'mes' => $data->month,
            'filial' => 1,
        ])->assertOk()->assertExactJson([
            $funcionario1->toArray(),
            $funcionario2->toArray(),
            $funcionario3->toArray(),
            $funcionario4->toArray()
        ]);
    });
});

it('deve listar filiais do funcionário', function () {
    $filiais = [1, 2];

    foreach ($filiais as $filial) {
        Funcionario::factory(2)->create([
            'filial' => $filial
        ]);
    }

    $this->getJson('/api/funcionario/filial')->assertOk()
        ->assertJson($filiais);
});
