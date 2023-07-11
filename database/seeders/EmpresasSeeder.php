<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EmpresasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cat_empresas')->insert([
            'nombre' => 'Agencia Nissan Universidad'
        ]);
        DB::table('cat_empresas')->insert([
            'nombre' => 'PTV Nissan Plutarco'
        ]);
        DB::table('cat_empresas')->insert([
            'nombre' => 'PTV Nissan Mitikah'
        ]);
        DB::table('cat_empresas')->insert([
            'nombre' => 'Agencia Nissan Patriotismo'
        ]);
        DB::table('cat_empresas')->insert([
            'nombre' => 'PTV Detroit'
        ]);
        DB::table('cat_empresas')->insert([
            'nombre' => 'PTV Revolución'
        ]);
        DB::table('cat_empresas')->insert([
            'nombre' => 'PTV Mixcoac'
        ]);
        DB::table('cat_empresas')->insert([
            'nombre' => 'Agencia Nissan Azcapotzalco'
        ]);
        DB::table('cat_empresas')->insert([
            'nombre' => 'Agencia Nissan Campestre'
        ]);
        DB::table('cat_empresas')->insert([
            'nombre' => 'Agencia Renault Azcapotzalco'
        ]);
        DB::table('cat_empresas')->insert([
            'nombre' => 'Agencia Renault Vallejo'
        ]);
        DB::table('cat_empresas')->insert([
            'nombre' => 'Agencia Renault Ecatepec'
        ]);
        DB::table('cat_empresas')->insert([
            'nombre' => 'Agencia Renault Pachuca'
        ]);
        DB::table('cat_empresas')->insert([
            'nombre' => 'Corporativo Autos Soni S.C.'
        ]);
    }
}
