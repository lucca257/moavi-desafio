<?php

namespace Database\Factories;

use App\Domain\Funcionario\Models\Funcionario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Funcionario>
 */
class FuncionarioFactory extends Factory
{
    protected $model = Funcionario::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matricula' => $this->faker->randomNumber(),
            'nome' => $this->faker->name,
            'ciclo' => $this->faker->numberBetween(0, 3),
            'filial' => $this->faker->numberBetween(1, 9),
            'ultima_folga' => now()
        ];
    }
}
