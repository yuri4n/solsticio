<?php

use Illuminate\Database\Seeder;

class ClassifiedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Solsticio\Classified::class, 50)->create();
    }
}
