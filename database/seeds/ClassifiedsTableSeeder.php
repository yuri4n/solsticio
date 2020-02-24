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
        factory(App\Classified::class, 50)->create();
    }
}
