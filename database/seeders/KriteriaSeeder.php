<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $table1 = 'kriterias';
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table($table1)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'kode_dimensi' => 'A',
                'kriteria' => 'Reliability',
            ],
            [
                'kode_dimensi' => 'B',
                'kriteria' => 'Responsiveness',
            ],
            [
                'kode_dimensi' => 'C',
                'kriteria' => 'Assurance',
            ],
            [
                'kode_dimensi' => 'D',
                'kriteria' => 'Empathy',
            ],
            [
                'kode_dimensi' => 'E',
                'kriteria' => 'Tangibles',
            ],
        ];

        DB::table($table1)->insert($data);
        //
    }
}
