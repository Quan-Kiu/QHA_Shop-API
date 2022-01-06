<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $type = [
            'Member',
            'Admin'
        ];

        foreach ($type as $key => $value) {
            DB::table('user_types')->insert([
                'name' => $value,
            ]);
        }
    }
}
