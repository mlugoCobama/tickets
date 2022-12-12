<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Permiso para ver el menu de configuracion
         */
        Permission::create(['name' => 'view config']);
        /**
         * Permisos para inventarios
         */
        Permission::create(['name' => 'view inventario']);
        Permission::create(['name' => 'new inventario']);
        Permission::create(['name' => 'detail inventario']);
        Permission::create(['name' => 'edit inventario']);
        Permission::create(['name' => 'delete inventario']);
        Permission::create(['name' => 'report inventario']);
        /**
         * Permisos para tickets
         */
        Permission::create(['name' => 'view tickets']);
        /**
         * Permisos usuarios
         */
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'new users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        Role::create(['name' =>  'Tecnico']);

        $administrador = Role::create(['name' =>  'Administrador']);
        $administrador->givePermissionTo(Permission::all());


    }
}
