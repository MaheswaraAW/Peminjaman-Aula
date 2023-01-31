<?php

use App\Bidang;
use App\Seksi;
use Illuminate\Database\Seeder;

class BidangSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

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