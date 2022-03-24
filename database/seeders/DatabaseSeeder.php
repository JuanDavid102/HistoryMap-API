<?php

namespace Database\Seeders;

use App\Models\Evento;
use App\Models\Marcador;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Tqdev\PhpCrudApi\GeoJson\Geometry;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        Evento::create([
            "titulo" => "Prueba",
            "html" => "<h1>Titulo Prueba</h1> <p>prueba prueba prueba prueba prueba prueba prueba prueba prueba prueba prueba </p>",
        ]);
        Marcador::create([
            //"GeomFromText('Point(12 5)')"
            'posicion' => null,
            'descripcion' => "todos vamos a morir buajajajaja",
            'tipo' => "guerra"
        ]);

        DB::statement('UPDATE marcadores SET posicion = POINT(?, ?) WHERE id=?', [111, 222, 4]);


    }
}
