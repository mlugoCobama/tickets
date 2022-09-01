<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estatus')->insert([
            'nombre' => 'En espera - Sin contacto al cliente'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'En espera - Cotizando'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'En espera - OC firmada'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'En espera - Re-cotización'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'En espera - Recepción de artículos'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'En espera - Garantía'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'En proceso'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'Programado'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'Resuelto'
        ]);
        DB::table('estatus')->insert([
            'nombre' => 'Cancelado'
        ]);
    }
}
