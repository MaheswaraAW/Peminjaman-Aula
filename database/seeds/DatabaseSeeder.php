<?php

use App\Pengguna;
use App\Teksberjalan;
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
        Pengguna::insert(
            [

                [
                    'username' => 'kadin',
                    'password' => bcrypt('kadin2023'),
                    'nama' => 'Kadin',
                    'level' => '1',
                    'bidang' => 'A01',
                    'seksi' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'username' => 'sekretariat',
                    'password' => bcrypt('sekretariat2023'),
                    'nama' => 'Sekretariat',
                    'level' => '1',
                    'bidang' => 'A02',
                    'seksi' => '',
                    'created_at' => now(),
                    'updated_at' => now()

                ],
                [
                    'username' => 'kesmas',
                    'password' => bcrypt('kesmas2023'),
                    'nama' => 'Kesmas',
                    'level' => '1',
                    'bidang' => 'A03',
                    'seksi' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'username' => 'p2p',
                    'password' => bcrypt('p2p2023'),
                    'nama' => 'P2P',
                    'level' => '1',
                    'bidang' => 'A04',
                    'seksi' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ],                [
                    'username' => 'sdk',
                    'password' => bcrypt('sdk2023'),
                    'nama' => 'SDK',
                    'level' => '1',
                    'bidang' => 'A05',
                    'seksi' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ],            [
                    'username' => 'yankes',
                    'password' => bcrypt('yankes2023'),
                    'nama' => 'Yankes',
                    'level' => '1',
                    'bidang' => 'A06',
                    'seksi' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'username' => 'perencanaan',
                    'password' => bcrypt('perencanaan2023'),
                    'nama' => 'Perencanaan dan Evaluasi',
                    'level' => '1',
                    'bidang' => 'A02',
                    'seksi' => 'SK01',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'username' => 'keuangan',
                    'password' => bcrypt('keuangan2023'),
                    'nama' => 'Keuangan dan Aset',
                    'level' => '1',
                    'bidang' => 'A02',
                    'seksi' => 'SK02',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'username' => 'umpeg',
                    'password' => bcrypt('umpeg2023'),
                    'nama' => 'Umum Kepegawaian',
                    'level' => '1',
                    'bidang' => 'A02',
                    'seksi' => 'SK03',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'username' => 'kesbunak',
                    'password' => bcrypt('kesbunak2023'),
                    'nama' => 'Kesehatan Ibu dan Anak',
                    'level' => '1',
                    'bidang' => 'A03',
                    'seksi' => 'SK05',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'username' => 'keslingprom',
                    'password' => bcrypt('keslingprom2023'),
                    'nama' => 'Kesehatan Lingkungan dan Promosi Kesehatan',
                    'level' => '1',
                    'bidang' => 'A03',
                    'seksi' => 'SK06',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'username' => 'pemkatgizi',
                    'password' => bcrypt('pemkatgizi2023'),
                    'nama' => 'Pemberdayaan Masyarakat dan Gizi',
                    'level' => '1',
                    'bidang' => 'A03',
                    'seksi' => 'SK07',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'username' => 'p2tvz',
                    'password' => bcrypt('p2tvz2023'),
                    'nama' => 'P2 Tular Vektor dan Zoonotik',
                    'level' => '1',
                    'bidang' => 'A04',
                    'seksi' => 'SK09',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'username' => 'p2tms',
                    'password' => bcrypt('p2tms2023'),
                    'nama' => 'P2 Tidak Menular dan Surveilans',
                    'level' => '1',
                    'bidang' => 'A04',
                    'seksi' => 'SK10',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'username' => 'p2pml',
                    'password' => bcrypt('p2pml2023'),
                    'nama' => 'P2 Penyakit Menular Langsung',
                    'level' => '1',
                    'bidang' => 'A04',
                    'seksi' => 'SK11',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'username' => 'farmamin',
                    'password' => bcrypt('farmamin2023'),
                    'nama' => 'Kefarmasian dan Perbekalan Kesehatan',
                    'level' => '1',
                    'bidang' => 'A05',
                    'seksi' => 'SK13',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'username' => 'sdmk',
                    'password' => bcrypt('sdmk2023'),
                    'nama' => 'Sumber Daya Manusia Kesehatan',
                    'level' => '1',
                    'bidang' => 'A05',
                    'seksi' => 'SK14',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'username' => 'infokes',
                    'password' => bcrypt('infokes2023'),
                    'nama' => 'Informasi dan Pengendalian Sarana Kesehatan',
                    'level' => '1',
                    'bidang' => 'A05',
                    'seksi' => 'SK15',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'username' => 'pkpt',
                    'password' => bcrypt('pkpt2023'),
                    'nama' => 'Pelayanan Kesehatan Primer dan Tradisional',
                    'level' => '1',
                    'bidang' => 'A06',
                    'seksi' => 'SK17',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'username' => 'pkr',
                    'password' => bcrypt('pkr2023'),
                    'nama' => 'Pelayanan Kesehatan Rujukan',
                    'level' => '1',
                    'bidang' => 'A06',
                    'seksi' => 'SK18',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'username' => 'jamkestra',
                    'password' => bcrypt('jamkestra2023'),
                    'nama' => 'Jaminan Kesehatan dan Kemitraan',
                    'level' => '1',
                    'bidang' => 'A06',
                    'seksi' => 'SK19',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]

        );

        Teksberjalan::create(
            [
                'teks' => 'Selamat Datang di Dinas Kesehatan Kota Semarang'
            ]
        );
        $this->call(ProfileTableSeeder::class);
        $this->call(BidangSedeer::class);
        // $this->call(PenggunaSistemSeeder::class);
    }
}