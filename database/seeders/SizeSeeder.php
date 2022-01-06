<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quanao = [
            'XL',
            'L',
            'XXL',
            'M',
            'SM',
        ];
        $giaydep = [
            '30',
            '31',
            '32',
            '33',
            '34',
        ];

        foreach ($giaydep as $key => $value) {
            DB::table('sizes')->insert([
                'name' => $value,
                'product_type_id' => 1,
            ]);
        }
        foreach ($quanao as $key => $value) {
            DB::table('sizes')->insert([
                'name' => $value,
                'product_type_id' => 2,
            ]);
        }
    }
}
