<?php

use App\Pengguna;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        Pengguna::create(
            [
                'username' => 'infokes',
                'password' => bcrypt('infokes2023'),
                'nama' => 'infokes',
                'level' => '0'
            ]
        );
        $this->call(ProfileTableSeeder::class);
        // $this->call(PenggunaSistemSeeder::class);
    }
}