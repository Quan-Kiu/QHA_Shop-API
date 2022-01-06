<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            'white',
            'black',
            'blue',
            'green',
            'yellow',
        ];

        foreach ($colors as $key => $value) {
            DB::table('colors')->insert([
                'name' => $value,
            ]);
        }
    }
}
