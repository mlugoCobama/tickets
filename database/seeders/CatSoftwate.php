<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CatSoftwate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cat_software')->insert([
            'tipo' => 'Sistema Operativo',
            'icono' => 'fab fa-microsoft'
        ]);
        DB::table('cat_software')->insert([
            'tipo' => 'Office',
            'icono' => 'fas fa-file-word'
        ]);
    }
}
