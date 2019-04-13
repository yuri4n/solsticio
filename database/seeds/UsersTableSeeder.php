<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Solsticio\User::class, 29)->create();
        Solsticio\User::create([
            'role' => 'ADMIN',
            'name' => 'Julian Garzon',
        	'email'=> 'bryangarzon22@gmail.com',
        	'password' => bcrypt('123'),
        	'torre' => '1',
            'apartamento' => '404',
            'status' => 'APPROVED'
        ]);
    }
}
