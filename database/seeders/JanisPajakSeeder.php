<?php

namespace Database\Seeders;

use App\Models\TaxType;
use Illuminate\Database\Seeder;

class JanisPajakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'taxType' => 'SPT Masa PPh Pasal 21/26'
            ],
            [
                'taxType' => 'SPT Masa PPh Pasal 22'
            ],
            [
                'taxType' => 'SPT Masa PPh Pasal 23/26'
            ],
            [
                'taxType' => 'SPT Masa PPh Pasal 25'
            ],
            [
                'taxType' => 'SPT Masa PPh Pasal 4 ayat (2)'
            ],
            [
                'taxType' => 'SPT Masa PPh Pasal PPnBM'
            ],
            [
                'taxType' => 'SPT Masa PPh Pasal Pengumut'
            ],
            [
                'taxType' => 'SKT'
            ],
            [
                'taxType' => 'update'
            ],
            [
                'taxType' => 'AKTIF NE'
            ],
            [
                'taxType' => 'PKB'
            ],
            [
                'taxType' => 'validasi'
            ],
            [
                'taxType' => 'SKB'
            ],
            [
                'taxType' => 'SKP'
            ],
        ];

        TaxType::insert($data);
    }
}
