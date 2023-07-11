<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CorreosModel::factory(20)->create();
        /*
        $this->call([
            //AreasSeeder::class
            EstatusSeeder::class
        ]);
        */
    }
}
