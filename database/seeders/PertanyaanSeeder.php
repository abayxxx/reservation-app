<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $table1 = 'pertanyaans';
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table($table1)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'kode_atribut' => 'A1',
                'pertanyaan' => 'Teknisi Selalu menepati janji mereka untuk melakukan pengecekan kerusakan AC pada waktu yang ditentukan',
                'kriteria_id' => 1
            ],
            [
                'kode_atribut' => 'A2',
                'pertanyaan' => 'Teknisi bersungguh-sungguh untuk membantu memperbaiki masalah kerusakan AC konsumen',
                'kriteria_id' => 1
            ],
            [
                'kode_atribut' => 'A3',
                'pertanyaan' => 'Teknisi memberikan layanan yang tepat sesuai dengan kebutuhan konsumen',
                'kriteria_id' => 1
            ],
            [
                'kode_atribut' => 'A4',
                'pertanyaan' => 'Teknisi datang ketempat konsumen sesuai waktu yang telah dijanjikan',
                'kriteria_id' => 1
            ],
            [
                'kode_atribut' => 'B1',
                'pertanyaan' => 'Teknisi selalu merespon keluhan konsumen dengan cepat',
                'kriteria_id' => 2
            ],
            [
                'kode_atribut' => 'B2',
                'pertanyaan' => 'Teknisi selalu dapat menyelesaikan keluhan konsumen',
                'kriteria_id' => 2
            ],
            [
                'kode_atribut' => 'B3',
                'pertanyaan' => 'Kecepatan pemrosesan keluhan pelanggan',
                'kriteria_id' => 2
            ],
            [
                'kode_atribut' => 'B4',
                'pertanyaan' => 'Teknisi menginformasikan waktu untuk memperbaiki kerusakan AC',
                'kriteria_id' => 2
            ],
            [
                'kode_atribut' => 'C1',
                'pertanyaan' => 'Teknisi bersikap sopan terhadap konsumen',
                'kriteria_id' => 3
            ],
            [
                'kode_atribut' => 'C2',
                'pertanyaan' => 'Konsumen merasa aman serta nyaman dalan berinteraksi',
                'kriteria_id' => 3
            ],
            [
                'kode_atribut' => 'C3',
                'pertanyaan' => 'Teknisi memiliki pengetahuan yang memadai dalam menjawab pertanyaan-pertanyaan konsumen',
                'kriteria_id' => 3
            ],
            [
                'kode_atribut' => 'C4',
                'pertanyaan' => 'Teknisi memiliki keterampilan yang memadai dalam menangani kerusakan AC',
                'kriteria_id' => 3
            ],
            [
                'kode_atribut' => 'D1',
                'pertanyaan' => 'Kemudahan berkomunikasi dengan konsumen',
                'kriteria_id' => 4
            ],
            [
                'kode_atribut' => 'D2',
                'pertanyaan' => 'Teknisi selalu mengutamakan kepentingan konsumen',
                'kriteria_id' => 4
            ],
            [
                'kode_atribut' => 'D3',
                'pertanyaan' => 'Tekinisi memahami kebutuhan spesifik para konsumennya',
                'kriteria_id' => 4
            ],
            [
                'kode_atribut' => 'D4',
                'pertanyaan' => 'Para teknisi memiliki jam operasional yang nyaman',
                'kriteria_id' => 4
            ],
            [
                'kode_atribut' => 'D5',
                'pertanyaan' => 'Teknisi memberikan perhatian individual kepada para konsumennya',
                'kriteria_id' => 4
            ],
            [
                'kode_atribut' => 'E1',
                'pertanyaan' => 'Teknisi berpenampilan rapi',
                'kriteria_id' => 5
            ],
            [
                'kode_atribut' => 'E2',
                'pertanyaan' => 'Sparepat yang dibutuhkan lengkap',
                'kriteria_id' => 5
            ],
            [
                'kode_atribut' => 'E3',
                'pertanyaan' => 'Peralatan yang akan digunakan untuk memperbaiki kerusakan AC lengkap',
                'kriteria_id' => 5
            ],

        ];

        DB::table($table1)->insert($data);
    }
}
