<?php

use Illuminate\Database\Seeder;

class PenggunaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengguna')->insert(
        	['username'=> 'infokes',
        	'password'=> '$2y$10$2lDuKvawdyJcz1JrOYnA3eYv54di6rIy6wek5yBV3Vh6NFnk0vsli',
            'nama'=> 'infokes',
            'level'=> '0']
        	
        );
    }
}
