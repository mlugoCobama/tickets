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
            'tipo' => 'CPU',
            'icono' => 'fas fa-server fa-xs'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Monitor',
            'icono' => 'fas fa-tv'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Teclado',
            'icono' => 'fas fa-keyboard'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Mouse',
            'icono' => 'fas fa-mouse'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Diadema',
            'icono' => 'fas fa-headphones'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Regulador',
            'icono' => 'fas fa-plug'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Telefono Fijo',
            'icono' => 'fas fa-phone'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Telefono Movil',
            'icono' => 'fas fa-mobile-alt'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Multifuncional',
            'icono' => 'fas fa-print'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Tableta',
            'icono' => 'fas fa-tablet-alt'
        ]);
        DB::table('cat_hardware')->insert([
            'tipo' => 'Otro',
            'icono' => 'fas fa-robot'
        ]);
    }
}
