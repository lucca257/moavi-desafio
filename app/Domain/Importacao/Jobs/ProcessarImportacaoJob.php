<?php

namespace App\Domain\Importacao\Jobs;

use App\Domain\Funcionario\DTOs\FuncionarioDto;
use App\Domain\Funcionario\Models\Funcionario;
use App\Domain\Importacao\Models\Importacao;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class ProcessarImportacaoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private Importacao $importacao
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->processarCsv($this->importacao->arquivo);
        $this->importacao->update([
            'processado' => true,
            'processado_em' => now()
        ]);
    }

    private function processarCsv(string $arquivo)
    {
        $csvContent = Storage::get($arquivo);

        $reader = Reader::createFromString($csvContent);
        $reader->setHeaderOffset(0);

        foreach ($reader as $record) {
            $keys = explode(';', array_key_first($record));
            $values = explode(';', array_values($record)[0]);
            $data = array_combine($keys, $values);

            $funcionarioDto = new FuncionarioDto(
                $data['matricula'],
                $data['nome'],
                $data['ciclo'],
                $data['filial_codigo'],
                $data['ultima_folga'],
            );

            Funcionario::updateOrCreate(
                ['matricula' => $funcionarioDto->matricula],
                $funcionarioDto->toArray()
            );
        }
    }
}
