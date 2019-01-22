<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Role::create([
        	'name' => 'Admin',
        ]);
        App\Role::create([
        	'name' => 'Propietario',
        ]);
        App\Role::create([
        	'name' => 'Arrendatario',
        ]);
    }
}

