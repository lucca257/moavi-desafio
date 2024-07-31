<?php

use App\Domain\Importacao\Jobs\ProcessarImportacaoJob;
use App\Domain\Importacao\Models\Importacao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('listar importações', function () {
    Importacao::factory(5)->create();

    $this->get('/api/import')
        ->assertOk()
        ->assertJsonCount(5);
});

describe('importar arquivos', function () {
    it('deve validar os formato do arquivo ao importar', function () {
        Storage::fake('local');
        Queue::fake();
        $fileName = 'document.ext';

        $this->postJson('/api/import', [
            'file' => UploadedFile::fake()->create($fileName, 100),
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['file']);

        Queue::assertNothingPushed();
        Storage::assertDirectoryEmpty('imports');
    });

    it('deve processar os dados do arquivo em um job', function () {
        Storage::fake('local');
        Queue::fake();
        $fileName = 'document.csv';

        $this->post('api/import', [
            'file' => UploadedFile::fake()->create($fileName, 100),
        ])->assertOk();

        $this->assertEquals(Importacao::all()->count(), 1);

        Queue::assertPushed(ProcessarImportacaoJob::class);
        $files = Storage::allFiles();
        $this->assertNotEmpty($files);
    });
});
