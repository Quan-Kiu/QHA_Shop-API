<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $type = [
            'Giày dép',
            'Quần áo'
        ];

        foreach ($type as $key => $value) {
            DB::table('product_types')->insert([
                'name' => $value,
            ]);
        }
    }
}
