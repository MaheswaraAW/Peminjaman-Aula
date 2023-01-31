<?php

use App\Bidang;
use App\Pengguna;
use App\Seksi;
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
                [
                    'username' => 'admindkk',
                    'password' => bcrypt('adminndkk2023'),
                    'nama' => 'Admin',
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
        // $this->call(BidangSedeer::class);
        // $this->call(PenggunaSistemSeeder::class);
        $bidang = [
            [
                'kode_bidang' => 'A01',
                'detail_bidang' => 'Kepala Dinas'
            ],
            [
                'kode_bidang' => 'A02',
                'detail_bidang' => 'Sekretariat'
            ],
            [
                'kode_bidang' => 'A03',
                'detail_bidang' => 'Kesehatan Masyarakat'
            ],
            [
                'kode_bidang' => 'A04',
                'detail_bidang' => 'Pencegahan Pemberantasan Penyakit'
            ],
            [
                'kode_bidang' => 'A05',
                'detail_bidang' => 'Sumber Daya Kesehatan'
            ],
            [
                'kode_bidang' => 'A06',
                'detail_bidang' => 'Pelayanan Kesehatan'
            ]

        ];
        $seksi = [
            // Sekretariat
            [
                'kode_bidang' => 'A02',
                'kode_seksi' => 'SK01',
                'detail_seksi' => 'Sub Bag Perencanaan dan Evaluasi'
            ],
            [
                'kode_bidang' => 'A02',
                'kode_seksi' => 'SK02',
                'detail_seksi' => 'Sub Bag Keuangan dan Aset'
            ],
            [
                'kode_bidang' => 'A02',
                'kode_seksi' => 'SK03',
                'detail_seksi' => 'Sub Bag Umum Kepegawaian'
            ],
            [
                'kode_bidang' => 'A02',
                'kode_seksi' => 'SK04',
                'detail_seksi' => '-'
            ],
            // Kesmas
            [
                'kode_bidang' => 'A03',
                'kode_seksi' => 'SK05',
                'detail_seksi' => 'Seksi Kesehatan Ibu dan Anak'
            ],
            [
                'kode_bidang' => 'A03',
                'kode_seksi' => 'SK06',
                'detail_seksi' => 'Seksi Kesehatan Lingkungan dan Promosi Kesehatan'
            ],
            [
                'kode_bidang' => 'A03',
                'kode_seksi' => 'SK07',
                'detail_seksi' => 'Seksi Pemberdayaan Masyarakat dan Gizi'
            ],
            [
                'kode_bidang' => 'A03',
                'kode_seksi' => 'SK08',
                'detail_seksi' => '-'
            ],
            // P2P
            [
                'kode_bidang' => 'A04',
                'kode_seksi' => 'SK09',
                'detail_seksi' => 'Seksi P2 Tular Vektor dan Zoonotik'
            ],
            [
                'kode_bidang' => 'A04',
                'kode_seksi' => 'SK10',
                'detail_seksi' => 'Seksi P2 Tidak Menular dan Surveilans'
            ],
            [
                'kode_bidang' => 'A04',
                'kode_seksi' => 'SK11',
                'detail_seksi' => 'Seksi P2 Penyakit Menular Langsung'
            ],
            [
                'kode_bidang' => 'A04',
                'kode_seksi' => 'SK12',
                'detail_seksi' => '-'
            ],
            [
                'kode_bidang' => 'A05',
                'kode_seksi' => 'SK13',
                'detail_seksi' => 'Seksi Kefarmasian dan Perbekalan Kesehatan'
            ],            [
                'kode_bidang' => 'A05',
                'kode_seksi' => 'SK14',
                'detail_seksi' => 'Seksi Sumber Daya Manusia Kesehatan'
            ],
            [
                'kode_bidang' => 'A05',
                'kode_seksi' => 'SK15',
                'detail_seksi' => 'Seksi Informasi dan Pengendalian Sarana Kesehatan'
            ],
            [
                'kode_bidang' => 'A05',
                'kode_seksi' => 'SK16',
                'detail_seksi' => '-'
            ],
            [
                'kode_bidang' => 'A06',
                'kode_seksi' => 'SK17',
                'detail_seksi' => 'Seksi Pelayanan Kesehatan Primer dan Tradisional'
            ],
            [
                'kode_bidang' => 'A06',
                'kode_seksi' => 'SK18',
                'detail_seksi' => 'Seksi Pelayanan Kesehatan Rujukan'
            ],
            [
                'kode_bidang' => 'A06',
                'kode_seksi' => 'SK19',
                'detail_seksi' => 'Seksi Jaminan Kesehatan dan Kemitraan'
            ],
            [
                'kode_bidang' => 'A06',
                'kode_seksi' => 'SK20',
                'detail_seksi' => '-'
            ],

        ];
        foreach ($bidang as $bid) {
            Bidang::create($bid);
        }
        foreach ($seksi as $sk) {
            Seksi::create($sk);
        }
    }
}