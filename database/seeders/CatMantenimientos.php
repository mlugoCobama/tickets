<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CatMantenimientos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cat_mantenimientos')->insert([
            'tipo' => 'Mantenimiento Logico'
        ]);
        DB::table('cat_mantenimientos')->insert([
            'tipo' => 'Mantenimiento Fisico'
        ]);
    }
}
