<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profile')->insert(
            [
                'video' => '1673767620mars.mp4',
                'nama' => 'mars',
                'teks_berjalan' => 'Selamat Datang di Dinas Kesehatan Kota Semarang'
            ]
        );
    }
}