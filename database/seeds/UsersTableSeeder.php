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
        factory(App\User::class, 29)->create();
        App\User::create([
            'role' => 'ADMIN',
            'name' => 'Julian Garzon',
        	'email'=> 'bryangarzon22@gmail.com',
        	'password' => bcrypt('123'),
        	'torre' => '1',
        	'apartamento' => '404',
        ]);
    }
}
