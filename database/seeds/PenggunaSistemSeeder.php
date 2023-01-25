<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaSistemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengguna')->insert(
            [
                'username' => 'infokes',
                'password' => bcrypt('infokes2023'),
                'nama' => 'infokes',
                'level' => '0'
            ]
        );
    }
}