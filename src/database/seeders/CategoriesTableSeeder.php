<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            '食費',
            '日用品',
            '交通費',
            '水道・光熱費',
            '通信費'
        ];

        foreach ($names as $name) {
            DB::table('categories')->insert([
                'name' => $name
            ]);
        }
    }
}
