<?php

namespace Database\Factories;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Empresa::class;
    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "rif" => fake()->unique()->numerify('J-########-#'),
            "email" => fake()->unique()->safeEmail(),
            "email2" => fake()->safeEmail(),
            "phone" => fake()->unique()->phoneNumber(),
            "phone2" => fake()->phoneNumber(),
            "pais" => fake()->country(),
            "estado" => fake()->state(),
            "direccion" => fake()->address()

        ];
    }
}
