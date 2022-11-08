<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatHardware extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cat_hardware')->insert([
            'tipo' => 'CPU'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Monitor'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Teclado'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Mouse'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Diadema'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Regulador/No Break'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Telefono Fijo'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Telefono Movil'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Multifuncional'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Tableta'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Otro'
        ]);
    }
}
