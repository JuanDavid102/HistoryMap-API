<?php

namespace Database\Seeders;

use App\Models\Evento;
use App\Models\Marcador;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(20)->create();

        Evento::create([
            "titulo" => "Prueba",
            "html" => "<h1>Titulo Prueba</h1> <p>prueba prueba prueba prueba prueba prueba prueba prueba prueba prueba prueba </p>",
        ]);
        Marcador::create([
            'posicion' => "12.02153, 13.0132",
            'descripcion' => "todos vamos a morir buajajajaja",
            'tipo' => "guerra"
        ]);

    }
}
