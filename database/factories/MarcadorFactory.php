<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MarcadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "posicion" => $this->faker->numberBetween(-85,90) . ", " . $this->faker->numberBetween(-170,190),
            "tipo" => $this->faker->word(),
            "mapa_id" => $this->faker->numberBetween(1,10)
        ];
    }
}
