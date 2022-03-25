<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MapaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word(),
            'usuario_id' => $this->faker->numberBetween(1,20)
        ];
    }
}
