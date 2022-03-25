<?php

namespace Database\Seeders;

use App\Models\Evento;
use App\Models\Mapa;
use App\Models\Marcador;
use App\Models\User;
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
        User::factory(20)->create();
        Mapa::factory(10)->create();
        Marcador::factory(10)->create();
        Evento::factory(10)->create();
    }
}
