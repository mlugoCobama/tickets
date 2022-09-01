<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            'nombre' => 'Recursos Tecnologicos'
        ]);
        DB::table('areas')->insert([
            'nombre' => 'Infraestructura - Telecomunicaciones'
        ]);
        DB::table('areas')->insert([
            'nombre' => 'Infraestructura - Servicios'
        ]);
        DB::table('areas')->insert([
            'nombre' => 'Soporte Tecnico'
        ]);
        DB::table('areas')->insert([
            'nombre' => 'Sistemas'
        ]);
    }
}
