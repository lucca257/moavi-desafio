<?php

namespace Database\Factories;

use App\Domain\Importacao\Models\Importacao;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Importacao>
 */
class ImportacaoFactory extends Factory
{
    protected $model = Importacao::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'arquivo' => $this->faker->name,
            'processado' => $this->faker->boolean()
        ];
    }
}
