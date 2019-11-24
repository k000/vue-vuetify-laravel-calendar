<?php

use Illuminate\Database\Seeder;

class ShumokusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shumokus')->insert([
            'event'=>str_random(10)
        ]);
    }
}
